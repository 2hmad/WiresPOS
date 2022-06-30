<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="history">
            <Sidebar />
            <div class="side">
                <!-- <h3>Payments</h3>
                <div class="row">
                    <div class="card">
                        <div class="title">Total recieved</div>
                        <div class="amount">
                            <span class="currency">$</span>
                            <span class="number">84,254</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="title">today recieved</div>
                        <div class="amount">
                            <span class="currency">$</span>
                            <span class="number">200,00</span>
                        </div>
                    </div>
                </div> -->
                <div class="invoices">
                    <div class="heading">
                        <div style="width: 100%">
                            <h3>{{ $t("invoices") }}</h3>
                            <p>
                                {{ $t("list-of-all-your-recent-transcations") }}
                            </p>
                        </div>
                        <div>
                            <router-link to="/menu">
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    {{ $t("new-invoice") }}
                                </button>
                            </router-link>
                        </div>
                    </div>
                    <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            perPage: 15,
                            perPageDropdown: [3, 7, 9],
                            nextLabel: 'next',
                            prevLabel: 'prev',
                        }"
                        :search-options="{
                            enabled: true,
                        }"
                        style="margin-top: 3%; direction: ltr"
                    >
                        <template #table-row="props">
                            <span v-if="props.column.field == 'option'">
                                <div class="action-btns">
                                    <a :href="`/invoice/${props.row.id}`">
                                        <button
                                            style="
                                                display: flex;
                                                align-items: center;
                                                gap: 5px;
                                                background: #336699;
                                                padding: 0 10px;
                                                border-radius: 3px;
                                                color: white;
                                                font-size: 13px;
                                            "
                                        >
                                            <font-awesome-icon
                                                :icon="['fas', 'eye']"
                                            />
                                            {{ $t("view") }}
                                        </button>
                                    </a>
                                    <button
                                        @click="refundInvoice(props.row.id)"
                                        style="
                                            display: flex;
                                            align-items: center;
                                            gap: 5px;
                                            background: #ef5350;
                                            padding: 0 10px;
                                            border-radius: 3px;
                                            color: white;
                                            font-size: 13px;
                                        "
                                        v-if="props.row.status !== 'refund'"
                                    >
                                        <font-awesome-icon
                                            :icon="[
                                                'fas',
                                                'arrow-right-arrow-left',
                                            ]"
                                        />
                                        {{ $t("return") }}
                                    </button>
                                </div>
                            </span>
                            <span
                                v-else-if="props.column.field == 'invoice_id'"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'cash-register']"
                                    />
                                    {{ props.row.invoice_id }}
                                </span>
                            </span>
                            <span
                                v-else-if="props.column.field == 'created_at'"
                            >
                                <span>
                                    {{
                                        $luxonDateTime
                                            .fromISO(props.row.created_at)
                                            .toFormat("y-LL-d")
                                    }}
                                </span>
                            </span>
                            <span v-else-if="props.column.field == 'payment'">
                                <span v-if="props.row.payment == 1">
                                    {{ $t("cash") }}
                                </span>
                                <span v-else-if="props.row.payment == 2">
                                    {{ $t("credit-card") }}
                                </span>
                                <span v-else-if="props.row.payment == 3">
                                    {{ $t("e-wallet") }}
                                </span>
                            </span>
                            <span v-else-if="props.column.field == 'subtotal'">
                                <span>
                                    {{ props.row.payment }}
                                    <span style="text-transform: uppercase">
                                        {{ systemSettings.currency }}
                                    </span>
                                </span>
                            </span>
                            <span v-else-if="props.column.field == 'status'">
                                <span
                                    v-if="props.row.status == 'paid'"
                                    class="paid"
                                    style="
                                        background: #336699;
                                        color: white;
                                        padding: 0px 10px;
                                        border-radius: 10px;
                                        font-size: 12px;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 5px;
                                        user-select: none;
                                    "
                                >
                                    <font-awesome-icon
                                        :icon="['fas', 'money-bill']"
                                    />
                                    {{ $t("paid") }}
                                </span>
                                <span
                                    v-if="props.row.status == 'refund'"
                                    class="refund"
                                    style="
                                        background: #ef5350;
                                        color: white;
                                        padding: 0px 10px;
                                        border-radius: 10px;
                                        font-size: 12px;
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 5px;
                                    "
                                >
                                    <font-awesome-icon
                                        :icon="['fas', 'money-bill']"
                                    />
                                    {{ $t("refund") }}
                                </span>
                            </span>
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                            </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import { VueGoodTable } from "vue-good-table-next";
import "vue-good-table-next/dist/vue-good-table-next.css";
import axios from "axios";
import Swal from "sweetalert2";
export default {
    components: {
        Sidebar,
        VueGoodTable,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            systemSettings: [],
            columns: [
                {
                    label: this.$t("id"),
                    field: "id",
                    hidden: true,
                },
                {
                    label: this.$t("invoice-number"),
                    field: "invoice_id",
                    sortable: false,
                },
                {
                    label: this.$t("date"),
                    field: "created_at",
                },
                {
                    label: this.$t("total"),
                    field: "subtotal",
                },
                {
                    label: this.$t("payment-method"),
                    field: "payment",
                    sortable: false,
                },
                {
                    label: this.$t("status"),
                    field: "status",
                    sortable: false,
                },
                {
                    label: this.$t("option"),
                    field: "option",
                    sortable: false,
                },
            ],
            rows: [],
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-settings",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => (this.systemSettings = result.data))
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/invoices",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                this.rows = result.data;
            })
            .catch((err) => console.log(err));
    },
    methods: {
        refundInvoice(id) {
            var confirm = window.confirm(this.$t("are-you-sure?"));
            if (confirm) {
                axios
                    .post(
                        "/api/refund-invoice",
                        { id: id },
                        {
                            headers: { token: this.user.token },
                        }
                    )
                    .then((result) => {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener(
                                    "mouseenter",
                                    Swal.stopTimer
                                );
                                toast.addEventListener(
                                    "mouseleave",
                                    Swal.resumeTimer
                                );
                            },
                        });

                        Toast.fire({
                            icon: "success",
                            title: this.$t("invoice-refunded"),
                        });
                        if (Toast) {
                            location.reload();
                        }
                    })
                    .catch((err) => console.log(err));
            }
        },
    },
};
</script>

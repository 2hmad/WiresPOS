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
                                        <font-awesome-icon
                                            :icon="['fas', 'eye']"
                                            color="#336699"
                                        />
                                    </a>
                                </div>
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
export default {
    components: {
        Sidebar,
        VueGoodTable,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
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
                    label: this.$t("total"),
                    field: "subtotal",
                },
                {
                    label: this.$t("payment-method"),
                    field: "payment",
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
};
</script>

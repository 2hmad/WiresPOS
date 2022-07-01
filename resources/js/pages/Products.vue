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
                            <h3>{{ $t("products") }}</h3>
                            <p>{{ $t("list-of-all-products") }}</p>
                        </div>
                        <div v-if="user.role == 'admin'">
                            <router-link
                                :to="`/add-product/${this.$route.params.cat_id}`"
                            >
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    {{ $t("new-product") }}
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
                        <template
                            #table-row="props"
                            v-if="user.role == 'admin'"
                        >
                            <span v-if="props.column.field == 'option'">
                                <div class="action-btns">
                                    <button
                                        class="delete-action"
                                        @click="deleteProduct(props.row.id)"
                                    >
                                        <font-awesome-icon
                                            :icon="['fas', 'trash']"
                                            color="#336699"
                                            style="font-size: 17px"
                                        />
                                    </button>
                                </div>
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
                    label: this.$t("option"),
                    field: "id",
                    hidden: true,
                },
                {
                    label: this.$t("product"),
                    field: "product_name",
                },
                {
                    label: this.$t("price"),
                    field: "price",
                },
                {
                    label: this.$t("category"),
                    field: "category.category_name",
                    sortable: false,
                },
                {
                    label: this.$t("code"),
                    field: "code",
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
    mounted() {
        axios
            .get(`/api/get-products/${this.$route.params.cat_id}`)
            .then((res) => (this.rows = res.data))
            .catch((err) => console.log(err));
    },
    methods: {
        deleteProduct(id) {
            var confirm = window.confirm(this.$t("are-your-sure"));
            if (confirm) {
                axios
                    .post(
                        "/api/delete-product",
                        { id: id },
                        { headers: { token: this.user.token } }
                    )
                    .then((res) => {
                        alert(this.$t("operation-successful")),
                            location.reload();
                    })
                    .catch((err) => alert(this.$t("something-went-wrong")));
            }
        },
    },
};
</script>

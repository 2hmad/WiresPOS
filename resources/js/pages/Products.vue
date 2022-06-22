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
                        <div>
                            <router-link to="/add-product">
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
                        <template #table-row="props">
                            <span v-if="props.column.field == 'option'">
                                <button>{{ $t("edit") }}</button>
                                <button>{{ $t("delete") }}</button>
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
                    label: this.$t("store"),
                    field: "store.store_name",
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
    mounted() {
        axios
            .get("/api/products")
            .then((res) => (this.rows = res.data))
            .catch((err) => console.log(err));
    },
};
</script>

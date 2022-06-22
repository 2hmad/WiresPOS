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
                            <h3>Products</h3>
                            <p>List of all of your products</p>
                        </div>
                        <div>
                            <router-link to="/add-product">
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    New Product
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
                        style="margin-top: 3%"
                    >
                        <template #table-row="props">
                            <span v-if="props.column.field == 'option'">
                                <button>Edit</button>
                                <button>Delete</button>
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
                    label: "id",
                    field: "id",
                    hidden: true,
                },
                {
                    label: "Product",
                    field: "product_name",
                },
                {
                    label: "Price",
                    field: "price",
                },
                {
                    label: "Category",
                    field: "category.category_name",
                    sortable: false,
                },
                {
                    label: "Code",
                    field: "code",
                },
                {
                    label: "Store",
                    field: "store.store_name",
                    sortable: false,
                },
                {
                    label: "Option",
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

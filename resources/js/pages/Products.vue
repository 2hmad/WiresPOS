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
                        <template slot="table-row" slot-scope="props">
                            <span v-if="props.column.field == 'option'">
                                {{ props.row.name }}
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
export default {
    components: {
        Sidebar,
        VueGoodTable,
    },
    data() {
        return {
            columns: [
                {
                    label: "Product",
                    field: "name",
                },
                {
                    label: "Price",
                    field: "age",
                },
                {
                    label: "Category",
                    field: "age",
                    sortable: false,
                },
                {
                    label: "Code",
                    field: "Code",
                },
                {
                    label: "Store",
                    field: "Code",
                    sortable: false,
                },
                {
                    label: "Option",
                    field: "option",
                    sortable: false,
                },
            ],
            rows: [
                { id: 1, name: "John", age: 20, createdAt: "", score: 0.03343 },
                {
                    id: 2,
                    name: "Jane",
                    age: 24,
                    createdAt: "2011-10-31",
                    score: 0.03343,
                },
                {
                    id: 3,
                    name: "Susan",
                    age: 16,
                    createdAt: "2011-10-30",
                    score: 0.03343,
                },
                {
                    id: 4,
                    name: "Chris",
                    age: 55,
                    createdAt: "2011-10-11",
                    score: 0.03343,
                },
                {
                    id: 5,
                    name: "Dan",
                    age: 40,
                    createdAt: "2011-10-21",
                    score: 0.03343,
                },
                {
                    id: 6,
                    name: "John",
                    age: 20,
                    createdAt: "2011-10-31",
                    score: 0.03343,
                },
            ],
        };
    },
};
</script>

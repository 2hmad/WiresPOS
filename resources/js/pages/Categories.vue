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
                            <h3>{{ $t("categories") }}</h3>
                            <p>{{ $t("list-of-all-categories") }}</p>
                        </div>
                        <div>
                            <router-link
                                to="/add-category"
                                v-if="user.role == 'admin'"
                            >
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    {{ $t("new-category") }}
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
                                    <a :href="`/products/${props.row.id}`">
                                        <button class="show-action">
                                            <img
                                                src="/icons/icons8-surprise.svg"
                                            />
                                            {{ $t("browse") }}
                                        </button>
                                    </a>
                                    <a :href="`/edit-category/${props.row.id}`">
                                        <button
                                            class="edit-action"
                                            v-if="user.role == 'admin'"
                                        >
                                            <img src="/icons/icons8-edit.svg" />
                                            {{ $t("edit") }}
                                        </button>
                                    </a>
                                    <button
                                        class="delete-action"
                                        v-if="user.role == 'admin'"
                                        @click="deleteCat(props.row.id)"
                                    >
                                        <img src="/icons/icons8-delete.svg" />
                                        {{ $t("delete") }}
                                    </button>
                                </div>
                            </span>
                            <span
                                v-else-if="
                                    props.column.field == 'category_name'
                                "
                                style="
                                    display: flex;
                                    align-items: center;
                                    gap: 5px;
                                "
                            >
                                <img
                                    :src="`/storage/categories/${props.row.icon}`"
                                    style="
                                        max-width: 40px;
                                        height: 40px;
                                        border-radius: 50%;
                                        object-fit: cover;
                                    "
                                />
                                {{ props.row.category_name }}
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
                    label: this.$t("image"),
                    field: "icon",
                    hidden: true,
                },
                {
                    label: this.$t("category"),
                    field: "category_name",
                    width: "50%",
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
            .get("/api/categories")
            .then((result) => {
                this.rows = result.data;
            })
            .catch((err) => console.log(err));
    },
    methods: {
        deleteCat(id) {
            axios
                .post(
                    "/api/delete-category",
                    { id: id },
                    { headers: { token: this.user.token } }
                )
                .then((res) => {
                    alert(this.$t("operation-successful")), location.reload();
                })
                .catch((err) => alert(this.$t("something-went-wrong")));
        },
    },
};
</script>

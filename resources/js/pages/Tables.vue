<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="tables-page">
            <Sidebar />
            <div class="side">
                <div class="tables">
                    <div class="heading">
                        <div style="width: 100%">
                            <h3>{{ $t("tables") }}</h3>
                        </div>
                        <div
                            v-if="
                                store.business_type == '2' &&
                                user.role == 'admin'
                            "
                        >
                            <router-link to="/add-table">
                                <button class="add">
                                    <img src="/icons/icons8-plus-math.svg" />
                                    {{ $t("new-table") }}
                                </button>
                            </router-link>
                        </div>
                    </div>
                    <div class="cards">
                        <div
                            class="card"
                            v-for="table in tables"
                            :key="table.id"
                        >
                            <h3 class="table-no">
                                {{ $t("table") }} {{ table.table_number }}
                            </h3>
                            <h4 class="seats">
                                {{ $t("seats") }} : {{ table.seats_number }}
                            </h4>
                            <button
                                class="delete"
                                @click="deleteTable(table.id)"
                            >
                                {{ $t("delete") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import axios from "axios";
export default {
    components: {
        Sidebar,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            systemSettings: [],
            tables: [],
            store: [],
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-store",
                {},
                {
                    headers: {
                        token: this.user.token,
                    },
                }
            )
            .then((result) => {
                this.store = result.data;
            })
            .catch((err) => console.log(err));
        await axios
            .post(
                "/api/tables",
                {},
                {
                    headers: { token: this.user.token },
                }
            )
            .then((result) => {
                this.tables = result.data;
            })
            .catch((err) => console.log(err));
    },
    methods: {
        deleteTable(id) {
            axios
                .post(
                    "/api/delete-table",
                    { id: id },
                    {
                        headers: { token: this.user.token },
                    }
                )
                .then((result) => {
                    alert("done"), location.reload();
                })
                .catch((err) => console.log(err));
        },
    },
};
</script>

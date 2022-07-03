<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="addProduct">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("new-table") }}</h3>
                <form method="POST" @submit.prevent="addTable">
                    <div class="input-group">
                        <label for="table-number">
                            {{ $t("table-number") }}
                        </label>
                        <input
                            type="text"
                            :placeholder="$t('table-number')"
                            id="table-number"
                            v-model="form.table_number"
                        />
                    </div>
                    <div class="input-group">
                        <label for="seats-number">
                            {{ $t("seats-number") }}
                        </label>
                        <input
                            type="number"
                            :placeholder="$t('seats-number')"
                            id="seats-number"
                            v-model="form.seats_number"
                        />
                    </div>
                    <input
                        type="submit"
                        class="save"
                        :value="$t('add-table')"
                    />
                </form>
                <br />
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
            form: {
                table_number: "",
                seats_number: null,
            },
        };
    },
    methods: {
        addTable() {
            axios
                .post("/api/add-table", this.form, {
                    headers: {
                        token: this.user.token,
                    },
                })
                .then((result) => {
                    alert(this.$t("operation-successful")),
                        this.$router.push("/tables");
                })
                .catch((err) => {
                    alert(this.$t("something-went-wrong"));
                });
        },
    },
};
</script>

<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>Settings</h3>
                <SettingMenu />
                <form method="POST" @submit.prevent="addBranch">
                    <div class="input-group">
                        <label for="branchName">Branch name</label>
                        <input
                            type="text"
                            placeholder="Branch name"
                            id="branchName"
                            v-model="form.branch_name"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchAddress">Branch address</label>
                        <input
                            type="text"
                            placeholder="Branch address"
                            id="branchAddress"
                            v-model="form.branch_address"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchTel">Branch phone</label>
                        <input
                            type="tel"
                            placeholder="Branch phone"
                            id="branchTel"
                            v-model="form.branch_phone"
                        />
                    </div>
                    <input type="submit" class="save" value="Add Branch" />
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import SettingMenu from "../components/SettingMenu.vue";
import axios from "axios";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            form: {
                branch_name: "",
                branch_address: "",
                branch_phone: "",
            },
        };
    },
    methods: {
        addBranch() {
            axios
                .post("/api/add-branch", this.form, {
                    headers: {
                        token: this.user.token,
                    },
                })
                .then((succ) => {
                    alert(this.$t("branch-added")), location.reload();
                })
                .catch((err) => {
                    alert(this.$t("branch-exist"));
                });
        },
    },
};
</script>

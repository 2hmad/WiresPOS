<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="branches-page">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form method="POST" @submit.prevent="addBranch">
                    <div class="input-group">
                        <label for="branchName">{{ $t("branch-name") }}</label>
                        <input
                            type="text"
                            id="branchName"
                            v-model="form.branch_name"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchAddress">{{
                            $t("branch-address")
                        }}</label>
                        <input
                            type="text"
                            id="branchAddress"
                            v-model="form.branch_address"
                        />
                    </div>
                    <div class="input-group">
                        <label for="branchTel">{{ $t("branch-phone") }}</label>
                        <input
                            type="tel"
                            placeholder="Branch phone"
                            id="branchTel"
                            v-model="form.branch_phone"
                        />
                    </div>
                    <input
                        type="submit"
                        class="save"
                        :value="$t('add-branch')"
                    />
                    <h4 v-if="branches.length > 0">{{ $t("branches") }}</h4>
                    <div class="branches">
                        <div
                            class="item"
                            v-for="branch of branches"
                            :key="branch.id"
                        >
                            <div class="name">{{ branch.name }}</div>
                            <button
                                class="delete"
                                type="button"
                                @click="deleteBranch(branch.id)"
                            >
                                <img src="/icons/icons8-remove.svg" />
                            </button>
                        </div>
                    </div>
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
            branches: [],
            form: {
                branch_name: "",
                branch_address: "",
                branch_phone: "",
            },
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-branches",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => {
                this.branches = result.data;
            })
            .catch((err) => {
                console.log(err);
            });
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
        deleteBranch(id) {
            var confirm = window.confirm(this.$t("are-your-sure"));
            if (confirm) {
                axios
                    .post(
                        "/api/delete-branch",
                        {
                            id: id,
                        },
                        {
                            headers: {
                                token: this.user.token,
                            },
                        }
                    )
                    .then((succ) => {
                        alert(this.$t("branch-deleted")), location.reload();
                    })
                    .catch((err) => {
                        alert(this.$t("something-went-wrong"));
                    });
            }
        },
    },
};
</script>

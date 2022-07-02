<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <div class="container" style="gap: 0">
                    <div class="header">
                        <h3>{{ $t("add-branch") }}</h3>
                        <router-link to="/branches">
                            <font-awesome-icon :icon="['fas', 'angle-left']" />
                            {{ $t("branches") }}
                        </router-link>
                    </div>
                    <form method="POST" @submit.prevent="addBranch">
                        <div class="input-group">
                            <label for="branchName">
                                {{ $t("branch-name") }}
                            </label>
                            <input
                                type="text"
                                id="branchName"
                                v-model="form.branch_name"
                            />
                        </div>
                        <div class="input-group">
                            <label for="branchAddress">
                                {{ $t("branch-address") }}
                            </label>
                            <input
                                type="text"
                                id="branchAddress"
                                v-model="form.branch_address"
                            />
                        </div>
                        <div class="input-group">
                            <label for="branchEmail">
                                {{ $t("branch-email") }}
                            </label>
                            <input
                                type="email"
                                id="branchEmail"
                                v-model="form.branch_email"
                            />
                        </div>
                        <div class="input-group">
                            <label for="branchTel">
                                {{ $t("branch-phone") }}
                            </label>
                            <vue-tel-input
                                v-model="form.branch_phone"
                                mode="international"
                                :inputOptions="telInputOptions"
                                id="branchTel"
                            ></vue-tel-input>
                        </div>
                        <input
                            type="submit"
                            class="save"
                            :value="$t('add-branch')"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import { VueTelInput } from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
import axios from "axios";
export default {
    components: {
        Sidebar,
        VueTelInput,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            telInputOptions: {
                placeholder: this.$t("phone"),
            },
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
                    alert(this.$t("branch-added")),
                        this.$router.push("/branches");
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

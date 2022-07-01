<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="branches-page">
            <Sidebar />
            <div class="side">
                <div class="branches">
                    <div
                        class="branch-card"
                        v-for="branch in branches"
                        :key="branch.id"
                    >
                        <div class="info">
                            <div class="logo">
                                <img
                                    :src="`/images/placeholder-restaurant.png`"
                                />
                            </div>
                            <div class="information">
                                <span class="name">
                                    {{ branch.name }}
                                </span>
                                <span class="email">
                                    <font-awesome-icon
                                        :icon="['fas', 'envelope']"
                                    />
                                    {{ branch.email }}
                                </span>
                                <span class="phone">
                                    <font-awesome-icon
                                        :icon="['fas', 'phone']"
                                    />
                                    {{ branch.phone }}
                                </span>
                                <span class="address">
                                    <font-awesome-icon
                                        :icon="['fas', 'location-pin']"
                                    />
                                    {{ branch.address }}
                                </span>
                            </div>
                        </div>
                        <div class="current" v-if="user.branch == branch.id">
                            {{ $t("current") }}
                        </div>
                    </div>
                    <div class="upgrade" v-if="company.plan == 'free'">
                        <img src="/images/20943640.svg" />
                        <h3>{{ $t("upgrade-to-add-more-branches") }}</h3>
                        <router-link to="/upgrade">
                            <button class="upgrade-btn">
                                <font-awesome-icon :icon="['fas', 'crown']" />
                                {{ $t("upgrade") }}
                            </button>
                        </router-link>
                    </div>
                    <div class="add-branches" v-else>
                        <router-link to="/add-branch">
                            <button class="add-btn">
                                <font-awesome-icon :icon="['fas', 'plus']" />
                            </button>
                        </router-link>
                        <h3>{{ $t("add-more-branches") }}</h3>
                    </div>
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
            branches: [],
            company: [],
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
                this.company = result.data;
            })
            .catch((err) => console.log(err));
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

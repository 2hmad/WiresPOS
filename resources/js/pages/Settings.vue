<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <div class="container">
                    <div class="info">
                        <div class="logo">
                            <img
                                :src="`/storage/stores/${company.logo}`"
                                v-if="
                                    company.logo !== null && company.logo !== ''
                                "
                            />
                            <img
                                :src="`/images/placeholder-restaurant.png`"
                                v-else
                            />
                        </div>
                        <div class="information">
                            <span class="name"> {{ company.store_name }} </span>
                            <span class="email">
                                <font-awesome-icon
                                    :icon="['fas', 'envelope']"
                                />
                                {{ company.email }}
                            </span>
                            <span class="phone">
                                <font-awesome-icon :icon="['fas', 'phone']" />
                                {{ company.phone }}
                            </span>
                            <span class="package" v-if="company.plan == 'free'">
                                <font-awesome-icon :icon="['fas', 'box']" />
                                {{ $t("free-package") }}
                                <router-link to="/upgrade">
                                    <button class="upgrade">
                                        <font-awesome-icon
                                            :icon="['fas', 'crown']"
                                        />
                                        {{ $t("upgrade") }}
                                    </button>
                                </router-link>
                            </span>
                            <span class="package" v-else>
                                <font-awesome-icon
                                    :icon="['fas', 'crown']"
                                    color="#fcc201"
                                />
                                {{ $t("premium-package") }}
                            </span>
                        </div>
                    </div>
                    <router-link to="/company-info">
                        <button
                            class="edit-company-btn"
                            v-if="user.role == 'admin'"
                        >
                            <font-awesome-icon :icon="['fas', 'pen']" />
                            {{ $t("company-info") }}
                        </button>
                    </router-link>
                    <ul class="links">
                        <router-link to="/personal-info">
                            <li>
                                <div class="icon">
                                    <font-awesome-icon :icon="['fas', 'pen']" />
                                </div>
                                <div class="title">
                                    <span class="title">
                                        {{ $t("my-details") }}
                                    </span>
                                    <span class="desc">
                                        {{
                                            $t("edit-your-personal-information")
                                        }}
                                    </span>
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/password">
                            <li>
                                <div class="icon">
                                    <font-awesome-icon :icon="['fas', 'key']" />
                                </div>
                                <div class="title">
                                    <span class="title">
                                        {{ $t("password") }}
                                    </span>
                                    <span class="desc">
                                        {{ $t("edit-your-account-password") }}
                                    </span>
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/branches" v-if="user.role == 'admin'">
                            <li>
                                <div class="icon">
                                    <font-awesome-icon
                                        :icon="['fas', 'store']"
                                    />
                                </div>
                                <div class="title">
                                    <span class="title">
                                        {{ $t("branches") }}
                                    </span>
                                    <span class="desc">
                                        {{ $t("add-delete-branches") }}
                                    </span>
                                </div>
                            </li>
                        </router-link>
                        <router-link
                            to="/permissions"
                            v-if="user.role == 'admin'"
                        >
                            <li>
                                <div class="icon">
                                    <font-awesome-icon
                                        :icon="['fas', 'user-plus']"
                                    />
                                </div>
                                <div class="title">
                                    <span class="title">
                                        {{ $t("permissions") }}
                                    </span>
                                    <span class="desc">
                                        {{ $t("add-delete-admins-and-users") }}
                                    </span>
                                </div>
                            </li>
                        </router-link>
                        <router-link to="/system-settings">
                            <li>
                                <div class="icon">
                                    <font-awesome-icon
                                        :icon="['fas', 'gears']"
                                    />
                                </div>
                                <div class="title">
                                    <span class="title">
                                        {{ $t("system-settings") }}
                                    </span>
                                    <span class="desc">
                                        {{ $t("customize-your-system") }}
                                    </span>
                                </div>
                            </li>
                        </router-link>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import axios from "axios";
import { mapActions } from "vuex";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
export default {
    components: {
        Sidebar,
        FontAwesomeIcon,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            company: [],
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
                this.company = result.data;
            })
            .catch((err) => console.log(err));
    },
};
</script>

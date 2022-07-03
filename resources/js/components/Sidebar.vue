<template>
    <nav class="sidebar">
        <div class="brand">
            <img src="/images/WiresPOS.svg" />
        </div>
        <div class="items">
            <ul>
                <li>
                    <router-link to="/" class-active="active" exact>
                        <div class="icon">
                            <home-icon />
                        </div>
                        <div class="title">{{ $t("home") }}</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/menu" class-active="active" exact>
                        <div class="icon">
                            <cooking-pot-icon />
                        </div>
                        <div class="title">{{ $t("menu") }}</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/history" class-active="active" exact>
                        <div class="icon">
                            <clock-icon />
                        </div>
                        <div class="title">{{ $t("history") }}</div>
                    </router-link>
                </li>
                <li v-if="store.business_type == '2'">
                    <router-link to="/tables" class-active="active" exact>
                        <div class="icon">
                            <TableIcon />
                        </div>
                        <div class="title">{{ $t("tables") }}</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/categories" class-active="active" exact>
                        <div class="icon">
                            <product-icon />
                        </div>
                        <div class="title">{{ $t("categories") }}</div>
                    </router-link>
                </li>
                <li>
                    <router-link to="/settings" class-active="active" exact>
                        <div class="icon">
                            <settings-icon />
                        </div>
                        <div class="title">{{ $t("settings") }}</div>
                    </router-link>
                </li>
                <li>
                    <a href="#" @click="logout">
                        <div class="icon">
                            <logout-icon />
                        </div>
                        <div class="title">{{ $t("logout") }}</div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
import { mapActions } from "vuex";
import HomeIcon from "./HomeIcon.vue";
import CookingPotIcon from "./CookingPotIcon.vue";
import ClockIcon from "./ClockIcon.vue";
import ProductIcon from "./ProductIcon.vue";
import SettingsIcon from "./SettingsIcon.vue";
import TableIcon from "./TableIcon.vue";
import LogoutIcon from "./LogoutIcon.vue";
export default {
    components: {
        HomeIcon,
        CookingPotIcon,
        ClockIcon,
        ProductIcon,
        SettingsIcon,
        LogoutIcon,
        TableIcon,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
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
    },
    methods: {
        ...mapActions(["LogOut"]),
        async logout() {
            try {
                await this.LogOut();
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

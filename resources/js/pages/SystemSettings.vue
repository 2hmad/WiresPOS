<template>
    <div :class="`app-${$i18n.locale}`">
        <div class="setting">
            <Sidebar />
            <div class="side">
                <h3>{{ $t("settings") }}</h3>
                <SettingMenu />
                <form method="POST" @submit.prevent="updateSystem">
                    <div class="input-group" v-if="user.role == 'admin'">
                        <label for="tax">{{ $t("tax") }} (%)</label>
                        <input
                            type="number"
                            id="tax"
                            step="0.001"
                            v-model="form.tax"
                            required
                        />
                    </div>
                    <div class="input-group">
                        <label for="language">{{ $t("language") }}</label>
                        <select
                            id="language"
                            v-model="lang"
                            @change="setLanguage(lang)"
                        >
                            <option value="en">English</option>
                            <option value="ar">العربية</option>
                        </select>
                    </div>
                    <div class="input-group" v-if="user.role == 'admin'">
                        <label for="currency">{{
                            $t("system-currency")
                        }}</label>
                        <select id="currency" v-model="form.currency">
                            <option value="usd">{{ $t("usd") }}</option>
                            <option value="egp">{{ $t("egp") }}</option>
                        </select>
                    </div>
                    <input
                        type="submit"
                        class="save"
                        :value="$t('save-changes')"
                        v-if="user.role == 'admin'"
                    />
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from "../components/Sidebar.vue";
import SettingMenu from "../components/SettingMenu.vue";
import axios from "axios";
import store from "../store/";
export default {
    components: {
        Sidebar,
        SettingMenu,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("wiresPOSUser")),
            lang: "",
            locale: localStorage.getItem("wiresPOSLang"),
            form: {
                tax: null,
                currency: "",
            },
        };
    },
    async mounted() {
        await axios
            .post(
                "/api/get-settings",
                {},
                { headers: { token: this.user.token } }
            )
            .then((result) => {
                this.form.tax = result.data.tax_rate;
                this.form.currency = result.data.currency;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        setLanguage(item) {
            if (this.lang == "en") {
                this.$i18n.locale = "en";
                store.commit("setAppLanguage", "en");
            } else if (this.lang == "ar") {
                this.$i18n.locale = "ar";
                store.commit("setAppLanguage", "ar");
            }
        },
        updateSystem() {
            axios
                .post("/api/update-settings", this.form, {
                    headers: { token: this.user.token },
                })
                .then((result) => {
                    alert(this.$t("system-settings-updated")),
                        location.reload();
                })
                .catch((err) => {
                    alert(this.$t("something-went-wrong"));
                });
        },
    },
};
</script>

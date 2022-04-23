require("./bootstrap");
require("./assets/scss/main.scss");
import { createApp } from "vue";
import router from "./router";
import { createStore } from "vuex";
import { createI18n } from "vue-i18n";
import en from "./locales/en";
import ar from "./locales/ar";
import auth from "./store/auth";
import languageSwitcher from "./store/language";

// I18n Configurations
const messages = {
    en,
    ar,
};
const i18n = createI18n({
    locale: languageSwitcher.getters.getAppLanguage,
    messages,
});

const app = createApp({});
app.use(router);
app.use(auth, languageSwitcher);
app.use(i18n);
app.mount("#app");

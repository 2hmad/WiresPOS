require("./bootstrap");
require("./assets/scss/main.scss");
import { createApp } from "vue";
import router from "./router";
import { createStore } from "vuex";
import { createI18n } from "vue-i18n";
import en from "./locales/en";
import ar from "./locales/ar";

// I18n Configurations
const messages = {
    en,
    ar,
};
const store = createStore({
    state: {
        appLanguage: localStorage.getItem("appLanguage") || "en",
    },
    getters: {
        getAppLanguage: (state) => state.appLanguage,
    },
    mutations: {
        setAppLanguage(state, language) {
            state.appLanguage = language;
            localStorage.setItem("appLanguage", language);
        },
    },
});
const i18n = createI18n({
    locale: store.getters.getAppLanguage,
    messages,
});

const app = createApp({});
app.use(router);
app.use(store);
app.use(i18n);
app.mount("#app");

require("./bootstrap");
require("./assets/scss/main.scss");
import "vuetify/styles";
import { createApp, render } from "vue";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import router from "./router";
import { createStore } from "vuex";
import { createI18n } from "vue-i18n";
import en from "./locales/en";
import ar from "./locales/ar";
import { aliases, mdi } from "vuetify/lib/iconsets/mdi-svg";

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

// Vuetify Configuration
const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
});

const app = createApp({});
app.use(router);
app.use(store);
app.use(i18n);
app.use(vuetify);
app.mount("#app");

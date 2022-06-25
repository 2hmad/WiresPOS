require("./bootstrap");
require("./assets/scss/main.scss");
import { createApp } from "vue";
import router from "./router";
import { createI18n } from "vue-i18n/index";
import en from "./locales/en";
import ar from "./locales/ar";
import store from "./store";
// I18n Configurations
const messages = {
    en,
    ar,
};
const i18n = createI18n({
    locale: store.getters.getAppLanguage,
    messages,
});

const app = createApp({});

app.use(router);
app.use(store);
app.use(i18n);
app.mount("#app");

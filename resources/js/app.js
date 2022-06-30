require("./bootstrap");
require("./assets/scss/main.scss");
import { createApp } from "vue";
import router from "./router";
import { createI18n } from "vue-i18n/index";
import en from "./locales/en";
import ar from "./locales/ar";
import store from "./store";
import VueApexCharts from "vue3-apexcharts";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faPhone,
    faEnvelope,
    faBox,
    faPen,
    faKey,
    faStore,
    faUserPlus,
    faGears,
    faCrown,
    faAngleLeft,
    faEye,
    faCheckCircle,
    faMoneyBill,
    faCashRegister,
    faArrowRightArrowLeft,
} from "@fortawesome/free-solid-svg-icons";
const { DateTime } = require("luxon");
// I18n Configurations
const messages = {
    en,
    ar,
};
const i18n = createI18n({
    locale: store.getters.getAppLanguage,
    messages,
});
library.add(
    faPhone,
    faEnvelope,
    faBox,
    faPen,
    faKey,
    faStore,
    faUserPlus,
    faGears,
    faCrown,
    faAngleLeft,
    faEye,
    faCheckCircle,
    faMoneyBill,
    faCashRegister,
    faArrowRightArrowLeft
);

const app = createApp({});

app.config.globalProperties.$luxonDateTime = DateTime;
app.use(VueApexCharts);
app.use(router);
app.use(store);
app.use(i18n);
app.component("font-awesome-icon", FontAwesomeIcon);
app.mount("#app");

import { createApp } from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import auth from "./modules/auth";
import lang from "./modules/language";

const app = createApp({});
app.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        lang,
    },
    plugins: [createPersistedState()],
});

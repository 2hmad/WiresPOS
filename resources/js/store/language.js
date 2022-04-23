import { createStore } from "vuex";
export default createStore({
    state: {
        appLanguage: localStorage.getItem("appLanguage") || "en",
    },
    getters: {
        getAppLanguage: (state) => state.appLanguage,
    },
    actions: {},
    mutations: {
        setAppLanguage(state, language) {
            state.appLanguage = language;
            localStorage.setItem("appLanguage", language);
        },
    },
});

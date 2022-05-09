import getters from "./getters";

const state = {
    appLanguage: localStorage.getItem("wiresPOSLang") || "en",
};

const mutations = {
    setAppLanguage(state, language) {
        state.appLanguage = language;
        localStorage.setItem("wiresPOSLang", language);
    },
};

export default {
    state: state,
    mutations: mutations,
    getters: getters,
};

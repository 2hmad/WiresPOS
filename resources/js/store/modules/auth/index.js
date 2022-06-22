import getters from "./getters";

const state = {
    user: null,
};

const actions = {
    async LogIn({ commit }, user) {
        axios
            .post("/api/auth", user)
            .then((res) => {
                if (res.data.token) {
                    localStorage.setItem(
                        "wiresPOSUser",
                        JSON.stringify(res.data)
                    );
                    commit("setUser", user.get("email"));
                    document.location.reload();
                }
            })
            .catch((err) => alert("email or password incorrect"));
    },
    async LogOut({ commit }) {
        const user = null;
        commit("logout", user);
    },
};

const mutations = {
    setUser(state, email) {
        state.user = email;
    },
    logout(state, user) {
        state.user = user;
    },
};

export default {
    state: state,
    actions: actions,
    mutations: mutations,
    getters: getters,
};

import { createStore } from "vuex";
import axios from "axios";
export default createStore({
    state: {
        user: null,
    },
    getters: {
        isAuthenticated: (state) => !!state.user,
        StateUser: (state) => state.user,
    },
    actions: {
        async LogIn({ commit }, user) {
            axios
                .post("/api/auth", user)
                .then((res) => {
                    if (res.data.token) {
                        localStorage.setItem("user", JSON.stringify(res.data));
                        commit("setUser", user.get("email"));
                        document.location.reload();
                    }
                })
                .catch((err) => alert("Email or Password is incorrect"));
        },
        async LogOut({ commit }) {
            const user = null;
            commit("logout", user);
        },
    },
    mutations: {
        setUser(state, email) {
            state.user = email;
        },
        logout(state, user) {
            state.user = user;
        },
    },
});

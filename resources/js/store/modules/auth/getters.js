const isAuthenticated = (state) => !!state.user;
const StateUser = (state) => state.user;

export default {
    isAuthenticated,
    StateUser,
};

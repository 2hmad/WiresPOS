import { createWebHistory, createRouter } from "vue-router";
import Login from "../pages/Login.vue";
import Dashboard from "../pages/Dashboard.vue";
import Menu from "../pages/Menu.vue";
import History from "../pages/History.vue";

const routes = [
    {
        path: "/login",
        component: Login,
    },
    {
        path: "/",
        component: Dashboard,
    },
    {
        path: "/menu",
        component: Menu,
    },
    {
        path: "/history",
        component: History,
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes,
});

export default router;

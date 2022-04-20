import { createWebHistory, createRouter } from "vue-router";
import Login from "../pages/Login.vue";
import Dashboard from "../pages/Dashboard.vue";
import Menu from "../pages/Menu.vue";
import History from "../pages/History.vue";
import Products from "../pages/Products.vue";
import Setting from "../pages/Setting.vue";
import Password from "../pages/Password.vue";
import Permissions from "../pages/Permissions.vue";
import SystemSettings from "../pages/SystemSettings.vue";
import Branches from "../pages/Branches.vue";

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
    {
        path: "/products",
        component: Products,
    },
    {
        path: "/setting",
        component: Setting,
    },
    {
        path: "/password",
        component: Password,
    },
    {
        path: "/branches",
        component: Branches,
    },
    {
        path: "/permissions",
        component: Permissions,
    },
    {
        path: "/system-settings",
        component: SystemSettings,
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes,
});

export default router;

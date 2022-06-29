import { createWebHistory, createRouter } from "vue-router";
import Login from "../pages/Login.vue";
import Dashboard from "../pages/Dashboard.vue";
import Menu from "../pages/Menu.vue";
import History from "../pages/History.vue";
import Products from "../pages/Products.vue";
import Categories from "../pages/Categories.vue";
import AddProduct from "../pages/AddProduct.vue";
import AddCategory from "../pages/AddCategory.vue";
import EditCategory from "../pages/EditCategory.vue";
import Settings from "../pages/Settings.vue";
import PersonalInfo from "../pages/PersonalInfo.vue";
import Password from "../pages/Password.vue";
import Permissions from "../pages/Permissions.vue";
import SystemSettings from "../pages/SystemSettings.vue";
import CompanyInfo from "../pages/CompanyInfo.vue";
import Branches from "../pages/Branches.vue";
import store from "../store";
import Invoice from "../pages/Invoice.vue";
const routes = [
    {
        path: "/login",
        component: Login,
        meta: {
            guest: true,
        },
    },
    {
        path: "/",
        component: Dashboard,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/menu",
        component: Menu,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/history",
        component: History,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/products/:cat_id",
        component: Products,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/add-product/:cat_id",
        component: AddProduct,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/categories",
        component: Categories,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/add-category",
        component: AddCategory,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/edit-category/:id",
        component: EditCategory,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/settings",
        component: Settings,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/personal-info",
        component: PersonalInfo,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/password",
        component: Password,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/branches",
        component: Branches,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/company-info",
        component: CompanyInfo,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/permissions",
        component: Permissions,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/system-settings",
        component: SystemSettings,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/invoice/:id",
        component: Invoice,
        meta: {
            requiresAuth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.guest)) {
        if (store.getters.isAuthenticated) {
            next("/");
            return;
        }
        next();
    } else {
        next();
    }
});
export default router;

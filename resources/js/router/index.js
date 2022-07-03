import { createWebHistory, createRouter } from "vue-router";
import store from "../store";
const Login = () => import("../pages/Login.vue");
const Register = () => import("../pages/Register.vue");
const Dashboard = () => import("../pages/Dashboard.vue");
const Menu = () => import("../pages/Menu.vue");
const History = () => import("../pages/History.vue");
const Tables = () => import("../pages/Tables.vue");
const AddTable = () => import("../pages/AddTable.vue");
const Products = () => import("../pages/Products.vue");
const Categories = () => import("../pages/Categories.vue");
const AddProduct = () => import("../pages/AddProduct.vue");
const AddCategory = () => import("../pages/AddCategory.vue");
const EditCategory = () => import("../pages/EditCategory.vue");
const Settings = () => import("../pages/Settings.vue");
const PersonalInfo = () => import("../pages/PersonalInfo.vue");
const Password = () => import("../pages/Password.vue");
const Permissions = () => import("../pages/Permissions.vue");
const SystemSettings = () => import("../pages/SystemSettings.vue");
const CompanyInfo = () => import("../pages/CompanyInfo.vue");
const Branches = () => import("../pages/Branches.vue");
const AddBranch = () => import("../pages/AddBranch.vue");
const Invoice = () => import("../pages/Invoice.vue");
const Upgrade = () => import("../pages/Upgrade.vue");
const routes = [
    {
        path: "/login",
        component: Login,
        meta: {
            guest: true,
        },
    },
    {
        path: "/register",
        component: Register,
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
        path: "/tables",
        component: Tables,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/add-table",
        component: AddTable,
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
        path: "/add-branch",
        component: AddBranch,
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
    {
        path: "/upgrade",
        component: Upgrade,
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

import VueRouter from "vue-router";

import dashboard from "../components/TheDashboard";
import products from "../pages/productPage";
import createProduct from "../pages/productPage/CreateProduct";
import videos from "../pages/videos";

const routes = [
    {
        path: "/home",
        component: dashboard,
        name: "dashboard"
    },
    {
        path: "/products",
        component: products,
        name: "products"
    },
    {
        path: "/create-product",
        component: createProduct,
        name: "createProduct"
    },
    {
        path: "/videos",
        component: videos,
        name: "videos"
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;

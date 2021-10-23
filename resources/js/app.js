require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./routes/index";

import "vue-step-wizard/dist/vue-step-wizard.css";
import spinner from "vue-loading-overlay";
import { VueEditor } from "vue2-editor";
import VueUploadMultipleImage from "vue-upload-multiple-image";
import Multiselect from "vue-multiselect";
import Swal from "sweetalert2";
import VueApexCharts from "vue-apexcharts";

import TableRowCount from "./components/TableRowCount";

window.Vue = require("vue").default;
Vue.use(VueRouter);
Vue.use(VueApexCharts);

// SWEETALERT
window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    icon: "success",
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

Vue.filter("textSlice", function(value) {
    return value.slice(0, 40) + "...";
});

Vue.filter("removeHtmlTags", function(value) {
    return value.replace(/(<([^>]+)>)/gi, " ");
});

window.toast = Toast;
window.Fire = new Vue();

Vue.component("vue-editor", VueEditor);
Vue.component("multiselect", Multiselect);
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component("VueUploadMultipleImage", VueUploadMultipleImage);
Vue.component("TableRowCount", TableRowCount);
Vue.component("spinner", spinner);
Vue.component("apexchart", VueApexCharts);

const app = new Vue({
    el: "#app",
    router,
    data() {
        return {
            isLoading: false,
            fullPage: true,
            background: "#222",
            color: "#3366cc"
        };
    }
});

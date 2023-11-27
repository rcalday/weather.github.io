import Vue from "vue";
import VueRouter from "vue-router";
import VueMeta from "vue-meta";
import VueSweetAlert2 from "vue-sweetalert2";
import moment from "moment";
import momentZone from "moment-timezone";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import InputTag from "vue-input-tag";
import VueCryptojs from "vue-cryptojs";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap"; // This imports Bootstrap's JavaScript
import "popper.js";
import "jquery";
import "bootstrap/dist/js/bootstrap";

import Vuex from "vuex";

import App from "./App.vue";

import "./QueriesWebsite";

Vue.use(VueRouter);
Vue.use(VueMeta);
Vue.use(VueSweetAlert2);
Vue.use(VueCryptojs);
Vue.use(Vuex);
Vue.component("date-picker", DatePicker);
Vue.component("multiselect", Multiselect);
Vue.component("input-tag", InputTag);

const router = new VueRouter({
    mode: "history",
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                selector: to.hash,
            };
        } else {
            return { x: 0, y: 0 };
        }
    },
});

router.beforeEach((to, from, next) => {
    next();
});

Vue.prototype.$appEvents = new Vue();

new Vue({
    router,
    render: (h) => h(App),
}).$mount("#app");

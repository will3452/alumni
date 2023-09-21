import Vue from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Shared from './Shared';
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";


createInertiaApp({
  resolve: name => {
    let page = require(`./Pages/${name}`)
    page.default.layout = page.default.layout || Shared.MainLayout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)
    Vue.use(Toast, {});
    Vue.component('Link', Link)
    Vue.component('Head', Head)

    // auto import shared component
    for (let component in Shared) {
        Vue.component(component, Shared[component])
    }

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})

InertiaProgress.init()

import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import VueDOMPurifyHTML from 'vue-dompurify-html';
import { ZiggyVue } from 'ziggy';
import MainLayout from '@/Pages/Layouts/MainLayout.vue';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueDOMPurifyHTML)
      .use(ZiggyVue)
      .mount(el)
  },
})
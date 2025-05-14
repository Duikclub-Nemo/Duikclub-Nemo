import './bootstrap';

import {createInertiaApp} from '@inertiajs/vue3';
import {createApp, h} from 'vue';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import {CkeditorPlugin} from "@ckeditor/ckeditor5-vue";
import {createPinia} from "pinia";
import piniaPluginPersistedState from 'pinia-plugin-persistedstate'
import AppLayout from "@/Layouts/AppLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'Duikclub App';

const pinia = createPinia()
pinia.use(piniaPluginPersistedState)

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue',)
        const page = pages[`./Pages/${name}.vue`]()
        return page
            .then(page => {
                page.default.layout = page.default.layout || AppLayout;
                return page;
            })
    },
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(CkeditorPlugin)
            .use(pinia)
            .mount(el);
    },
    progress: {
        color: '#ea580c',
        includeCSS: false,
        showSpinner: true
    },
});

// ServiceWorker for Progressive Web App
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/serviceworker.js')
        .then(() => console.log('service worker registered'))
        .catch(() => console.log('service worker not registered'))
}

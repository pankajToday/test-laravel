import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Vapor from 'laravel-vapor';
import {VaporAssetsMixin} from "./Mixins/VaporAssetsMixin.js";


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel Test';
Vapor.withBaseAssetUrl(import.meta.env.VITE_VAPOR_ASSET_URL)

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mixin(VaporAssetsMixin)
            .mount(el)
    },
})

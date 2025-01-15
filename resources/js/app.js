import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import '../css/app.css';
import './bootstrap';
import {route} from 'ziggy-js';
import {i18nVue} from 'laravel-vue-i18n'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });

        vueApp.use(plugin);
        vueApp.use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
        vueApp.config.globalProperties.$route = route;
        vueApp.mount(el);
    },
})

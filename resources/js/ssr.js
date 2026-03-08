import {createInertiaApp} from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import {renderToString} from 'vue/server-renderer'
import {createSSRApp, h} from 'vue'
import {route, setZiggyConfig} from 'ziggy-js'
import {i18nVue} from 'laravel-vue-i18n'
import vClickOutside from 'click-outside-vue3'
import {createPinia} from 'pinia'

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: name => {
            const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
            return pages[`./Pages/${name}.vue`]
        },
        setup({ App, props, plugin }) {
            const ziggy = props?.ziggy ?? null
            setZiggyConfig(ziggy)

            const defaultZiggy = {
                url: props?.appUrl ?? '',
                port: null,
                defaults: {},
                routes: {},
                location: { host: '', pathname: '/', search: '' },
            }
            globalThis.Ziggy = ziggy
                ? {
                    url: ziggy.url ?? '',
                    port: ziggy.port ?? null,
                    defaults: ziggy.defaults ?? {},
                    routes:
                        typeof ziggy.routes === 'object' && ziggy.routes !== null
                            ? ziggy.routes
                            : {},
                    location: ziggy.location ?? defaultZiggy.location,
                }
                : defaultZiggy

            const vueApp = createSSRApp({ render: () => h(App, props) })

            vueApp.use(plugin)
            vueApp.use(i18nVue, {
                resolve: async lang => {
                    const langs = import.meta.glob('../../lang/*.json')
                    const loader = langs[`../../lang/${lang}.json`]
                    const mod = typeof loader === 'function' ? await loader() : loader
                    return mod?.default ?? mod ?? {}
                },
            })
            vueApp.use(vClickOutside)
            vueApp.use(createPinia())
            vueApp.config.globalProperties.$route = route
            vueApp.provide('route', route)
            return vueApp
        },
    }),
)

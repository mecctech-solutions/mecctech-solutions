import {createInertiaApp} from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import {renderToString} from 'vue/server-renderer'
import {createSSRApp, h} from 'vue'
import {route} from 'ziggy-js'
import {i18nVue} from 'laravel-vue-i18n'
import vClickOutside from 'click-outside-vue3'
import {createPinia} from 'pinia'

const port =
    parseInt(process.env.INERTIA_SSR_URL, 10) ||
    parseInt(process.env.VITE_INERTIA_SSR_URL, 10) ||
    13715
console.log('[SSR] INERTIA_SSR_URL:', process.env.INERTIA_SSR_URL ?? '(not set)')
console.log('[SSR] VITE_INERTIA_SSR_URL:', process.env.VITE_INERTIA_SSR_URL ?? '(not set)')
console.log('[SSR] Using port:', port)

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: name => {
            const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
            return pages[`./Pages/${name}.vue`]
        },
        setup({ App, props, plugin }) {
            const ziggy = page?.props?.ziggy
            if (ziggy) {
                globalThis.Ziggy = {
                    ...ziggy,
                    location: new URL(ziggy.url),
                }
            }

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
    port,
)

console.log('[SSR] Server started successfully on port', port)

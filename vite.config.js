import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import i18n from 'laravel-vue-i18n/vite';
import {watch} from "vite-plugin-watch"

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        i18n(),
        Components({
            dirs: ['resources/js/Components'],
            extensions: ['vue'],
            deep: true,
        }),
        watch({
            pattern: "app/{Data,Enums}/**/*.php",
            command: "php artisan typescript:transform",
        }),
    ],
});

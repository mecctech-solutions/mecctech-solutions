import path from 'path';
import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';
import i18n from 'laravel-vue-i18n/vite';
import {watch} from "vite-plugin-watch"

export default defineConfig({
    resolve: {
        alias: {
            'ziggy-js': path.resolve(__dirname, 'resources/js/ziggy-ssr.js'),
            'ziggy-js-original': path.resolve(__dirname, 'node_modules/ziggy-js'),
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            ssr: 'resources/js/ssr.js',
        }),
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

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/sass/app.scss',
                'resources/assets/js/site.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'legacy-js-api',
                    'import',
                    'global-builtin',
                    'color-functions',
                    'if-function',
                ],
            },
        },
    },
});

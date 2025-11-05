import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/layouts/dashboard/index.css',
                'resources/css/layouts/guest/index.css',
                'resources/css/libraries/tailwind.css',
                'resources/js/layouts/dashboard/index.js',
                'resources/js/layouts/guest/index.js',
                
                'resources/css/custom/fullcalendar.css',
                'resources/js/pages/dashboard/index.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/views/js',
        }
    }
});

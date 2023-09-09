import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/homepage.css',
                'resources/css/dashboard.css',
                'resources/css/fullauthpage.css',
                'resources/css/loginregister.css',
                'resources/css/modelselect.css',
                'resources/css/news.css',
                'resources/css/singlenews.css',
                'resources/css/compare.css',
                'resources/css/aboutus.css'

            ],
            refresh: true,
        }),
    ],
});

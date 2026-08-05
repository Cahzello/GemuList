import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/navbar/global.css',
                'resources/css/navbar/navbar.css',
                'resources/css/navbar/reset.css',
                'resources/css/footer/global.css',
                'resources/css/footer/footer.css',
                'resources/css/footer/reset.css',
                'resources/css/homepage/registrasi-gl.css',
                'resources/css/homepage/global.css',
                'resources/css/homepage/reset.css',
                'resources/css/priceCompare.css',
                'resources/js/app.js',
                'resources/js/dbPriceCompare.js',
                'resources/js/priceCompare.js'
            ],
            refresh: true,
        }),
    ],
});
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/personalScore.js',
                'resources/js/dbPriceCompare.js',
                'resources/js/priceCompare.js'
            ],
            refresh: true,
        }),
    ],
});
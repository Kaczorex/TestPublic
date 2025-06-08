import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 3000,
        cors: true,
        hmr: {
            protocol: 'ws',
            host: 'localhost',
            port: 3000,
            clientPort: 3000,
        },
    },
    plugins: [
        laravel({
                    input: ['resources/css/app.css', 'resources/js/app.js'],
                    refresh: true,
                }),
        vue(),
        tailwindcss()
    ],
});

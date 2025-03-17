// vite.config.js
import { defineConfig } from 'vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [svelte()],
    server: {
        cors: true,
        port: 3000,
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        outDir: 'public/assets',
        emptyOutDir: false,
        rollupOptions: {
            output: {
                entryFileNames: 'app.js',
                chunkFileNames: 'chunks/[name].js',
                assetFileNames: '[name].[ext]',
            },
            input: 'resources/js/app.js',
        },
    },
});

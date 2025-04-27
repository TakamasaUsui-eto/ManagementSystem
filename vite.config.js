import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/logout.js',
                'resources/js/fileSelect.js',
            ],
            refresh: true,
            build: {
                outDir: 'public/build',
                sourcemap: true,
                manifest: true,
            },
        }),
    ],
});

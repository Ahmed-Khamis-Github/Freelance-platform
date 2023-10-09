import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        outDir: 'public/js', // Output directory for compiled files
        rollupOptions: {
            input: {
                app: './resources/js/app.js', // Input file for your app code
                bootstrap: './resources/js/bootstrap.js', // Input file for Bootstrap code
            }
        }
    }
});

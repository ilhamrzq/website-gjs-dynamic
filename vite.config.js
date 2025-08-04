// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import react from '@vitejs/plugin-react';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: 'resources/js/app.jsx',
//             refresh: true,
//         }),
//         react(),
//     ],
// });
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.jsx",
            refresh: true,
        }),
        react(),
    ],
    server: {
        // Aktifkan CORS untuk development
        cors: true,
        // Tambahkan konfigurasi proxy
        proxy: {
            // Proxy semua request /api ke server Laravel
            "/api": {
                target: "http://localhost:8080", // Ganti dengan URL server Laravel Anda
                changeOrigin: true,
                secure: false,
            },
            // Jika Anda memiliki endpoint lain yang perlu di-proxy, tambahkan di sini
        },
        // Konfigurasi host agar bisa diakses dari luar
        // host: "10.251.2.49",
    },
});

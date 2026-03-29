import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/bootstrap.min.css',
                'resources/css/animate.css',
                'resources/css/typography.css',
                'resources/css/preloader.css',
                'resources/css/header.css',
                'resources/css/footer.css',
                'resources/css/blog-page.css',
                'resources/css/comon.css',
                'resources/css/animation.css',
                'resources/css/visafast-unit.css',
                'resources/css/visafast-core.css',
                'resources/css/responsive.css',
                'resources/css/font-awesome-pro.css',
                'resources/css/mobile-menu.css',
                'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
                'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
                'node_modules/slick-slider/slick/slick.css',
                'node_modules/aos/dist/aos.css',
                'node_modules/modal-video/css/modal-video.min.css',
                'node_modules/magnific-popup/dist/magnific-popup.css',
                'node_modules/jquery-nice-select/css/nice-select.css',
                'resources/js/frontend.js',
                'resources/js/app.ts'
            ],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});

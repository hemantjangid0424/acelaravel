<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/brand.webp">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LdSl4wsAAAAAPaXdIEVtdrWnq-XdZd37cGTvPOc"></script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EN7PGJ311M"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-EN7PGJ311M', {
        page_path: window.location.pathname,
    });
    </script>
  
    @vite(['resources/js/app.ts', 'resources/js/frontend.js',"resources/js/pages/{$page['component']}.vue"])
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.css', 'resources/css/typography.css', 'resources/css/preloader.css', 'resources/css/header.css', 'resources/css/footer.css', 'resources/css/blog-page.css', 'resources/css/comon.css', 'resources/css/animate.css', 'resources/css/animation.css', 'resources/css/visafast-unit.css', 'resources/css/visafast-core.css', 'resources/css/responsive.css', 'resources/css/font-awesome-pro.css', 'resources/css/mobile-menu.css', 'node_modules/owl.carousel/dist/assets/owl.carousel.min.css', 'node_modules/slick-slider/slick/slick.css', 'node_modules/aos/dist/aos.css', 'node_modules/modal-video/css/modal-video.min.css', 'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css', 'node_modules/magnific-popup/dist/magnific-popup.css', 'node_modules/jquery-nice-select/css/nice-select.css'])

    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>
</html>

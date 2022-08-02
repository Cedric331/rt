<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
    <video autoplay muted loop>
        <source src="{{ asset('storage/video/background.mp4') }}" type="video/mp4">
    </video>
        @inertia
    </body>
</html>

<script>
    document.querySelector('video').playbackRate = 0.6;
</script>

<style>
    video {
        z-index:-1;
        min-width: 100%; min-height: 100%;
        width: auto; height: auto; z-index: -100;
        background-size: cover;
        position: fixed;
    }

    /*#vidpause{*/
    /*    position: fixed;*/
    /*    bottom: 10px;*/
    /*    right: 10px;*/
    /*}*/
</style>

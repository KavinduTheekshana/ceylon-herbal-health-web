<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Title -->
    <title>Restraint - Yoga & Meditation HTML Template</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Sora:wght@100..800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{ asset('frontend/css/slicknav.min.css') }}" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <!-- Font Awesome Icon Css-->
    <link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!-- Mouse Cursor Css File -->
    <link rel="stylesheet" href="{{ asset('frontend/css/mousecursor.css') }}">
    <!-- Main Css -->
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet" media="screen">
    {{-- Custom css  --}}
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" media="screen">

    <!-- Swiper CSS (via CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />


    @stack('styles')
    {{-- @vite(['', 'resources/js/app.js']) --}}
</head>

<body>

    <!-- Preloader Start -->
    {{-- <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="images/loader.svg" alt=""></div>
        </div>
    </div> --}}
    <!-- Preloader End -->


    @include('frontend.components.header')
    @yield('content')
    @include('frontend.components.footer')
    {{-- SwiperJs --}}
    <!-- Swiper JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Swiper Init Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.our-testimonial-box', {
                slidesPerView: 1,
                loop: true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });
            console.log("Swiper initialized:", swiper);
        });
    </script>


    <!-- Jquery Library File -->
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('frontend/js/validator.min.js') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <!-- Swiper js file -->
    {{-- <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script> --}}
    <!-- Counter js file -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset('frontend/js/SmoothScroll.js') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('frontend/js/parallaxie.js') }}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magiccursor.js') }}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset('frontend/js/SplitText.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js') }}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset('frontend/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <!-- Wow js file -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset('frontend/js/function.js') }}"></script>
    @stack('scripts')
</body>

</html>

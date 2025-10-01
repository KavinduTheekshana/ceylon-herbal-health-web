<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/images/logoweb.svg')}}" alt="Logo" width="200">
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Services</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ's</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                            <li class="nav-item highlighted-menu"><a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.create') }}">Book Appointment</a></li>
                        </ul>
                    </div>

                    <!-- Header Contact Btn Start -->
                    <div class="header-contact-btn">
                        <a href="tel:+447349925427" class="header-contact-now"><i class="fa-solid fa-phone-volume"></i>+44 73 499 25427</a>
                        <a href="{{ route('appointments.create') }}" class="btn-default">Get Started</a>
                    </div>
                    <!-- Header Contact Btn End -->
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->
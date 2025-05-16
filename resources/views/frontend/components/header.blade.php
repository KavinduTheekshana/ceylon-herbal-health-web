  <!-- Header Start -->
  <header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('/') }}">
                    <img src="{{ asset('frontend/images/logoweb.svg')}}" alt="Logo" width="200">
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">

                            <li class="nav-item"><a class="nav-link" href="/">Home</a>
                                <li class="nav-item"><a class="nav-link" href="/about">About Us</a>
                            <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="blog.html">Faq's</a></li>

                            <li class="nav-item"><a class="nav-link" href="/contact">Contact Us</a></li>
                            <li class="nav-item highlighted-menu"><a class="nav-link" href="book-appointment.html">Book Appointment</a></li>
                        </ul>
                    </div>

                    <!-- Header Contact Btn Start -->
                    <div class="header-contact-btn">
                        <a href="tel:+447349925427" class="header-contact-now"><i class="fa-solid fa-phone-volume"></i>+44 73 499 25427</a>
                        <a href="book-appointment.html" class="btn-default">Get Started</a>
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

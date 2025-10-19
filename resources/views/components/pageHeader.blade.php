<!-- Page Header Start -->
<div class="page-header parallaxie" style="background-image: url('{{ $backgroundImage ?? asset('frontend/images/slider1.webp') }}');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $title ?? 'Page Title' }}</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                            @if(isset($parentPage) && isset($parentUrl))
                                <li class="breadcrumb-item"><a href="{{ $parentUrl }}">{{ $parentPage }}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb ?? strtolower($title ?? 'page') }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

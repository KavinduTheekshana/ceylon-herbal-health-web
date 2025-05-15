@extends('layouts.frontend')

@section('content')
    @include('frontend.home.slider')
    @include('frontend.home.about')
    @include('frontend.home.services')
    @include('frontend.home.whatWeDo')
    @include('frontend.home.whyChooseUs')
    @include('frontend.home.ourBenifits')
    {{-- @include('frontend.home.introVideo') --}}
    @include('frontend.home.cta')
    @include('frontend.home.howItsWork')
    @include('frontend.home.ourFeatures')
    {{-- @include('frontend.home.ourPricing') --}}
    @include('frontend.home.scrollingTicker')
    @include('frontend.home.ourTestimonials')
    @include('frontend.home.faq')
    @include('frontend.home.blogs')
@endsection

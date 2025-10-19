{{-- File: resources/views/frontend/home/index.blade.php --}}

@extends('layouts.frontend')

@section('title', 'Ceylon Herbal Health - Authentic Ceylon Ayurveda & Wellness in the UK')

@section('meta_description', 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health. Book your personalized consultation with our qualified practitioners in the United Kingdom. Natural herbal remedies and traditional healing methods.')

@section('meta_keywords', 'Ayurveda UK, Ceylon Ayurveda, Herbal Medicine UK, Natural Healing, Ayurvedic Treatment, Traditional Medicine, Holistic Health, Wellness Center UK, Ayurvedic Consultation, Herbal Therapy')

@section('og_title', 'Ceylon Herbal Health - Authentic Ceylon Ayurveda in the UK')
@section('og_description', 'Discover natural healing through authentic Ceylon Ayurveda. Book your personalized wellness consultation today.')

@section('content')
    @include('frontend.home.slider')
    @include('frontend.home.appointmentBooking')  {{-- NEW: Added appointment booking section --}}
    @include('frontend.home.about')
    @include('frontend.home.services')
    @include('frontend.home.whatWeDo')
    @include('frontend.home.whyChooseUs')
    {{-- @include('frontend.home.ourBenifits') --}}
    {{-- @include('frontend.home.introVideo') --}}
    @include('frontend.home.cta')
    @include('frontend.home.howItsWork')
    {{-- @include('frontend.home.ourFeatures') --}}
    {{-- @include('frontend.home.ourPricing') --}}
    @include('frontend.home.scrollingTicker')
    @include('frontend.home.ourTestimonials')
    @include('frontend.home.faq')
    @include('frontend.home.blogs')
@endsection
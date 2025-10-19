@extends('layouts.frontend')

@section('title', 'About Us - Ceylon Herbal Health | Authentic Ceylon Ayurveda in the UK')
@section('meta_description', 'Learn about Ceylon Herbal Health and our mission to bring authentic Ceylon Ayurveda to the United Kingdom. Meet our qualified practitioners, discover our healing philosophy, and understand our traditional approach to wellness.')
@section('meta_keywords', 'About Ceylon Herbal Health, Ayurveda Practitioners UK, Ceylon Healing, Traditional Medicine Experts, Ayurvedic Clinic UK, Our Team, Wellness Philosophy')

@section('og_title', 'About Ceylon Herbal Health - Authentic Ayurveda Practitioners')
@section('og_description', 'Discover our story, meet our expert practitioners, and learn about our commitment to authentic Ceylon Ayurvedic healing.')

@section('content')
    @include('frontend.about.pageHeader')
    @include('frontend.home.about')
    @include('frontend.about.approach')
    @include('frontend.home.whatWeDo')
    @include('frontend.about.howWeAre')
    @include('frontend.home.whyChooseUs')
    @include('frontend.about.ourExpertise')
    @include('frontend.about.ourTeam')
    @include('frontend.home.scrollingTicker')
    @include('frontend.home.ourTestimonials')
    @include('frontend.about.appointment')
    @include('frontend.home.faq')
@endsection

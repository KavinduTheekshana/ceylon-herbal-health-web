@extends('layouts.frontend')

@section('title', 'Our Ayurvedic Services - Ceylon Herbal Health')
@section('meta_description', 'Explore our range of authentic Ceylon Ayurvedic treatments including herbal therapies, wellness consultations, massage therapies, and traditional healing services in the United Kingdom.')
@section('meta_keywords', 'Ayurvedic Services UK, Herbal Treatments, Wellness Services, Ayurveda Therapies, Traditional Healing, Panchakarma, Abhyanga, Shirodhara, Ayurvedic Massage')

@section('og_title', 'Ayurvedic Services - Ceylon Herbal Health UK')
@section('og_description', 'Discover our comprehensive range of authentic Ceylon Ayurvedic treatments and wellness services. Book your healing session today.')

@section('content')
        @include('components.pageHeader', ['title' => 'Our Services'])
    @include('frontend.services.servicesList')
    @include('frontend.services.whyChooseUs')
    @include('frontend.home.ourTestimonials')
    @include('frontend.services.faqs')
@endsection
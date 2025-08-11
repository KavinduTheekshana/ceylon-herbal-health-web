@extends('layouts.frontend')

@section('content')
    @include('frontend.services.pageHeader')
    @include('frontend.services.servicesList')
    @include('frontend.services.whyChooseUs')
    @include('frontend.home.ourTestimonials')
    @include('frontend.services.faqs')
@endsection
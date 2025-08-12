@extends('layouts.frontend')

@section('title', 'Testimonials - What Our Clients Say')

@section('meta_description', 'Read real testimonials and reviews from our satisfied clients. Discover how our yoga and meditation programs have transformed lives.')

@section('content')
    @include('frontend.testimonials.pageHeader')
    @include('frontend.testimonials.testimonialsList')
    @include('frontend.testimonials.whyChooseUs')
    <x-faq-section :limit="5" />
@endsection
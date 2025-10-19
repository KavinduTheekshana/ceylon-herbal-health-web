@extends('layouts.frontend')

@section('title', 'Book Appointment - Ceylon Herbal Health | Online Booking')
@section('meta_description', 'Book your personalized Ayurvedic consultation online at Ceylon Herbal Health. Choose from our qualified therapists, select your preferred date and time, and begin your journey to natural wellness.')
@section('meta_keywords', 'Book Ayurveda Appointment UK, Online Ayurvedic Booking, Schedule Consultation, Wellness Appointment, Herbal Medicine Booking, Ayurveda Therapist Booking')

@section('og_title', 'Book Your Ayurvedic Appointment - Ceylon Herbal Health')
@section('og_description', 'Schedule your personalized Ayurvedic consultation with our experienced practitioners. Easy online booking with flexible time slots.')

@section('content')
<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque">Book Your Appointment</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">book appointment</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Include the appointment booking section -->
@include('frontend.home.appointmentBooking')
@endsection
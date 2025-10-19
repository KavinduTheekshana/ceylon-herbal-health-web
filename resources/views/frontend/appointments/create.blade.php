@extends('layouts.frontend')

@section('title', 'Book Appointment - Ceylon Herbal Health | Online Booking')
@section('meta_description', 'Book your personalized Ayurvedic consultation online at Ceylon Herbal Health. Choose from our qualified therapists, select your preferred date and time, and begin your journey to natural wellness.')
@section('meta_keywords', 'Book Ayurveda Appointment UK, Online Ayurvedic Booking, Schedule Consultation, Wellness Appointment, Herbal Medicine Booking, Ayurveda Therapist Booking')

@section('og_title', 'Book Your Ayurvedic Appointment - Ceylon Herbal Health')
@section('og_description', 'Schedule your personalized Ayurvedic consultation with our experienced practitioners. Easy online booking with flexible time slots.')

@section('content')
    @include('components.pageHeader', ['title' => 'Book Appointment'])

<!-- Include the appointment booking section -->
@include('frontend.home.appointmentBooking')
@endsection
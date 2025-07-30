@extends('layouts.frontend')

@section('title', 'Book Your Appointment')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-content">
                    <h1>Book Your Appointment</h1>
                    <p>Schedule your personalized Ayurvedic consultation with our qualified practitioners</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include the appointment booking section -->
@include('frontend.home.appointmentBooking')
@endsection
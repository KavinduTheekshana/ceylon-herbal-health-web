@extends('layouts.frontend')

@section('title', 'Frequently Asked Questions')

@section('meta_description', 'Find answers to commonly asked questions about our yoga and meditation services, appointments, pricing, and more.')

@section('meta_keywords', 'FAQ, questions, yoga FAQ, meditation questions, appointment booking, pricing, services')

@section('content')
       @include('components.pageHeader', ['title' => 'Frequently Asked Questions'])
    @include('frontend.faq.faqContent')
@endsection
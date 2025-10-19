@extends('layouts.frontend')

@section('title', ($service->seo_title ?? $service->title . ' - Ceylon Herbal Health'))
@section('meta_description', ($service->seo_description ?? $service->short_description ?? Str::limit(strip_tags($service->description), 155)))
@section('meta_keywords', ($service->seo_keywords ?? $service->title . ', Ayurvedic Treatment, Natural Healing, Ceylon Herbal Health, London'))

@section('og_type', 'article')
@section('og_title', $service->title . ' - Authentic Ayurvedic Treatment')
@section('og_description', ($service->short_description ?? Str::limit(strip_tags($service->description), 200)))
@section('og_image', ($service->image ? asset('storage/' . $service->image) : asset('images/og-image.jpg')))

@section('canonical', route('services.show', $service->slug))

@section('content')
    @include('frontend.services.single.pageHeader')
    @include('frontend.services.single.serviceContent')
@endsection
@extends('layouts.frontend')

@section('title', 'Our Blog')

@section('meta_description', 'Explore insights on yoga, meditation, wellness, and holistic health practices. Stay updated with tips and guides for a balanced lifestyle.')

@section('content')
    @include('components.pageHeader', ['title' => 'Blog'])
    @include('frontend.blog.blogList')
@endsection
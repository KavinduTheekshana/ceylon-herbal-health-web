@extends('layouts.frontend')

@section('title', $post->meta_title ?: $post->title)

@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('meta_keywords', $post->meta_keywords ? implode(', ', $post->meta_keywords) : '')

@section('content')
    @include('frontend.blog.single.pageHeader')
    @include('frontend.blog.single.postContent')
@endsection
@props(['limit' => 3])

@php
    use App\Models\BlogPost;
    
    $posts = BlogPost::with(['category', 'author'])
        ->published()
        ->latest()
        ->limit($limit)
        ->get();
@endphp

@if($posts->count() > 0)
    <!-- Our Blog Section Start -->
    <div class="our-blog">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Latest blog</h3>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">Explore natural healing, <span>wellness and herbal wisdom</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Title Content Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                        <a href="{{ route('blog.index') }}" class="btn-default">View all post</a>
                    </div>
                    <!-- Section Title Content End -->
                </div>
            </div>

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <!-- Post Item Start -->
                        <div class="post-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                            <!-- Post Featured Image Start-->
                            <div class="post-featured-image">
                                <a href="{{ route('blog.show', $post->slug) }}" data-cursor-text="View">
                                    <figure class="image-anime">
                                        @if($post->featured_image)
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                        @else
                                            <img src="{{ asset('frontend/images/post-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $post->title }}">
                                        @endif
                                    </figure>
                                </a>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- Post Item Body Start -->
                            <div class="post-item-body">
                                <!-- Post Item Content Start -->
                                <div class="post-item-content">
                                    <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                </div>
                                <!-- Post Item Content End -->

                                <!-- Post Item Readmore Button Start-->
                                <div class="post-item-btn">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">read more</a>
                                </div>
                                <!-- Post Item Readmore Button End-->
                            </div>
                            <!-- Post Item Body End -->
                        </div>
                        <!-- Post Item End -->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Our Blog Section End -->
@endif
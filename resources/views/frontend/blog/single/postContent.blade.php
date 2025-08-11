<!-- Page Single Post Start -->
<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post Featured Image Start -->
                <div class="post-image">
                    <figure class="image-anime reveal">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('frontend/images/post-1.jpg') }}" alt="{{ $post->title }}">
                        @endif
                    </figure>
                </div>
                <!-- Post Featured Image Start -->

                <!-- Post Single Content Start -->
                <div class="post-content">
                    <!-- Post Entry Start -->
                    <div class="post-entry">
                        {!! $post->content !!}
                    </div>
                    <!-- Post Entry End -->

                    <!-- Post Tag Links Start -->
                    <div class="post-tag-links">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                @if($post->tags->count() > 0)
                                    <!-- Post Tags Start -->
                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                        <span class="tag-links">
                                            Tags:
                                            @foreach($post->tags as $tag)
                                                <a href="#">{{ $tag->name }}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                    <!-- Post Tags End -->
                                @endif
                            </div>

                            <div class="col-lg-4">
                                <!-- Post Social Links Start -->
                                <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Post Social Links End -->
                            </div>
                        </div>
                    </div>
                    <!-- Post Tag Links End -->
                </div>
                <!-- Post Single Content End -->

                @if($relatedPosts->count() > 0)
                    <!-- Related Posts Section Start -->
                    <div class="related-posts mt-5">
                        <h2 class="text-center mb-4">Related Posts</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-lg-4 col-md-6">
                                    <!-- Post Item Start -->
                                    <div class="post-item">
                                        <!-- Post Featured Image Start-->
                                        <div class="post-featured-image">
                                            <a href="{{ route('blog.show', $relatedPost->slug) }}" data-cursor-text="View">
                                                <figure class="image-anime">
                                                    @if($relatedPost->featured_image)
                                                        <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}">
                                                    @else
                                                        <img src="{{ asset('frontend/images/post-' . (($loop->index % 6) + 1) . '.jpg') }}" alt="{{ $relatedPost->title }}">
                                                    @endif
                                                </figure>
                                            </a>
                                        </div>
                                        <!-- Post Featured Image End -->

                                        <!-- Post Item Content Start -->
                                        <div class="post-item-content">
                                            <h2><a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a></h2>
                                        </div>
                                        <!-- Post Item Content End -->

                                        <!-- Blog Item Button Start -->
                                        <div class="blog-item-btn">
                                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="readmore-btn">view details</a>
                                        </div>
                                        <!-- Blog Item Button End -->
                                    </div>
                                    <!-- Post Item End -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Related Posts Section End -->
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Page Single Post End -->
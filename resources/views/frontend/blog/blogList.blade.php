<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="row">
            @forelse($posts as $post)
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
                                        <img src="{{ asset('frontend/images/post-' . (($loop->index % 6) + 1) . '.jpg') }}" alt="{{ $post->title }}">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <!-- Post Featured Image End -->

                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Blog Item Button Start -->
                        <div class="blog-item-btn">
                            <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">view details</a>
                        </div>
                        <!-- Blog Item Button End -->
                    </div>
                    <!-- Post Item End -->
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h3>No blog posts available</h3>
                        <p>Check back soon for new content!</p>
                    </div>
                </div>
            @endforelse

            @if($posts->count() > 0)
                <div class="col-lg-12">
                    <!-- Page Pagination Start -->
                    <div class="page-pagination wow fadeInUp" data-wow-delay="{{ $posts->count() * 0.2 }}s">
                        {{ $posts->links('frontend.partials.pagination') }}
                    </div>
                    <!-- Page Pagination End -->
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Page Blog End -->
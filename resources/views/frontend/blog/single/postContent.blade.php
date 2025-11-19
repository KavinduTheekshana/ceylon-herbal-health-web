<!-- Page Single Post Start -->
<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
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
                <!-- Post Featured Image End -->

                <!-- Post Meta Information Start -->
                <div class="post-meta-info" style="display: flex; flex-wrap: wrap; gap: 20px; margin: 25px 0; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                    @if($post->category)
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-folder" style="color: {{ $post->category->color }}"></i>
                            <span>
                                <strong>Category:</strong>
                                <a href="{{ route('blog.category', $post->category->slug) }}" style="color: {{ $post->category->color }}; font-weight: 600;">
                                    {{ $post->category->name }}
                                </a>
                            </span>
                        </div>
                    @endif

                    @if($post->author)
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-user" style="color: #666;"></i>
                            <span><strong>Author:</strong> {{ $post->author->name }}</span>
                        </div>
                    @endif

                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-calendar" style="color: #666;"></i>
                        <span><strong>Published:</strong> {{ $post->published_at->format('F d, Y') }}</span>
                    </div>

                    @if($post->reading_time)
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-clock" style="color: #666;"></i>
                            <span><strong>Reading Time:</strong> {{ $post->reading_time }} min</span>
                        </div>
                    @endif

                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-eye" style="color: #666;"></i>
                        <span><strong>Views:</strong> {{ number_format($post->views_count) }}</span>
                    </div>
                </div>
                <!-- Post Meta Information End -->

                <!-- Post Single Content Start -->
                <div class="post-content">
                    <!-- Post Entry Start -->
                    <div class="post-entry" style="line-height: 1.8; font-size: 16px; color: #333;">
                        {!! $post->content !!}
                    </div>
                    <!-- Post Entry End -->

                    <!-- Post Tag Links Start -->
                    <div class="post-tag-links" style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #eee;">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                @if($post->tags->count() > 0)
                                    <!-- Post Tags Start -->
                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                        <span class="tag-links" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                                            <strong style="font-size: 14px;">Tags:</strong>
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" style="display: inline-block; padding: 6px 14px; background: {{ $tag->color }}; color: white; border-radius: 20px; font-size: 13px; text-decoration: none; transition: all 0.3s;">
                                                    {{ $tag->name }}
                                                </a>
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
                                <div class="col-lg-12 col-md-12">
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
                                            <div class="post-meta" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 12px; font-size: 13px; color: #666;">
                                                <span style="display: inline-flex; align-items: center; gap: 5px;">
                                                    <i class="fa-solid fa-calendar"></i>
                                                    {{ $relatedPost->published_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                            <h2><a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a></h2>
                                        </div>
                                        <!-- Post Item Content End -->

                                        <!-- Blog Item Button Start -->
                                        <div class="blog-item-btn">
                                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="readmore-btn">Read More</a>
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

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Recent Posts Widget -->
                    @if(isset($recentPosts) && $recentPosts->count() > 0)
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.2s" style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600;">Recent Posts</h3>
                            @foreach($recentPosts as $recentPost)
                                <div style="display: flex; gap: 15px; margin-bottom: 15px; padding-bottom: 15px; {{ !$loop->last ? 'border-bottom: 1px solid #dee2e6;' : '' }}">
                                    @if($recentPost->featured_image)
                                        <div style="flex-shrink: 0;">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                <img src="{{ asset('storage/' . $recentPost->featured_image) }}" alt="{{ $recentPost->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                            </a>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 style="font-size: 14px; margin-bottom: 5px;">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}" style="color: #333; font-weight: 600; line-height: 1.4;">
                                                {{ Str::limit($recentPost->title, 60) }}
                                            </a>
                                        </h4>
                                        <span style="font-size: 12px; color: #888;">
                                            <i class="fa-solid fa-calendar"></i> {{ $recentPost->published_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Categories Widget -->
                    @if(isset($categories) && $categories->count() > 0)
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.4s" style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600;">Categories</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                @foreach($categories as $category)
                                    <li style="margin-bottom: 12px;">
                                        <a href="{{ route('blog.category', $category->slug) }}" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; border-radius: 5px; transition: all 0.3s;">
                                            <span style="display: flex; align-items: center; gap: 8px;">
                                                <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $category->color }};"></span>
                                                {{ $category->name }}
                                            </span>
                                            <span style="background: {{ $category->color }}; color: white; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                                {{ $category->posts_count ?? 0 }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Share This Post Widget -->
                    <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.6s" style="background: #f8f9fa; padding: 25px; border-radius: 8px;">
                        <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600;">Share This Post</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" style="flex: 1; min-width: 120px; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #1877f2; color: white; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                                <i class="fa-brands fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" style="flex: 1; min-width: 120px; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #000000; color: white; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                                <i class="fa-brands fa-x-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" style="flex: 1; min-width: 120px; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #0077b5; color: white; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                                <i class="fa-brands fa-linkedin-in"></i> LinkedIn
                            </a>
                            <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(request()->url()) }}" style="flex: 1; min-width: 120px; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: #ea4335; color: white; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                                <i class="fa-solid fa-envelope"></i> Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Single Post End -->
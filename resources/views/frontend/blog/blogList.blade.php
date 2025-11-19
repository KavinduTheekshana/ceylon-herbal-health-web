<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-lg-6 col-md-6">
                            <!-- Post Item Start -->
                            <div class="post-item wow fadeInUp" data-wow-delay="{{ $loop->index * 0.2 }}s">
                                <!-- Post Featured Image Start-->
                                <div class="post-featured-image">
                                    @if($post->is_featured)
                                        <span class="badge badge-featured" style="position: absolute; top: 15px; right: 15px; background: #ff6b6b; color: white; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; z-index: 1;">FEATURED</span>
                                    @endif
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
                                    <!-- Post Meta Start -->
                                    <div class="post-meta" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 12px; font-size: 13px; color: #666;">
                                        @if($post->category)
                                            <span style="display: inline-flex; align-items: center; gap: 5px;">
                                                <i class="fa-solid fa-folder" style="color: {{ $post->category->color }}"></i>
                                                <a href="{{ route('blog.category', $post->category->slug) }}" style="color: {{ $post->category->color }}; font-weight: 500;">
                                                    {{ $post->category->name }}
                                                </a>
                                            </span>
                                        @endif
                                        <span style="display: inline-flex; align-items: center; gap: 5px;">
                                            <i class="fa-solid fa-calendar"></i>
                                            {{ $post->published_at->format('M d, Y') }}
                                        </span>
                                        @if($post->reading_time)
                                            <span style="display: inline-flex; align-items: center; gap: 5px;">
                                                <i class="fa-solid fa-clock"></i>
                                                {{ $post->reading_time }} min read
                                            </span>
                                        @endif
                                    </div>
                                    <!-- Post Meta End -->

                                    <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>

                                    @if($post->excerpt)
                                        <p style="margin-top: 10px; color: #666; font-size: 14px; line-height: 1.6;">
                                            {{ Str::limit($post->excerpt, 120) }}
                                        </p>
                                    @endif

                                    <!-- Author Info -->
                                    @if($post->author)
                                        <div class="post-author" style="display: flex; align-items: center; gap: 10px; margin-top: 12px; padding-top: 12px; border-top: 1px solid #eee;">
                                            <span style="font-size: 13px; color: #888;">
                                                <i class="fa-solid fa-user"></i> By <strong>{{ $post->author->name }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <!-- Post Item Content End -->

                                <!-- Blog Item Button Start -->
                                <div class="blog-item-btn">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">Read More</a>
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

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Categories Widget -->
                    @if(isset($categories) && $categories->count() > 0)
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.2s" style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
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

                    <!-- Featured Posts Widget -->
                    @if(isset($featuredPosts) && $featuredPosts->count() > 0)
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.4s" style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
                            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600;">Featured Posts</h3>
                            @foreach($featuredPosts as $featuredPost)
                                <div style="display: flex; gap: 15px; margin-bottom: 15px; padding-bottom: 15px; {{ !$loop->last ? 'border-bottom: 1px solid #dee2e6;' : '' }}">
                                    @if($featuredPost->featured_image)
                                        <div style="flex-shrink: 0;">
                                            <a href="{{ route('blog.show', $featuredPost->slug) }}">
                                                <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                            </a>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 style="font-size: 14px; margin-bottom: 5px;">
                                            <a href="{{ route('blog.show', $featuredPost->slug) }}" style="color: #333; font-weight: 600; line-height: 1.4;">
                                                {{ Str::limit($featuredPost->title, 60) }}
                                            </a>
                                        </h4>
                                        <span style="font-size: 12px; color: #888;">
                                            <i class="fa-solid fa-calendar"></i> {{ $featuredPost->published_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Popular Tags Widget -->
                    @if(isset($popularTags) && $popularTags->count() > 0)
                        <div class="sidebar-widget wow fadeInUp" data-wow-delay="0.6s" style="background: #f8f9fa; padding: 25px; border-radius: 8px;">
                            <h3 style="margin-bottom: 20px; font-size: 20px; font-weight: 600;">Popular Tags</h3>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                                @foreach($popularTags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" style="display: inline-block; padding: 6px 14px; background: {{ $tag->color }}; color: white; border-radius: 20px; font-size: 13px; transition: all 0.3s;">
                                        {{ $tag->name }}
                                        @if($tag->posts_count > 0)
                                            <span style="opacity: 0.8;">({{ $tag->posts_count }})</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Blog End -->
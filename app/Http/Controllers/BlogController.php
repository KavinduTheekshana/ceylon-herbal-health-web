<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request): View
    {
        $posts = BlogPost::with(['category', 'author', 'tags'])
            ->published()
            ->latest()
            ->paginate(6);

        $categories = BlogCategory::active()
            ->ordered()
            ->withCount(['posts' => function ($query) {
                $query->published();
            }])
            ->get();

        $featuredPosts = BlogPost::with(['category', 'author'])
            ->published()
            ->featured()
            ->latest()
            ->limit(3)
            ->get();

        $popularTags = BlogTag::withCount(['posts' => function ($query) {
                $query->published();
            }])
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get();

        return view('frontend.blog.index', compact('posts', 'categories', 'featuredPosts', 'popularTags'));
    }

    /**
     * Display posts by category.
     */
    public function category(BlogCategory $category): View
    {
        if (!$category->is_active) {
            abort(404);
        }

        $posts = $category->posts()
            ->with(['author', 'tags'])
            ->published()
            ->latest()
            ->paginate(6);

        $categories = BlogCategory::active()
            ->ordered()
            ->withCount(['posts' => function ($query) {
                $query->published();
            }])
            ->get();

        return view('frontend.blog.category', compact('posts', 'category', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(BlogPost $post): View
    {
        // Check if post is published
        if (!$post->is_published || $post->published_at > now()) {
            abort(404);
        }

        // Increment view count
        $post->incrementViewCount();

        // Load relationships
        $post->load(['category', 'author', 'tags']);

        // Get related posts from the same category
        $relatedPosts = BlogPost::with(['category', 'author'])
            ->where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest()
            ->limit(3)
            ->get();

        // Get recent posts for sidebar
        $recentPosts = BlogPost::with(['category', 'author'])
            ->published()
            ->latest()
            ->limit(5)
            ->get();

        // Get categories for sidebar
        $categories = BlogCategory::active()
            ->ordered()
            ->withCount(['posts' => function ($query) {
                $query->published();
            }])
            ->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts', 'recentPosts', 'categories'));
    }
}
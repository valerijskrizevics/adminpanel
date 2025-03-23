<?php

namespace App\Http\Controllers;
    
use App\Models\BlogPost;
use Inertia\Inertia;
    
class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('user:id,name')
            ->latest()
            ->paginate(9);
    
        return Inertia::render('Landing/BlogIndex', [
            'posts' => $posts,
            'isGuest' => !auth()->id(),
            'canLogin' => true,
            'canRegister' => true,
        ]);
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->with('user:id,name');

        return Inertia::render('Landing/BlogShow', [
            'post' => $blogPost->only('id', 'title', 'short_description', 'text', 'created_at', 'user'),
            'isGuest' => !auth()->id(),
            'canLogin' => true,
            'canRegister' => true,
        ]);
    }
}

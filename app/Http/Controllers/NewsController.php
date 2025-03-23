<?php

namespace App\Http\Controllers;
    
use App\Models\NewsPost;
use Inertia\Inertia;
    
class NewsController extends Controller
{
    public function index()
    {
        $posts = NewsPost::with('user:id,name')
            ->latest()
            ->paginate(9);
    
        return Inertia::render('Landing/BlogIndex', [
            'posts' => $posts,
            'isGuest' => !auth()->id(),
            'canLogin' => true,
            'canRegister' => true,
        ]);
    }

    public function show(NewsPost $post)
    {
        $post->with('user:id,name');

        return Inertia::render('Landing/BlogShow', [
            'post' => $post->only('id', 'title', 'short_description', 'text', 'created_at', 'user'),
            'isGuest' => !auth()->id(),
            'canLogin' => true,
            'canRegister' => true,
        ]);
    }
}

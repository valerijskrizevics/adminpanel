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
}

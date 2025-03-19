<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\User;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::with('user')->get(); // Include user relationship
        return Inertia::render('Blog/Index', [
            'blogPosts' => $blogPosts,
        ]);
    }

    public function create()
    {
        $users = User::all(); // Get all users for the user dropdown
        return Inertia::render('Blog/Create', [
            'users' => $users,
        ]);
    }

    public function store(BlogPostRequest $request)
    {
        BlogPost::create($request->validated());
        
        return redirect()->route('blog.index')->with('success', 'Blog post created');
    }

    public function show(BlogPost $blogPost)
    {
        return Inertia::render('Blog/Show', [
            'blogPost' => $blogPost,
        ]);
    }

    public function edit(BlogPost $blogPost)
    {
        $users = User::all();
        return Inertia::render('Blog/Edit', [
            'blogPost' => $blogPost,
            'users' => $users,
        ]);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost->update($request->validated());

        return redirect()->route('blog.index')->with('success', 'Blog post updated');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted');
    }
}

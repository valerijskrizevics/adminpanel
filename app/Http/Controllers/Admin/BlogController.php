<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Models\User;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::with('user:id,name')->get();
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        return Inertia::render('Blog/Index', [
            'posts' => $blogPosts,
            'canManage' => $currentUser->can('manage blog'),
            'canManageAny' => $currentUser->hasRole('admin'),
            'currentUser' => $currentUser->only('id'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Blog/Create');
    }

    public function store(BlogPostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        BlogPost::create($data);
        
        return redirect()->route('blog.index')->with('success', 'Blog post created');
    }

    public function show(BlogPost $blogPost)
    {
        $blogPost->with('user:id,name');

        return Inertia::render('Blog/Show', [
            'post' => $blogPost->only('id', 'title', 'short_description', 'text', 'created_at', 'user'),
        ]);
    }

    public function edit(BlogPost $blogPost)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('update', $blogPost)) {
            abort(403);
        }

        return Inertia::render('Blog/Edit', [
            'post' => $blogPost,
        ]);
    }

    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('update', $blogPost)) {
            abort(403);
        }

        $blogPost->update($request->validated());

        return redirect()->route('blog.index')->with('success', 'Blog post updated');
    }

    public function destroy(BlogPost $blogPost)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('delete', $blogPost)) {
            abort(403);
        }

        $blogPost->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted');
    }
}

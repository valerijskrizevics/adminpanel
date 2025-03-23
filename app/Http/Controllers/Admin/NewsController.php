<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use App\Models\User;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::with('user:id,name')->get();
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        return Inertia::render('News/Index', [
            'posts' => $newsPosts,
            'canManage' => $currentUser->can('manage news'),
            'canManageAny' => $currentUser->hasRole('admin'),
            'currentUser' => $currentUser->only('id'),
        ]);
    }

    public function create()
    {
        return Inertia::render('News/Create');
    }

    public function store(NewsPostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        NewsPost::create($data);
        
        return redirect()->route('news.index')->with('success', 'News post created');
    }

    public function show(NewsPost $post)
    {
        $post->with('user:id,name');

        return Inertia::render('News/Show', [
            'post' => $post->only('id', 'title', 'short_description', 'text', 'created_at', 'user'),
        ]);
    }

    public function edit(NewsPost $post)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('update', $post)) {
            abort(403);
        }

        return Inertia::render('News/Edit', [
            'post' => $post,
        ]);
    }

    public function update(NewsPostRequest $request, NewsPost $post)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('update', $post)) {
            abort(403);
        }

        $post->update($request->validated());

        return redirect()->route('news.index')->with('success', 'Blog post updated');
    }

    public function destroy(NewsPost $post)
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        if ($currentUser->cannot('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('news.index')->with('success', 'Blog post deleted');
    }
}

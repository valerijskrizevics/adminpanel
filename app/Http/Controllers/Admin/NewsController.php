<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsPostRequest;
use App\Models\NewsPost;
use App\Models\User;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        $newsPosts = NewsPost::with('user:id,name')->get();
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        
        return Inertia::render('News/Index', [
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),

            'posts' => $newsPosts,
            'canManage' => $currentUser->can('manage news'),
            'canManageAny' => $currentUser->hasRole('admin'),
            'currentUser' => $currentUser->only('id'),
        ]);
    }

    public function create()
    {
        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();
        
        return Inertia::render('News/Create', [
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),
        ]);
    }

    public function store(NewsPostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        NewsPost::create($data);
        
        return redirect()->route('news.index');
    }

    public function show(NewsPost $post)
    {
        $post->with('user:id,name');

        /**
         * @var User $currentUser
         */
        $currentUser = auth()->user();

        return Inertia::render('News/Show', [
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),

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
            'canViewBlog' => $currentUser->can('view blog'),
            'canViewNews' => $currentUser->can('view news'),

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

        return redirect()->route('news.index');
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

        return redirect()->route('news.index');
    }
}

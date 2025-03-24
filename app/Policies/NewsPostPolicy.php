<?php

namespace App\Policies;

use App\Models\NewsPost;
use App\Models\User;

class NewsPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view news');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NewsPost $post): bool
    {
        return $user->can('view news'); // Unused - checked by spatie middleware
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('manage news'); // Unused - checked by spatie middleware
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NewsPost $post): bool
    {
        return $user->can('manage news') && ($post->user_id === $user->id || $user->hasRole('admin'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NewsPost $post): bool
    {
        return $user->can('manage news') && ($post->user_id === $user->id || $user->hasRole('admin'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NewsPost $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NewsPost $post): bool
    {
        return false;
    }
}

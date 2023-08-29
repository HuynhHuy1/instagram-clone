<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;
    public function __construct()
    {
    }
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}

<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('show-post', function ($user, $post, $isFollwed, $isUserLogin) {
            $privacyMode = $post->privacy_mode;
            if ($privacyMode == "") {
                return true;
            }
            if ($privacyMode == 'public') {
                return true;
            } else if ($privacyMode == 'friend') {
                if ($isUserLogin) {
                    return true;
                } else {
                    return $isFollwed;
                }
            } else if ($privacyMode == 'private') {
                return $user->id == $post->user_id;
            }
        });
    }
}

<?php

namespace App\Providers;

use App\Message;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
        Message::class => CommentPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();

    }
}

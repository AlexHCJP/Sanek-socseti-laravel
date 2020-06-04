<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Post $post)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Post $post)
    {
        return $post->user()->getResults()->id == $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $post->user()->getResults()->id == $user->id;
    }

    public function restore(User $user, Post $post)
    {

    }
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}

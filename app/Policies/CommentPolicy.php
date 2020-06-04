<?php

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Message $message)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Message $message)
    {
        return $message->user()->getResults()->id == $user->id;
    }
    public function delete(User $user, Message $message)
    {

        return $message->user_id == $user->id
            || $message->post()->getResults()->user_id == $user->id;
    }

    public function restore(User $user, Message $message)
    {
        //
    }
    public function forceDelete(User $user, Message $message)
    {
        //
    }
}

<?php

namespace App;

use Hootlex\Friendships\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App
 *
 * @property-read $id
 * @property $name
 * @property $email
 * @property $password
 * @property $age
 */
class User extends Authenticatable
{
    use Friendable, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'age'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function friend()
    {
        return $this->getFriends();
    }

    public function isFriend(User $user){

        return $this->isFriendWith($user);
    }
    public function peniedFriend()
    {
        return $this->getFriends(0);
    }
    public function countFriend($type = 1, $groupSlug = '')
    {
        return $this->getFriendsCount($type, $groupSlug);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments(){
        return $this->hasMany(Message::class);
    }

}

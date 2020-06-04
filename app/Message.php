<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App
 * @property $text
 * @property $user_id
 * @property $post_id
 * @property-read $id
 */
class Message extends Model
{
    protected $fillable = [
      'text', 'user_id', 'post_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}

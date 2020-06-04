<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Post
 * @package App
 * @property $text
 * @property $user_id
 * @property-read $id
 */
class Post extends Model
{
    protected $fillable = [
         'text', 'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Message::class);
    }

}

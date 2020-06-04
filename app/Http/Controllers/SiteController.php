<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\Builder;

class SiteController extends Controller
{
    public function news()
    {

        $posts = Post::whereHas('user', function (Builder $query){
            $query->whereHas('friendsSender', function (Builder $query){
                $this->checkFriends($query);
            })->orWhereHas('friendsRecipient',function (Builder $query){
                $this->checkFriends($query);
            });
        })->orderByDesc('created_at')->get();
        return view('site.news', compact('posts'));
    }
    private function checkFriends(Builder $query)
    {
        $id = auth()->user()->id;
        $query->where('status','=', 1)
            ->where('recipient_id', '=', $id)
            ->orWhere('sender_id','=', $id);
    }
}

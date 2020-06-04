<?php

namespace App\Http\Controllers;

use App\Message;
use App\Post;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $this->validated($request);
        $comment = Message::on()->create([
            'text' => $data['text'],
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);
        return redirect()->back();
    }
    public function edit(Message $message)
    {

        $this->authorize('update', $message);
        $post = $message->post()->getResults();
        return view('post.show', ['post' => $post, 'comment' => $message]);
    }
    public function update(Request $request, Message $comment)
    {
        $this->authorize('update', $comment);
        $data = $this->validated($request);
        $comment->update($data);
        return redirect()->route('post.show', $comment->post()->getResults());
    }
    public function destroy(Message $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('post.show', $comment->post()->getResults());
    }
    private function validated(Request $request)
    {
        return $this->validate($request, [
           'text' => 'required'
        ]);
    }
}

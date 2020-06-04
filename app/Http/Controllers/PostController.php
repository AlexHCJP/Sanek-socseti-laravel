<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $rules = [
        'text' => 'required'
    ];
    public function index()
    {
        $this->authorize('viewAny');
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('post.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $data = $this->validated($request);
        /**
         * @var HasMany $posts
         */
        $posts = auth()->user()->posts();
        $posts->create($data);

        return redirect()->route('user.show', auth()->user());
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {

        $this->authorize('update', $post);
        return view('post.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $this->validated($request);
        /**
         * @var HasMany $posts
         */
        $post->update($data);
        return redirect()->route('post.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('user.show', $post->user()->getResults());
    }

    private function validated(Request $request)
    {
        return $request->validate( $this->rules);
    }
}

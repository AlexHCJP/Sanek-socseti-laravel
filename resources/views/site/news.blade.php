@extends('layouts.app')

@section('content')

    <div>
        @foreach($posts as $post)
                <div class="card mt-2">
                    <div class="card-header d-flex p-3 h-50">
                        <a href="{{route('user.show', $post->user()->first())}}"><p class="m-0">{{$post->user()->first()->name}}</p></a>
                        @if($post->user()->getResults()->can('createPost', auth()->user()))
                            <div class="dropdown p-0 h-50 ml-auto">
                                <a id="Dropdown" class="nav-link dropdown-toggle p-0 pr-3 " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Dropdown">
                                    <a class="dropdown-item"
                                       onclick="event.preventDefault(); document.getElementById('delete-form{{$post->id}}').submit();">
                                        Delete
                                    </a>
                                    <form id="delete-form{{$post->id}}" action="{{ route('post.destroy', $post) }}" style="display: none;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="dropdown-item" href="{{route('post.edit', $post)}}">Update</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <a href="{{route('post.show', $post)}}">
                        <div class="card-body">{{$post->text}}</div>
                    </a>

                </div>
            @endforeach
    </div>
@endsection

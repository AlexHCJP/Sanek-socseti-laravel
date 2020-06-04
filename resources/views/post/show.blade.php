@extends('layouts.app')

@section('content')
    <?php $user = $post->user()->getResults() ?>
    <div class="card">
        <div class="card-header d-flex p-3 h-50">
            <a href="{{route('user.show', $user)}}"><p class="m-0">{{$user->name}}</p></a>
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
        </div>
        <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
        </div>
        <div class="card-footer">
            <form action="{{isset($comment) ?  route('comment.update', $comment) : route('comment.store', $post)}}" class="form-group d-flex flex-column" method="POST">
                @csrf
                <textarea type="text" name="text" class="input-group p-2 m-2" placeholder="Write a comment..." style="resize: none">{{$comment->text ?? ''}}</textarea>
                @if(isset($comment))
                    @method('PUT')
                    <div class="d-flex ml-auto text-light">
                        <a href="{{route('post.show', $post)}}" class="btn btn-danger mr-2">Back</a>
                        <button class="btn btn-info">Update</button>
                    </div>

                @else
                    <button class="btn btn-info text-light ml-auto">Create</button>

                @endif
                @error('text')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </form>
        </div>
    </div>
    @foreach($post->comments()->get() as $comment)
        <div class="alert-light mt-3" style="border: 1px solid gainsboro">
            <div class="card-header d-flex">
                <a href="{{route('user.show', $comment->user()->getResults())}}">{{$comment->user()->getResults()->name}}</a>
                @can('delete', $comment)
                    <div class="dropdown p-0 h-50 ml-auto">
                        <a id="Dropdown" class="nav-link dropdown-toggle p-0 pr-3 " role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ...
                        </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Dropdown">

                                <a class="dropdown-item"
                                   onclick="event.preventDefault(); document.getElementById('delete-form{{$comment->id}}').submit();">
                                    Delete
                                </a>
                                <form id="delete-form{{$comment->id}}" action="{{ route('comment.destroy', $comment) }}" style="display: none;" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                @can('update', $comment)
                                    <a class="dropdown-item" href="{{route('comment.edit', $comment)}}">Update</a>
                                @endcan
                            </div>

                    </div>
                @endcan
            </div>
            <p class="m-2">{{$comment->text}}</p>
        </div>
    @endforeach

@endsection

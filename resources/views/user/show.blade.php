

@extends('layouts.app')


@section('content')
    <?php
        $isFriend = auth()->user()->isFriend($user);
        $isSendFriend = auth()->user()->hasSentFriendRequestTo($user);
        $isAcceptFriend = auth()->user()->hasFriendRequestFrom($user);
//        dd($isFriend, $isSendFriend, $isAcceptFriend);
    ?>
    <div class="card">
        <h4 class="m-3"><strong>{{$user->name}}</strong></h4>
        <div class="card-body">
            @can('addToFriend', $user)
                <form action="
                    @if($isFriend){{route('friend.destroy', $user)}}
                    @elseif($isSendFriend){{route('friend.destroy', $user)}}
                    @elseif($isAcceptFriend){{route('user.acceptFriend', $user)}}
                    @else{{route('user.befriend', $user)}}
                    @endif
                    " method="{{ $isAcceptFriend ? 'GET' :'POST'}}">
                    @csrf
                    @if($isFriend || $isSendFriend)
                        @method('DELETE')
                    @endif
                    <button class="btn @if($isSendFriend || $isFriend)) btn-secondary @else btn-light @endif">
                        @if($isFriend)
                            Unfriend
                        @elseif($isSendFriend)
                            Cancel
                        @elseif($isAcceptFriend)
                            Accept Friend
                        @else
                            Add To Friend
                        @endif
                    </button>
                    @if($isAcceptFriend)
                        <a href="{{route('user.denyFriend', $user)}}" class="btn btn-danger">Deny</a>
                    @endif
                </form>
            @endcan
        </div>
        <div class="my-2 p-2 bg-white">
            <h5 class="border-bottom border-gray pb-2 mb-0">Friend</h5>
            <div class="d-flex">
                @foreach($friends as $friend)

                    <a href="{{route('user.show', $friend)}}">
                        <div class="media text-muted pt-2 m-2 d-flex flex-column">
                            <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32"></svg>
                            <h6 class="ml-4">
                                <strong class="d-block text-gray-dark">{{$friend->name}}</strong>
                            </h6>
                        </div>
                    </a>

                @endforeach
            </div>
            <small class="d-block text-right mt-3">
                <a href="{{route('user.friends', $user)}}">All friend<span class="badge badge-pill bg-light align-text-bottom mb-1">{{$user->getFriendsCount()}}</span></a>
            </small>
        </div>
    </div>
    @can('createPost', $user)
        <div class="mt-3 card pt-3 px-3">
            <form class="form-group d-flex flex-column" action="{{route('post.store')}}" method="POST">
                @csrf
                <textarea style="height: 10em; resize: none;" class="form-control" name="text"></textarea>
                <button class="ml-auto btn btn-info text-white m-3">Create Post</button>
            </form>
        </div>
    @endcan
    <div>
        @foreach($user->posts()->getResults() as $post)
            <div class="card mt-2">
                    <div class="card-header d-flex p-3 h-50">
                        <a href="{{route('user.show', $post->user()->getResults())}}"><p class="m-0">{{$post->user()->getResults()->name}}</p></a>
                        @can('createPost', $user)
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
                        @endcan
                    </div>
                    <a href="{{route('post.show', $post)}}">
                        <div class="card-body">{{$post->text}}</div>
                    </a>
            </div>
        @endforeach
    </div>
@endsection

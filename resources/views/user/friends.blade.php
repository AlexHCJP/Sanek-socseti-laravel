@extends('layouts.app')

@section('content')
    <div class="my-2 p-2 bg-white">
        <h5 class="border-bottom border-gray pb-2 mb-0">Friend</h5>
            @can('showFriend', $user)
                @foreach($user->peniedFriend() as $friend)
                    @if($user->hasFriendRequestFrom($friend))
                        <a href="{{route('user.show', $friend)}}">
                            <div class="media text-muted pt-3">
                                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32"></svg>
                                <h6 class="ml-4">
                                    <strong class="d-block text-gray-dark">{{$friend->name}}</strong>
                                </h6>
                                <div class="ml-auto d-flex">
                                    <form action="{{route('user.denyFriend', $friend)}}">
                                        <button class="btn btn-success">Deny</button>
                                    </form>
                                    <form action="{{route('user.acceptFriend', $friend)}}">
                                        <button class="btn btn-info">Accept</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endcan
            @foreach($user->friend() as $friend)
            <a href="{{route('user.show', $friend)}}">
                <div class="media text-muted pt-3">
                    <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32"></svg>
                    <h6 class="ml-4">
                        <strong class="d-block text-gray-dark">{{$friend->name}}</strong>
                    </h6>
                    @can('showFriend', $user)
                        <div class="ml-auto d-flex">
                            <form action="{{route('friend.destroy', $friend)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    @endcan
                </div>
            </a>
            @endforeach
    </div>
@endsection

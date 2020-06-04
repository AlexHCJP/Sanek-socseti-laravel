@extends('layouts.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h5 class="border-bottom border-gray pb-2 mb-0">Peoples</h5>
    @foreach($users as $user)
        <a href="{{route('user.show', $user)}}">
            <div class="media text-muted pt-3 alert-secondary m-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32"></svg>
                <h5 class="ml-4">
                    <strong class="d-block text-gray-dark">{{$user->name}}</strong>
                </h5>
            </div>
        </a>

    @endforeach
</div>
@endsection

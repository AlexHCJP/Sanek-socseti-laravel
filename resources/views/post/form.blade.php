@extends('layouts.app')


@section('content')
    <?php
        $isUpdate = isset($post);
    ?>
    <div class="mt-3 card pt-3 px-3">
        <form class="form-group d-flex flex-column" action="{{$isUpdate ? route('post.update', $post) : route('post.store')}}" method="POST">
            @csrf
            @if($isUpdate)
                @method('PUT')
            @endif
            <textarea style="height: 10em; resize: none;" class="form-control" name="text">{{$post->text ?? (old('text') ?? '')}}</textarea>
            <div class="ml-auto">
                <button class="btn btn-info text-white m-3">{{$isUpdate ? 'Update Post' : 'Create Post'}}</button>
                <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
            </div>

            @error('text')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </form>
    </div>
@endsection


@extends('layouts.app')

@section('title') Edit @endsection

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{route('posts.update', $post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" value="{{$post->title}}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="{{$post->description}}" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                <option value="{{$user ? $user->id : 1}}">{{$user ? $user->name : 'not found'}}</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection

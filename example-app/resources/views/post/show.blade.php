@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card mt-6">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <h4 class="card-text">Description: {{$post->description}}</h4>
    </div>
</div>


<div class="card ">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body">
        @if($comments)
        @foreach($comments as $comment)
        <h4 class="card-text">{{$comment["body"]}}</h4>
        <form method="post" id="form" action="{{route('comments.destroy',$comment['id'])}}" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary delete_btn">Delete</button>
        </form>
        <a href="{{route('comments.edit',$comment->id)}}" class="btn btn-primary">update</a>
        <hr>
        @endforeach
        @else
        <h2 class="card-text">NO Comments</h2>
        @endif
    </div>
</div>
<form method="post" action="{{route('comments.store',$post->id)}}">
    @csrf
    <div class="input-group mb-3 pt-3">
        <input type="text" class="form-control" placeholder="write comment" aria-label="Recipient's username" aria-describedby="button-addon2" name="body">
        <input class="btn btn-outline-secondary" type="submit" id="button-addon2">
        <input type="hidden" name="post" value="{{$post->id}}">
    </div>
</form>

@endsection
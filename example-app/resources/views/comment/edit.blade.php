@extends('layouts.app')

@section('title') edit comment @endsection

@section('content')


<form method="post" action="{{route('comments.update', $comment->id)}}">

@csrf
@method ("put")

<div class="input-group input-group-sm mb-3 pt-3">
  <span class="input-group-text" id="inputGroup-sizing-sm">update comment</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$comment->body}}" name="body">
</div>
<input type="submit" class="btn btn-danger" value="Update">
</form>


@endsection
@extends('layouts.app')


@section('title') update @endsection

@section('content')


<form method="put" action="{{route('posts.index', $post['id'])}}">

@csrf
 @method('PUT')
<div class="input-group input-group-sm mb-3 pt-3">
  <span class="input-group-text" id="inputGroup-sizing-sm">title</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$post['title']}}">
</div>


<div class="input-group pt-4">
  <span class="input-group-text">Your Post</span>
  <textarea class="form-control p-5" aria-label="With textarea">{{$post['description']}}</textarea>
</div>

<div class="input-group input-group-sm mb-3 pt-5">
  <span class="input-group-text" id="inputGroup-sizing-sm">post creator</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$post['posted_by']}}">
</div>

<input type="submit" class="btn btn-danger">
</form>



@endsection
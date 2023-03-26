@extends('layouts.app')


@section('title') creat @endsection

@section('content')

<form form method="post" action="{{route('posts.index')}}" enctype="multipart/form-data">
  @csrf

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="input-group input-group-sm mb-3 pt-3">
    <span class="input-group-text" id="inputGroup-sizing-sm">title</span>
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="title">
  </div>


  <div class="input-group pt-4">
    <span class="input-group-text">Your Post</span>
    <textarea class="form-control p-5" aria-label="With textarea" name="description"></textarea>
  </div>

  <div class="input-group input-group-sm mb-3 pt-5">

    <div class="col-12 pb-3">
      <input type="file" name='photo' id='photo'>
    </div>
    <span class="input-group-text" id="inputGroup-sizing-sm">post creator</span>

    <select name="post_creator" class="form-control">
      @foreach($users as $user)
      <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    </select>
  </div>


  <input type="submit" class="btn btn-danger " value="Create">
</form>
@endsection
@extends('layouts.app')


@section('title') Index @endsection

@section('content')
<div class="text-center">

    <a href="{{route('posts.create')}}" class="btn btn-success mt-2">Create Post</a>
</div>
<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            @if($post->slug)
            <td>{{$post->slug}}</td>
            @else
            <td>NOT FOUND</td>
            @endif
            @if($post->user)
            <td>{{$post->user->name}}</td>
            @else
            <td>NOT FOUND</td>
            @endif
            <td>{{$post->created_at->format('Y - m - d')}}</td>
            <td>
                <div>
                  
                        <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                 
                   
                    <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>

                    <button type="submit" class="btn btn-danger delete"  data-id="{{$post->id}}"   style="display:inline-block;" data-bs-toggle="modal" data-bs-target="#exampleModal">delete</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this post ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form method="post" id="form" action="{{route('posts.destroy',$post['id'])}}" style="display:inline-block;" data-bs-toggle="modal" data-bs-target="#exampleModal">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary delete_btn">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


{{ $posts->onEachSide(5)->links() }}
@endsection

@section("scripts")
<script src="{{asset('script.js')}}"></script>
@endsection

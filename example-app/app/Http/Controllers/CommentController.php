<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store()
    {

        $body = request()->body;
        $post = Post::find(request()->post);

        $post->comments()->create([
            "body" => $body
        ]);
        return redirect()->back();
    }
    public function destroy($id)
    {


        $comment = Comment::find($id);
        // dd($comment);
        $comment->delete();
        return redirect()->back();
    }

    public function update($id)
    {

        $body = request()->body;

        Comment::where('id', $id)->update([
            'body' => $body


        ]);

        $post_id = Comment::find($id)->commentable->id;

        // dd($post);
        // $commetable=Comment::where('id', $id)->first()->toArray();

        return redirect()->route('posts.show', $post_id);
    }


    public function  edit($id)
    {

        $comment =  Comment::find($id);


        return view('comment.edit', ['comment' => $comment]);
    }
}

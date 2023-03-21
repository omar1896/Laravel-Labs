<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{





    //creat post
    public function create()
    {
        $users = User::all();


        return view('post.create', ["users" => $users]);
    }





    public function index()
    {
        

        $allPosts = Post::paginate(5);



        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {


        $post = post::find($id);
        // dd($post);
        $comments=$post->comments;

    
        // dd($comments);
        return view('post.show', ['post' => $post,'comments'=>$comments]);
    }


    //update
    public function edit($id)
    {
        $post =  post::find($id);

        //        dd($post);

        return view('post.edit', ['post' => $post]);
    }

    public function update($id)
    {
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        post::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            // 'user_id' => $post_creator
        ]);

        return redirect()->route('posts.index');
    }

    public function store(Request $request)
    {
        $carbon=Carbon::now()->toFormattedDateString();
        // dd($carbon);
        // $input = request()->all();
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        post::create([
            'title' => $title,
            'description' => $description
            


        ]);


        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
       
        $post = post::find($id);
        // dd($flight);
        $post->delete();
        return redirect()->route('posts.index');
       
    }
}

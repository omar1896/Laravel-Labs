<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{





//creat post
public function create(){
    // return "hii";
    return view('post.create');
}





    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'posted_by' => 'Ahmed',
                'created_at' => '2022-08-01 10:00:00'
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'posted_by' => 'Mohamed',
                'created_at' => '2022-08-01 10:00:00'
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'posted_by' => 'Ali',
                'created_at' => '2022-08-01 10:00:00'
            ],
        ];

        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
    //    dd($id);
        $post =  [
            'id' => 3,
            'title' => 'Javascript',
            'posted_by' => 'Ali',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ];

//        dd($post);

        return view('post.show', ['post' => $post]);
    }


    //update
    public function edit($id){
        $post =  [
            'id' => 3,
            'title' => 'Javascript',
            'posted_by' => 'Ali',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ];

//        dd($post);

        return view('post.edit', ['post' => $post]);
        
    }

public function update( $id)
{

    return view('post.index',["id"=> $id]);
}

public function store(){

    return redirect()->route('posts.index');
}



}
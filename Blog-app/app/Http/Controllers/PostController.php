<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Contracts\Service\Attribute\Required;
use  App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Str;
class PostController extends Controller
{


    
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
        $comments=$post->comments;
        return view('post.show', ['post' => $post,'comments'=>$comments]);
    }


    //update
    public function edit($id)
    {
        $post =  post::find($id);

        return view('post.edit', ['post' => $post]);
    }


    public function update($id,UpdatePostRequest $request)
    {
        
        $title = request()->title;
        $description = request()->description;

        if(request()->file('photo')){
            $post = post::find($id);
            Storage::disk("public")->delete($post->photo);
        }
      
           $photo = $request->file('photo')->store('photos',['disk' => "public"]);

        post::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            'photo'=>$photo
        ]);

        return redirect()->route('posts.index');
    }


    public function store(StorePostRequest $request)
    {

        $carbon=Carbon::now()->toFormattedDateString();
     
        $title = request()->title;
       
        $description = request()->description;
      
        $post_creator = request()->post_creator;
    
        $photo = $request->file('photo')->store('photos',['disk' => "public"]);

        
        post::create([
            'title' => $title,
            'description' => $description,
            'user_id'=>$post_creator,
            'slug' => Str::slug(request()->title,'-'),
            'photo'=>$photo
            
        ]);

        
        return redirect()->route('posts.index');
    }




    public function destroy($id)
    {
       
        $post = post::find($id);
        
       Storage::disk("public")->delete($post->photo);

        $post->delete();

        return redirect()->route('posts.index');
       
    }



    public function removeoldposts(){
        PruneOldPostsJob::dispatch();
    }
}

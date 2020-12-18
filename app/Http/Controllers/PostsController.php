<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');
    }
//explore method 
    public function index()
    {
        $users = auth()->user()->id;

        $posts = Post::where('user_id', '<>',0)->with('user')->latest()->paginate();
        


        return view('posts.index', compact('posts'));
    }
    //create post redirect 
    public function create(){

        return view('posts.create');
    }

    //store the post inf
    public function store(){
        $data=request()->validate([
            'caption'=>['required','max:150'],
            'image'=> 'required|image' ,

        ]);

        $imagePath = request('image')->store('upload', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption'=> $data['caption'],
            'image' => $imagePath,
        ]);
       
        return redirect('/profile/' . auth()->user()->id);
    }
    
    //show the post method
    public function show(\App\Models\Post $post){

        //dd($post->user->profile);
        $post->viewsInc($post);
        
        if($post->comments->count()>5){$comment_count=5;}else{$comment_count=$post->comments->count();}

        for($x=0;$x< auth()->user()->following->count();  $x++){
            if($post->user->id==auth()->user()->following[$x]->user_id)
            $_aFollower=1;
            
        }

        if($post->user->profile->status!='private'||auth()->user()->id==$post->user_id||isset($_aFollower)&&$_aFollower==1){
        return view('posts.show', compact('post','comment_count'));
        }else{return view('404');}
    }

//delete the post method
    public function delete(\App\Models\Post $post){

        $this->authorize('update', $post->user->profile);

        DB::table('posts')->where('id', '=', $post->id)->delete();

        return redirect('/profile/' . auth()->user()->id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLikes;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Store the Likes method
    public function store($post)
    {
        $l=PostLikes::create([
            'post_id'=>$post,
            'user_id'=>auth()->user()->id,
        ]);

        return $l->id;
    }
//view Likes method
    public function ViewLikes(Post $post){
        if(!isset(auth()->user()->id))
        return view('404');
    
    
        $_GET['post_id']=$post->id;
        //$users= App\Models\Profile::where('user_id', '<>',0)->with('user')->latest()->paginate(5);
        $users = $post->likes()->pluck('id');
    
        $likes = PostLikes::whereIn('id', $users)->with('post')->latest()->get();
        $counter = 1;
       
        return view('posts.likes', compact('likes','counter','post'));
    }
    //delete like method
    public function delete(Post $post,PostLikes $like){
        if(isset(auth()->user()->id)){
            if(auth()->user()->id==$like->user_id){

               $s= PostLikes::where('id', '=', $like->id)->delete();
               
    
            }
        }
    }
    

}

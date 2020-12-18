<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//store comment method
    public function comment($post,$comment){
        //dd($post->id);
        if(strlen($comment)<=50){

$c=Comment::create([
    'post_id'=>$post,
    'user_id'=>auth()->user()->id,
    'comment'=>$comment,
]);
      

return ['id'=>auth()->user()->id,'name'=>auth()->user()->name,'commentid'=>$c->id];
}else{return 'null';}
}

//view comment meth
public function viewComments(Post $post){
    if(!isset(auth()->user()->id)||auth()->user()->id!=$post->user_id)
    return view('404');


    $_GET['post_id']=$post->id;
    //$users= App\Models\Profile::where('user_id', '<>',0)->with('user')->latest()->paginate(5);
    $users = $post->comments()->pluck('id');

    $comments = Comment::whereIn('id', $users)->with('post')->latest()->get();
    $counter = 1;
    //dd($comments);
    return view('posts.comments', compact('comments','counter','post'));
}

//delete comment method 
public function delete(Post $post,Comment $comment){
    if(isset(auth()->user()->id)){
        if(auth()->user()->id==$comment->user_id||auth()->user()->id==$post->user_id){
            DB::table('comments')->where('id', '=', $comment->id)->delete();

            if(auth()->user()->id==$post->user_id)
            return redirect('/p/'.$post->id.'/comments');
            if(auth()->user()->id==$comment->user_id)
            return redirect('/p/'.$post->id);
        }else{return view('404');}
        
    }else{return view('404');}

}
}

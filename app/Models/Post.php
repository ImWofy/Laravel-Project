<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Post extends Model
{
    use HasFactory;
    
    protected $guarded = [];
//the relations

    public function user(){

        return $this->belongsTo(User::class);
    }
//the relations
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //increase views 
    public function viewsInc(Post $post){
        
        $views = Post::where('id',$post->id)->first()->views;
        $views ++;
        Post::where('id',$post->id)->update(['views'=>$views]);
    }


//the relations

    public function likes(){
        return $this->hasMany(PostLikes::class);
    }

//check user likes
    public function checkLikes($likes,$id){
        for ($i=0; $i <$likes->count() ; $i++) { 
            if($likes[$i]->user_id==$id)
            return ['like'=>$likes[$i]->id,'found'=>true];
        }
        return false;
    }
}

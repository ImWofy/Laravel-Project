<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Profile;
use Intervention\Image\Facades\Image;


class ProfilesController extends Controller
{
    //profile index method
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });
            $_aFollower=0;
            if(isset(auth()->user()->following)){
            for($x=0;$x< auth()->user()->following->count();  $x++){
                if($user->id==auth()->user()->following[$x]->user_id)
                $_aFollower=1;
                
            }
            if(auth()->user()->id==$user->id)
            $_aFollower=1;
        }
        return view('profile.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount','_aFollower'));
    }

    //edite profile auth
    public function edit(User $user){

        $this->authorize('update', $user->profile);
            return view('profile.edit', compact('user'));
    }
//update the profile method
    public function update(User $user){
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title'=>['required','max:50'],
            'description'=>['required','max:200'],
            'url'=>'url',
            'gender'=>'required',
            'status'=>'required',
            'image'=>'image',
        ]);

        if(request('image')){
            
            $imagePath = request('image')->store('profile', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }
        auth()->user()->profile->update(array_merge(
            $data, 
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }



//view all profile followers
    public function ShowFollowers(User $user){
        
        if(!isset(auth()->user()->id))
        return redirect('login');
        
        //$users= App\Models\Profile::where('user_id', '<>',0)->with('user')->latest()->paginate(5);
        $users = $user->profile->followers()->pluck('users.id');

        $followers = User::whereIn('id', $users)->with('profile')->latest()->get();
        //dd($users);
        $_GET['profile_id']=$user->id;
        $counter=1;
        return view('profile.followers', compact('followers','counter','user'));

    }

    //view what profile following
    public function ShowFollowing(User $user){
        if(!isset(auth()->user()->id))
        return redirect('login');
        //$users= App\Models\Profile::where('user_id', '<>',0)->with('user')->latest()->paginate(5);
        $users = $user->following()->pluck('profiles.user_id');

        $followers = Profile::whereIn('user_id', $users)->with('user')->latest()->get();

        $_GET['profile_id']=$user->id;
        $counter=1;
        return view('profile.following', compact('followers','counter','user'));

    }

    //search profiles
    public function search($name){

        $data[$name] = strtolower($name);

        $users = User::where('name','LIKE','%'.$name.'%')->get();
        if($users->count()<5)
        for ($i=0; $i < $users->count(); $i++) { 
            $img=$users[$i]->profile->profileImage();
            if($img=$users[$i]->profile->image!=null)
            $users[$i]->profile= $img;
            else $users[$i]->profile->image = 'profile/null.png';
        }
        else 
        for ($i=0; $i < 4; $i++) { 
            $img=$users[$i]->profile->profileImage();
            if($img=$users[$i]->profile->image!=null)
            $users[$i]->profile= $img;
            else $users[$i]->profile->image = 'profile/null.png';
        }
        
        if($users->count()>0)
return $users;
    }

    //delete profile
    public function deleteProfile($user)
    {
        if(!isset(auth()->user()->id))
        return redirect('login');
//dd($user);
        $users = User::where('id','=',$user)->delete();
return redirect('/');
    }
}

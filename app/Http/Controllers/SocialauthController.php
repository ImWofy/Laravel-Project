<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\User;
class SocialauthController extends Controller
{


  //the redirect to facebook 
    public function redirect()
    {
       return Socialite::driver('facebook')->stateless()->redirect();
    }

    //the calling from facebook with(user) 
    public function callback()
    {
      $getInfo = Socialite::driver('facebook')->stateless()->user(); 
      $user = $this->createUser($getInfo); 
      //dd($user);
      auth()->login($user); 
      return redirect()->to('/');
    }
    //creating user func
    function createUser($getInfo){
    $user = User::where('facebook_id', $getInfo->id)->first();
    if (!$user) {
      $userName=$getInfo->name;
      $userName = preg_replace('/\s+/', '',  $userName);
      $userName = strtolower( $userName);
         $user = User::create([
            'name'     => $userName,
            'password'     => '00',
            'email'    => $getInfo->email,
            'facebook_id' => $getInfo->id,
            'national_id' => $getInfo->id,
        ]);
      }
      return $user;
    }

   
}

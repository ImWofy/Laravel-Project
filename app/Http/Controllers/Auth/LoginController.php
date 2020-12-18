<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //login method
    public function national_idLogin(){
        request()->validate([

            'national_id'=>['required', 'string','min:10', 'max:50'],
            'password'=>['required', 'string', 'min:8'],
        ]);

      $user = \App\Models\User::where('national_id','=',request()->national_id)->first();
      if(!$user){

        return redirect('login')->with('message','Wrong National_id or Password.');

    }else{
       
       if( Auth::attempt([
            'national_id'=>request()->national_id,
            'password'=>request()->password
        ]))
        {
        auth()->login($user); 
        }
        else{
            
            return redirect('login')->with('message','Wrong National_id or Password.');
        }
        return redirect()->to('/');
      }

        
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //validator
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','min:4', 'max:50','unique:users'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'national_id' => ['required', 'string','min:10', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     //regiser Meth
    protected function create(array $data)
    {
        $data['name'] = preg_replace('/\s+/', '', $data['name']);
        $data['name'] = strtolower($data['name']);
        ///
        $data['national_id'] = preg_replace('/\s+/', '', $data['national_id']);
        $data['national_id'] = strtolower($data['national_id']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'national_id' => $data['national_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

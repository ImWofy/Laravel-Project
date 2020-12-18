<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//store the follow
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
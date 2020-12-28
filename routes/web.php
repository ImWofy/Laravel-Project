<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('Index');
});*/

Auth::routes();
Route::get('/email', function () {
    return new NewUserWelcomeMail();
});


//follow Route
Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);
Route::get('follow/{user}', function(){

    return view('404');
});

Route::get('/profile/followers/who/{user}', [App\Http\Controllers\ProfilesController::class, 'ShowFollowers']);
Route::get('/profile/following/who/{user}', [App\Http\Controllers\ProfilesController::class, 'ShowFollowing']);





//post Routes
Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);

Route::post('/p/delete/{post}', [App\Http\Controllers\PostsController::class, 'delete']);

Route::get('/p/delete/{post}', function(){

    return view('404');
});



Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);

Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/p', function(){

    return view('404');
});


Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);



Route::post('/p/{post}/comment/{comment}', [App\Http\Controllers\CommentsController::class, 'comment']);
Route::get('/p/{post}/comment/{comment}' , function(){

    return view('404');
});

Route::get('/p/{post}/delete/{comment}', [App\Http\Controllers\CommentsController::class, 'delete']);




Route::get('/p/{post}/comments', [App\Http\Controllers\CommentsController::class, 'viewComments']);






//profile Routes
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');


//search route
Route::post('/search/profile/{name}', [App\Http\Controllers\ProfilesController::class, 'search']);
Route::get('/search/profile/{name}' , function(){

    return view('404');
});




//facebook
Route::get('/auth/redirect/facebook', [App\Http\Controllers\SocialauthController::class, 'redirect']);
Route::get('/callback/facebook', [App\Http\Controllers\SocialauthController::class, 'callback']);


//login
Route::post('/login/national_id', [App\Http\Controllers\Auth\LoginController::class, 'National_idLogin']);
Route::get('/login/national_id', function(){

    return view('404');
});




//redirect away
Route::get('/redirect/away/{user}',function($user){
    
    $userUrl = \App\Models\User::where('id','=',$user)->first();

return redirect()->away($userUrl->profile->url);
});


    Route::post('/hi/hi',function(){
        dd(1111);
    });



//like routes
    Route::post('/like/p/{post}', [App\Http\Controllers\LikesController::class, 'store']);
    Route::get('/like/p/{post}', function(){

        return view('404');
    });
    Route::post('/like/p/{post}/remove/{like}', [App\Http\Controllers\LikesController::class, 'delete']);
    Route::get('/like/p/{post}/remove/{like}', function(){

        return view('404');
    });

    Route::get('/p/{post}/likes', [App\Http\Controllers\LikesController::class, 'viewLikes']);

    



//spec func
    Route::get('/deleteit', function ()
    {
        \App\Models\User::where('id', '=', 8)->delete();
    });


    //admin delete acc rout
    Route::post('/delete/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'deleteProfile']);
    Route::get('/delete/profile/{user}', function(){

        return view('404');
    });

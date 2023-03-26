<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
return view('welcome');
});

//posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
//rout collection
Route::group(['middleware' => 'auth'], function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Route::post('/posts/runjob', [PostController::class, 'removeoldposts'])->name('posts.store');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});


//comments
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/commet/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');


Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');


Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

//Auth

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');



use App\Models\User;


Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate(
        [
            'provider_id' => $githubUser->id,
        ],
        [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'provider_token' => $githubUser->token,
            'provider_refresh_token' => $githubUser->refreshToken,
        ]
    );

    Auth::login($user);

    return redirect('posts');
});





Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');



Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
// dd($googleUser);
    $user = User::updateOrCreate(
        [
            'provider_id' => $googleUser->id,
        ],
        [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'provider_token' => $googleUser->token,
            'provider_refresh_token' => $googleUser->refreshToken,
        ]
    );

    Auth::login($user);

    return redirect('posts');
});

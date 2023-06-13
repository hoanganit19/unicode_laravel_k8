<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Group;
use App\Models\Phone;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    // $user = User::find(1);
    // $phone = $user->phone;
    // dd($phone);

    // $number = '0388875179';
    // $phone = Phone::whereNumber($number)->first();
    // $user = $phone->user;

    // $group = Group::find(3);
    // $users = $group->users;
    // foreach ($users as $user) {
    //     echo $user->name.'<br/>';
    // }

    $user = User::find(5);
    $group = $user->group;
    dd($group);

});

//1-1, 1-n

/*
Tình huống n - n
1 bài viết => thuộc nhiều chuyên mục
1 chuyên mục => có nhiều bài viết
*/

Route::get('/category/{category}', function (Category $category) {
    $posts = $category->posts()->whereStatus(0)->get(); //magic method

    foreach ($posts as $post) {
        echo $post->title.'<br/>';
    }
});

Route::get('/post/{post}', function (Post $post) {
    $categories = $post->categories;
    foreach ($categories as $category) {
        echo $category->name.' - '.$category->pivot->created_at.'<br/>';
    }
});

Route::prefix('posts')->group(function () {

    Route::get('/', [PostController::class, 'index']);

    Route::get('/create', [PostController::class, 'create']);

    Route::post('/create', [PostController::class, 'handleCreate']);

    Route::get('/edit/{post}', [PostController::class, 'edit']);

    Route::post('/edit/{post}', [PostController::class, 'handleEdit']);

    Route::get('/delete/{id}', [PostController::class, 'delete']);
});

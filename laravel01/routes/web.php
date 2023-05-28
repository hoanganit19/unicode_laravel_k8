<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;

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

Route::get('/', [HomeController::class, 'index']);

//hello
// Route::match(['get', 'post'], '/hello', function () {
//     return 'abc';
// });

//admin
//admin/products
//admin/posts
//admin/users
//admin/users/add
//admin/users/edit/{id}
//admin/user/delete/{id}

// Route::prefix('/admin')->name('admin.')->group(function () {
//     Route::get('/', function () {
//         return '<h1>Dashboard</h1>';
//     })->name('dashboard');

//     Route::get('/products', function () {
//         return '<h1>Products</h1>';
//     })->name('products');

//     Route::get('/posts', function () {
//         return '<h1>Posts</h1>';
//     })->name('posts');

//     Route::prefix('/users')->middleware(['role', 'test'])->name('users.')->group(function () {
//         Route::get('/', function () {
//             return '<h1>Users</h1>';
//         })->name('index');

//         Route::get('/add', function () {
//             return '<h1>Users Add</h1>';
//         })->name('add');

//         Route::get('/edit/{id}', function ($id) {
//             return '<h1>Users Edit '.$id.'</h1>';
//         })->name('edit');

//         Route::get('/delete/{id}', function ($id) {
//             return '<h1>Users Delete '.$id.'</h1>';
//         })->name('delete');
//     });
// });

// Route::get('/san-pham/{slug}-{id}.html', function ($slug, $id) {
//     return '<h1>'.$slug.'</h1><h1>'.$id.'</h1>';
// })->where([
//     'slug' => '.+',
//     'id' => '\d+'
// ]);

Route::get('/show', function () {
    // echo route('admin.dashboard').'<br/>';
    // echo route('admin.products').'<br/>';
    // echo route('admin.posts').'<br/>';
    // echo route('admin.users.index').'<br/>';
    // echo route('admin.users.add').'<br/>';
    // echo route('admin.users.edit', 1).'<br/>';
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});
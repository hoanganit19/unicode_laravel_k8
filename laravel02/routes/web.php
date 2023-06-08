<?php

use App\Models\User;
use App\Models\Group;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;

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

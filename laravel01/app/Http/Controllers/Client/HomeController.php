<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //return '<h1>Home Controller</h1>';
        $title = 'Học lập trình tại Unicode';
        return view('home.index', compact('title'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Danh sách người dùng';
        $users = [

        ];
        return view('admin.users.lists', compact('pageTitle', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pageTitle = 'Thêm người dùng';

        return view('admin.users.add', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //Thêm vào database
        return redirect()->route('admin.users.index')->with('msg', 'Thêm user thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return '<h1>Unicode Academy : '.$id.'</h1>';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Sửa người dùng';
        return view('admin.users.edit', compact('pageTitle', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        //Sửa trong Database
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

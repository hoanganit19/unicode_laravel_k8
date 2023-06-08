<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Danh sách người dùng';

        //DB::enableQueryLog();
        //$users = DB::table('users')
        //->selectRaw('max(age) as max_age, email')
        //->select('id', 'name', 'email', 'status as status_text')
        // ->where('id', '>=', 2)
        // ->where('id', '<=', 4)
        // ->where([
        //     [
        //         'id', '>=', 2
        //     ],
        //     [
        //         'id', '<=', 4
        //     ]
        // ])
        // ->where('id', '<=', 1)
        // ->orWhere('id', '>=', 4)
        // ->whereStatus(1)
        // ->where(function ($query) {
        //     $query->where('name', 'like', '%abc%');
        //     $query->orWhere('email', 'like', '%abc%');
        // })
        // ->orderBy('id', 'desc')
        // ->orderBy('name', 'asc')
        //->latest() //order by created_at desc
        //->inRandomOrder()
        // ->groupBy('email')
        // ->having('max_age', '>=', 30)
        // ->select('users.*', 'groups.name as group_name')
        // ->join('groups', 'users.group_id', '=', 'groups.id')
        // ->orderBy('users.created_at', 'desc')
        // ->get();


        //dd(DB::getQueryLog()); //show sql

        // dd($users); //show data

        $users = User::latest()->get();

        return view('admin.users.lists', compact('pageTitle', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pageTitle = 'Thêm người dùng';

        $groups = DB::table('groups')->orderBy('name', 'asc')->get();

        return view('admin.users.add', compact('pageTitle', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //Thêm vào database

        // $attributes = $request->except('_token');
        // $attributes['created_at'] = Carbon::now();
        // $attributes['updated_at'] = Carbon::now();

        //DB::table('users')->insert($attributes); //success => true, fail => false

        //User::create($request->all());

        return redirect()->route('admin.users.index')->with('msg', 'Thêm user thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Thông tin chi tiết';
        // $user = DB::table('users')
        // //->where('id', '=', $id)
        // //->where('id', $id)
        // ->whereId($id) //->whereEmail($email) ~ ->where('email', '=', $email)
        // ->first();

        $user = User::find($id);

        return view('admin.users.show', compact('user', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Sửa người dùng';

        //$groups = DB::table('groups')->orderBy('name', 'asc')->get();
        $groups = User::orderBy('name', 'asc')->get();

        // $user = DB::table('users')
        // ->whereId($id)
        // ->first();
        $user = User::find($id);

        return view('admin.users.edit', compact('pageTitle', 'id', 'groups', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        //Sửa trong Database
        $attributes = $request->except('_token', '_method');

        $attributes['updated_at'] = Carbon::now();

        DB::table('users')->whereId($id)->update($attributes);

        return back()->with('msg', 'Update user thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('users')->whereId($id)->delete();

        return redirect()->route('admin.users.index')->with('msg', 'Xóa user thành công');
    }
}

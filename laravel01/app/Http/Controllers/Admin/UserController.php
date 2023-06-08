<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        $users = User::latest();
        if ($request->status === 'active' || $request->status === 'inactive') {
            $status = $request->status === 'active' ? 1 : 0;

            $users->whereStatus($status);
        }


        if ($request->s) {
            $s = $request->s;
            $users->where(function ($query) use ($s) {
                $query->where('name', 'like', "%$s%");
                $query->orWhere('email', 'like', "%$s%");
            });
        }

        $users = $users->paginate(2)->withQueryString();

        return view('admin.users.lists', compact('pageTitle', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pageTitle = 'Thêm người dùng';

        //$groups = DB::table('groups')->orderBy('name', 'asc')->get();
        $groups = Group::orderBy('name', 'asc')->get();

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

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'status' => $request->status,
        //     'group_id' => $request->group_id
        // ]);

        // User::firstOrCreate([
        //     'name' => $request->name,
        // ], [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'status' => $request->status,
        //         'group_id' => $request->group_id
        //     ]);

        //create => lấy id user vừa create => insert vào 1 table khác

        $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->status = $request->status;
        // $user->group_id = $request->group_id;
        $user->fill($request->all()); //khai báo fillable
        $user->save();

        return redirect()->route('admin.users.index')->with('msg', 'Thêm user thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $pageTitle = 'Thông tin chi tiết';
        // $user = DB::table('users')
        // //->where('id', '=', $id)
        // //->where('id', $id)
        // ->whereId($id) //->whereEmail($email) ~ ->where('email', '=', $email)
        // ->first();

        //$user = User::find($id);

        return view('admin.users.show', compact('user', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    //dependency injection
    public function edit(User $user)
    {
        $pageTitle = 'Sửa người dùng';

        //$groups = DB::table('groups')->orderBy('name', 'asc')->get();
        $groups = Group::orderBy('name', 'asc')->get();

        // $user = DB::table('users')
        // ->whereId($id)
        // ->first();
        // $user = User::find($id);

        return view('admin.users.edit', compact('pageTitle', 'groups', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        //Sửa trong Database
        // $attributes = $request->except('_token', '_method');

        // $attributes['updated_at'] = Carbon::now();

        // DB::table('users')->whereId($id)->update($attributes);

        // $user = User::find($id);
        // $user->fill($request->all());
        // $user->save();
        $user->update($request->all());

        return back()->with('msg', 'Update user thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('users')->whereId($id)->delete();

        User::destroy($id);

        return redirect()->route('admin.users.index')->with('msg', 'Xóa user thành công');
    }

    public function getTrashed()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(2);
        $pageTitle = 'Thùng rác';
        return view('admin.users.trash', compact('pageTitle', 'users'));
    }

    public function restoreTrashed($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('msg', 'Khôi phục user thành công');
    }

    public function deleteTrashed($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('admin.users.trashed')->with('msg', 'Xóa vĩnh viễn thành công');
    }
}

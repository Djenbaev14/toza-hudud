<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    function __construct()
    {
         $this->middleware('permission:Пользователи|Добавить пользователя|Редактировать пользователя|Удалить пользователя', ['only' => ['index','show']]);
         $this->middleware('permission:Добавить пользователя', ['only' => ['create','store']]);
         $this->middleware('permission:Редактировать пользователя', ['only' => ['edit','update']]);
         $this->middleware('permission:Удалить пользователя', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users=User::where('deleted_at',null)->where('is_active',1)->orderBy('id','desc')->get();
        return view('pages.users.index',compact('users',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::whereNot('role_type','admin')->get();
        $branches=Branch::where('deleted_at',null)->where('is_active',1)->get();
        return view('pages.users.create',compact('roles','branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role_type=Role::findByName($request->role_name)->role_type;
        if($role_type=='employee'){
            $request->validate([
                'branch_id' => 'required',
                'role_name' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:users,phone,'.$request->phone,
            ]);
        }else{
            $request->validate([
                'branch_id' => 'required',
                'name' => 'required',
                'phone' => 'required|unique:users,phone,'.$request->phone,
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
        }
        
        User::create([
            'branch_id'=>$request->branch_id,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'login'=>$request->login ? $request->login : null ,
            'password'=>$request->password ? Hash::make($request->password) : null
        ])->assignRole($request->role_name);
        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function key(User $user){
        Auth::logout();
        Auth::login($user);

        return redirect()->route('home');
    }
}

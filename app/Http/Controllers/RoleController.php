<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Роли|Добавить роль|Редактировать роль|Удалить роль', ['only' => ['index','show']]);
         $this->middleware('permission:Добавить роль', ['only' => ['create','store']]);
         $this->middleware('permission:Редактировать роль', ['only' => ['edit','update']]);
         $this->middleware('permission:Удалить роль', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $roles = Role::where('name', 'LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
        return view('pages.roles.index', compact('roles','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // permissions list
        $permissions = Permission::all()->groupBy('group_name');
        return view('pages.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->checkAuthorization(auth()->user(), ['role-create']);

        $request->validate([
            'name'=>'required|unique:roles,name,'.$request->name,
        ]);
        
        $role = Role::create($request->all());
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success','created succesfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $role_type=Role::findByName($name)->role_type;
        return response()->json($role_type);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // permissions list
        $role = Role::find($id);
        $permissions = Permission::all()->groupBy('group_name');
        return view('pages.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role=Role::find($id);
        $role->update([
            'name'=>$request->name
        ]);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions([]);
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success','created succesfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

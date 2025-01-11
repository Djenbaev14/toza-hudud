<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\District;
use App\Models\Garage;
use App\Models\GarageDriver;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches=Branch::where('is_active',1)->where('deleted_at',null)->get();
        return view('pages.branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts=District::all();
        return view('pages.branches.create',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'name' => 'required|unique:branches,name,'.$request->name,
            ]);
        Branch::create([
            'user_id'=>auth()->user()->id,
            'district_id'=>$request->district_id,
            'name'=>$request->name,
        ]);
        return redirect()->route('branches.index')->with('success','Branch created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $garages=Garage::whereNotIn('garages.id', function($query) {
            $query->select('garage_id')->from('garage_drivers')->whereNull('deleted_at');
        })->with('car')->where('branch_id',$id)->where('deleted_at',null)->get();
        return response()->json($garages);
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
    function getEmployee($id){
        $employee=User::where('branch_id',$id)->where('is_active',1)->where('deleted_at',null)->get();
        return response()->json($employee);

    }
    function getGarages($id){
        $garages=GarageDriver::where('branch_id',$id)->whereNull('deleted_at')->where('is_active',1)->with('garage.car')->with('driver')->get();
        return response()->json($garages);
    }
}

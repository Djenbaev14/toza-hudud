<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\OutputStationery;
use App\Models\OutputStationeryProduct;
use App\Models\Stationery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutputStationeryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $search = $request->input('search', '');

        
        $outputStationeries=OutputStationery::where('deleted_at',null)->WhereHas('employee', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('id','desc')->paginate(10);
        $outputStationeries->appends(request()->query());
        return view('pages.output-stationery.index',compact('outputStationeries','search',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches=Branch::where('is_active',1)->where('deleted_at',null)->get();
        $employees = User::whereHas('roles', function ($query) {
            $query->where('role_type', '!=', 'admin');
        })->where('is_active',1)->where('deleted_at',null)->get();
        $products=Stationery::where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.output-stationery.create',compact('employees','products','branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id'=>'required',
            'employee_id'=>'required',
            'date'=>'required'
        ]);
        DB::beginTransaction();
        try {
            $OutputStationery=new OutputStationery();
            $OutputStationery->user_id=auth()->user()->id;
            $OutputStationery->employee_id=$request->employee_id;
            $OutputStationery->branch_id=$request->branch_id;
            $OutputStationery->date=$request->date;
            $OutputStationery->description=$request->description;
            $OutputStationery->save();

            for ($i=0; $i < count($request->product_id); $i++) { 
                if($request->quantity[$i] >0){
                    $OutputStationeryProduct=new OutputStationeryProduct();
                    $OutputStationeryProduct->output_stationery_id=$OutputStationery->id;
                    $OutputStationeryProduct->stationery_id=$request->product_id[$i];
                    $OutputStationeryProduct->quantity=$request->quantity[$i];
                    $OutputStationeryProduct->save();
                }
            }
            DB::commit();
            return redirect()->route('output-stationery.index')->with('success','Purchase created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al guardar la compra']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $output_stationery=OutputStationery::find($id);
        return view('pages.output-stationery.show',compact('output_stationery',));
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

    public function quanStationery($stationery_id){
        return response()->json(countStationery($stationery_id));
    }
}

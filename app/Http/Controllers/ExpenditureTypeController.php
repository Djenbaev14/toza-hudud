<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Expenditure_attribute;
use App\Models\Expenditure_type;
use App\Models\Type_attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenditureTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenditure_types=Expenditure_type::all();

        return response()->json($expenditure_types); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:expenditure_types,name,'.$request->name,
        ]);
        $expenditure_type=Expenditure_type::create([
            'name'=>$request->name
        ]);
        // foreach ($request->attribute_id as $value) {
        //     Type_attribute::create([
        //         'expenditure_type_id'=>$expenditure_type->id,
        //         'attribute_id'=>$value
        //     ]);
        // }
        return redirect()->back()->with('success','Расход типи табыслы косылды');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attributes=Type_attribute::where('expenditure_type_id',$id)->with('attribute')->get();
        // $attributes=Attribute::whereHas('type_attribute', function($q) use ($id){
        //     $q->where('expenditure_type_id','=',$id);
        // })->get();
        return response()->json($attributes); 
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
}

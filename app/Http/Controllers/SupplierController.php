<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $suppliers = Supplier::where('full_name','LIKE', '%' . $search . '%')->where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'=>'required',
            'full_name' => 'required',
            'phone' => 'required|unique:suppliers,phone,'.$request->phone,
            ]);
        Supplier::create([
            'user_id'=>auth()->user()->id,
            'supplier_type'=>$request->type,
            'full_name'=>$request->full_name,
            'phone'=>$request->phone,
        ]);
        return redirect()->route('suppliers.index')->with('success','Supplier created successfully');

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
        $supplier = Supplier::find($id);
        return view('pages.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            ]);
            Supplier::find($id)->update([
                'full_name'=>$request->full_name,
                'phone'=>$request->phone,
                ]);
            return redirect()->route('suppliers.index')->with('success','Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Spare_part;
use App\Models\Unit;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $spareParts = Spare_part::whereNull('deleted_at')->where('name', 'LIKE', '%' . $search . '%')->sortable()->orderBy('id','desc')->paginate(1);
        $spareParts->appends(request()->query());
        
        return view('pages.spare_parts.index', compact('spareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units=Unit::all();
        return view('pages.spare_parts.create',compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'unit_id' => 'required',
        ]);
        $product = new Spare_part();
        $product->user_id = auth()->user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->unit_id = $request->unit_id;
        $product->product_type = ($request->product_type) ? 'barcode' : 'no_barcode';
        $product->save();
        return redirect()->route('spare-part.index')->with('success', 'Успешно созданный продукт');
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
}

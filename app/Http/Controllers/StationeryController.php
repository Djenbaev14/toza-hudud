<?php

namespace App\Http\Controllers;

use App\Models\Stationery;
use App\Models\Unit;
use Illuminate\Http\Request;

class StationeryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stationeries = Stationery::where('deleted_at',null)->orderBy('id','desc')->paginate(10);
        
        return view('pages.stationery.index', compact('stationeries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units=Unit::all();
        return view('pages.stationery.create',compact('units'));
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
        $product = new Stationery();
        $product->user_id = auth()->user()->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->unit_id = $request->unit_id;
        $product->save();
        return redirect()->route('stationery.index')->with('success', 'Product created successfully');
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

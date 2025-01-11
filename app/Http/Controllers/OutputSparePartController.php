<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Driver;
use App\Models\Garage;
use App\Models\OutputSparePart;
use App\Models\Purchase_Spare_product;
use App\Models\Spare_part;
use Illuminate\Http\Request;

class OutputSparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $OutputSparePart=OutputSparePart::where('deleted_at',null)->orderBy('id','desc')->paginate(10); 
        return view('pages.output-spare-part.index',compact('OutputSparePart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches=Branch::where('is_active',1)->where('deleted_at',null)->get();
        $garages = Garage::whereNull('deleted_at')->get();
        $products=Spare_part::where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.output-spare-part.create',compact('garages','products','branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function quanSparePart($sparePartId){
        return response()->json(countSparePart($sparePartId));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $spare_part_id = 1;

        // Qidiruv
        $results = Purchase_Spare_product::where('barcode', 'LIKE', "%".$query."%")->get();

        return response()->json($results);
    }
}

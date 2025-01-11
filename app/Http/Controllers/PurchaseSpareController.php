<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase_Spare;
use App\Models\Purchase_Spare_product;
use App\Models\Spare_part;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseSpareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search request
        $search = $request->input('search');
        
        $purchases=Purchase_Spare::where('deleted_at',null)->orderBy('id','desc')->paginate(10); 
        return view('pages.purchase-spare-part.index',compact('purchases'));
    }

    public function create()
    {
        $suppliers=Supplier::where('supplier_type','=','spare-part')->where('deleted_at',null)->orderBy('id','desc')->get();
        $products=Spare_part::where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.purchase-spare-part.create',compact('suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'=>'required',
            'date'=>'required',
            'product_id' => 'required|array',
            'product_id.*' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $purchase=new Purchase_Spare();
            $purchase->user_id=auth()->user()->id;
            $purchase->supplier_id=$request->supplier_id;
            $purchase->date=$request->date;
            $purchase->description=$request->description;
            $purchase->save();

            for ($i=0; $i < count($request->product_id); $i++) { 
                $purchase_product=new Purchase_Spare_product();
                $purchase_product->user_id=auth()->user()->id;
                $purchase_product->supplier_id=$request->supplier_id;
                $purchase_product->purchase__spare_id=$purchase->id;
                $purchase_product->spare_part_id=$request->product_id[$i];
                $purchase_product->quantity=(Spare_part::find($request->product_id[$i])->product_type=='barcode') ? 1 :$request->quantity[$i];
                $purchase_product->barcode=(Spare_part::find($request->product_id[$i])->product_type=='barcode') ?$request->barcode[$i]:null;
                $purchase_product->price=$request->price[$i];
                $purchase_product->save();
            }
            DB::commit();
            return redirect()->route('purchase-spare-part.index')->with('success','Purchase created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['Error al guardar la compra']);
        }

    }

    /**
     */
    public function show(string $id)
    {
        $purchase=Purchase_Spare::find($id);
        return view('pages.purchase-spare-part.show',compact('purchase',));
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
    public function getProductPrice($id)
    {
        $product = Spare_part::find($id); // Ma'lumotlar bazasidan mahsulotni topish
        if ($product) {
            return response()->json(['price' => $product->price,'product_type' => $product->product_type]);
        }
        return response()->json(['message' => 'Mahsulot topilmadi!'], 404);
    }
}

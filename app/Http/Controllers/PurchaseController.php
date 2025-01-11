<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchase_product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search request
        $search = $request->input('search');
        
        $purchases=Purchase::where('deleted_at',null)->orderBy('id','desc')->paginate(10); 
        return view('pages.purchases.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers=Supplier::where('deleted_at',null)->orderBy('id','desc')->get();
        $products=Product::where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.purchases.create',compact('suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'supplier_id'=>'required',
            'date'=>'required'
        ]);
        DB::beginTransaction();
        try {
            $purchase=new Purchase();
            $purchase->user_id=auth()->user()->id;
            $purchase->supplier_id=$request->supplier_id;
            $purchase->date=$request->date;
            $purchase->description=$request->description;
            $purchase->save();

            for ($i=0; $i < count($request->product_id); $i++) { 
                $purchase_product=new Purchase_product();
                $purchase_product->purchase_id=$purchase->id;
                $purchase_product->product_id=$request->product_id[$i];
                $purchase_product->quantity=$request->quantity[$i];
                $purchase_product->price=$request->price[$i];
                $purchase_product->save();
            }
            DB::commit();
            return redirect()->route('purchases.index')->with('success','Purchase created successfully');
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
        $purchase=Purchase::find($id);
        return view('pages.purchases.show',compact('purchase',));
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
        $product = Product::find($id); // Ma'lumotlar bazasidan mahsulotni topish
        if ($product) {
            return response()->json(['price' => $product->price]);
        }
        return response()->json(['message' => 'Mahsulot topilmadi!'], 404);
    }
}

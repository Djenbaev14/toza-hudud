<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\District;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        
        $customers = Customer::where('full_name','LIKE', '%' . $search . '%')->orWhere('phone','LIKE', '%' . $search . '%')->where('deleted_at',null)->orderBy('id','desc')->paginate(20);
        $customers->appends(request()->query());
        return view('pages.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts=District::all();
        return view('pages.customers.create',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'=>'required',
            'full_name'=>'required',
            'phone'=>'required',
            'birth_date'=>'date',
            'district_id'=>'required|exists:districts,id',
            'pinfl_or_inn'=>'required'
        ]);
        if($request->has('type') && $request->type=="legal"){
            $request->validate([
                "company_name"=>"required",
            ]);
        }

        $client=new Customer();
        $client->user_id=auth()->user()->id;
        $client->type=$request->type;
        $client->full_name=$request->full_name;
        $client->phone=$request->phone;
        $client->company_name=$request->company_name;
        $client->birth_date=$request->birth_date;
        $client->district_id=$request->district_id;
        $client->address=$request->address;
        $client->description=$request->description;
        $client->save();
        return redirect()->route('clients.index')->with('success','Client created successfully');
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

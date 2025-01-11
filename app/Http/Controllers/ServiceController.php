<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Unit;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    function __construct()
    {
         $this->middleware('permission:услуга|Добавить услуга|Редактировать услуга|Удалить услуга', ['only' => ['index','show']]);
         $this->middleware('permission:Добавить услуга', ['only' => ['create','store']]);
         $this->middleware('permission:Редактировать услуга', ['only' => ['edit','update']]);
         $this->middleware('permission:Удалить услуга', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $services = Service::where('name','LIKE', '%' . $search . '%')->orderBy('id','desc')->get();
        return view('pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units=Unit::orderBy('id','desc')->get();
        return view('pages.services.create',compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:services,name,'.$request->name,
            'price'=>'required',
            'unit_id'=>'required|exists:units,id'
        ]);

        Service::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'unit_id'=>$request->unit_id,
        ]);
        return redirect()->route('services.index')->with('success','Успешно созданный');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);
        return view('pages.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);
        $units = Unit::orderBy('id','desc')->get();
        return view('pages.services.edit', compact('service','units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'unit_id'=>'required|exists:units,id'
        ]);

        $service=Service::findOrFail($id);
        $service->name=$request->name;
        $service->price=$request->price;
        $service->unit_id=$request->unit_id;
        $service->save();
        return redirect()->route('pages.services.index')->with('success','Успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Certificate_category;
use App\Models\Driver;
use App\Models\Driver_license;
use App\Models\Garage;
use App\Models\GarageDriver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Водитель|Добавить водитель|Редактировать водитель|Удалить водитель', ['only' => ['index','show']]);
        $this->middleware('permission:Добавить водитель', ['only' => ['create','store']]);
        $this->middleware('permission:Редактировать водитель', ['only' => ['edit','update']]);
        $this->middleware('permission:Удалить водитель', ['only' => ['destroy']]);
   }
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $search = $request->input('search', '');

        $drivers=Driver::where('drivers.deleted_at',null)->orderBy('id','desc')->where('full_name','LIKE', '%' . $search . '%')->sortable()->paginate(10);
        return view('pages.drivers.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $garages=Garage::whereNull('deleted_at')->orderBy('id','desc')->get();
        $branches=Branch::where('is_active',1)->where('deleted_at',null)->orderBy('id','desc')->get();
        $categories=Certificate_category::all();
        return view('pages.drivers.create',compact('garages','categories','branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required|unique:drivers,full_name,'.$request->full_name,
            'birth_date'=>'required',
            'passport'=>'required',
            'phone'=>'required|unique:drivers,phone,'.$request->phone,
            'given_by_whom'=>'required',
            'license_number'=>'required',
            'certificate_category_id'=>'required',
            'license_issue_date'=>'required',
            'license_expiry_date'=>'required',
            'branch_id'=>'required',
            'garage_id'=>'required|unique:garage_drivers,garage_id,'.$request->garage_id,
        ]);
        if($request->has('photo')){
            $request->validate([
                'license_photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // photo storage
            $photo=$request->license_photo;
            $photo_name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images/drivers'),$photo_name);
        }else{
            $photo_name=null;
        }
        // end photo storage
        $driver=Driver::create([
            'user_id'=>auth()->user()->id,
            'full_name'=>$request->full_name,
            'birth_date'=>$request->birth_date,
            'passport'=>$request->passport,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'given_by_whom'=>$request->given_by_whom,
        ]);
        // GarageDriver::create([
        //     'user_id'=>auth()->user()->id,
        //     'branch_id'=>$request->branch_id,
        //     'driver_id'=>$driver->id,
        //     'garage_id'=>$request->garage_id
        // ]);
        Driver_license::create([
            'driver_id'=>$driver->id,
            'license_number'=>$request->license_number,
            'license_issue_date'=>$request->license_issue_date,
            'license_expiry_date'=>$request->license_expiry_date,
            'license_photo'=>$photo_name,
            'certificate_category_id'=>$request->certificate_category_id,
        ]);
        return redirect()->route('drivers.index')->with('success','Driver created successfully');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver=Driver::with(['garage_driver' => function($query){
            $query->orderBy('created_at','desc');
        }])->find($id);
        $categories=Certificate_category::all();
        return view('pages.drivers.show',compact('driver','categories'));
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

    public function getDriver($garage_driver_id){
        $garage_driver=GarageDriver::with('driver')->with('garage')->find($garage_driver_id);
        return response()->json($garage_driver);
    }
}

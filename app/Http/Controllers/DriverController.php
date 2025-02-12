<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Certificate_category;
use App\Models\Driver;
use App\Models\Driver_license;
use App\Models\Garage;
use App\Models\GarageDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $categories=Certificate_category::all();
        return view('pages.drivers.create',compact('categories'));
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
        $driver=Driver::find($id);
        $categories=Certificate_category::all();
            
        return view('pages.drivers.edit',compact('driver','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name'=>'required',
            'birth_date'=>'required',
            'passport'=>'required',
            'phone'=>'required',
            'given_by_whom'=>'required',
            'license_number'=>'required',
            'certificate_category_id'=>'required',
            'license_issue_date'=>'required',
            'license_expiry_date'=>'required',
        ]);

        DB::beginTransaction();
        try {
            Driver::find($id)->update([
                'full_name'=>$request->full_name,
                'birth_date'=>$request->birth_date,
                'passport'=>$request->passport,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'given_by_whom'=>$request->given_by_whom,
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
            Driver_license::where('driver_id',$id)->update([
                'driver_id'=>$id,
                'license_number'=>$request->license_number,
                'license_issue_date'=>$request->license_issue_date,
                'license_expiry_date'=>$request->license_expiry_date,
                'license_photo'=>$photo_name,
                'certificate_category_id'=>$request->certificate_category_id,
            ]);
    
            DB::commit();
            return redirect()->route('drivers.index')->with('success','Информация о драйвере успешно изменена');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('drivers.index')->with('error',$th->getMessage());
        }

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

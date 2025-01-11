<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Expenditure_type;
use App\Models\Garage;
use App\Models\Standart_Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GarageController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:Гараж|Добавить гараж|Редактировать гараж|Удалить гараж', ['only' => ['index','show']]);
        $this->middleware('permission:Добавить гараж', ['only' => ['create','store']]);
        $this->middleware('permission:Редактировать гараж', ['only' => ['edit','update']]);
        $this->middleware('permission:Удалить гараж', ['only' => ['destroy']]);
   }
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        

        $cars=Car::whereNull('deleted_at')->get();
        $drivers=Driver::whereNull('deleted_at')->get();
        $garages=Garage::whereNull('garages.deleted_at')->WhereHas('car', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orWhere('car_number','LIKE', '%' . $search . '%')->sortable()->paginate(20);
        $garages->appends(request()->query());
        return view('pages.garages.index',compact('garages','cars','drivers'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenditure_types=Expenditure_type::where('standard_type',1)->get();
        $branches=Branch::where('is_active',1)->where('deleted_at',null)->get();
        $cars=Car::where('deleted_at',null)->get();
        return view('pages.garages.create',compact('cars','expenditure_types','branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id'=>'required|exists:branches,id',
            'car_id'=>'required|exists:cars,id',
            'car_number'=>'required',
            'manufacturing_year'=>'required|numeric',
            'current_mileage'=>'required|numeric',
            'att'=>'array',
            'engine_number'=>'required',
            'body_number'=>'required',
        ]);

        DB::beginTransaction();
        try {
            $garage=Garage::create([
                'user_id'=>auth()->user()->id,
                'branch_id'=>$request->branch_id,
                'car_id'=>$request->car_id,
                'car_number'=>$request->car_number,
                'manufacturing_year'=>$request->manufacturing_year,
                'current_mileage'=>$request->current_mileage,
                'engine_number'=>$request->engine_number,
                'body_number'=>$request->body_number,
                'wine_number'=>$request->wine_number,
            ]);
    
            foreach ($request->att as $key => $value) {
                if($value['size'] && $value['km']){
                    Standart_Expenditure::create([
                        'garage_id'=>$garage->id,
                        'expenditure_type_id'=>$key,
                        'size'=>$value['size'],
                        'km'=>$value['km'],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('garages.index')->with('success','Автомобиль успешно пристроен в гараж');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('garages.index')->with('error',$th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Garage $garage)
    {
        return response()->json($garage); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Garage $garage)
    {
        $expenditure_types=Expenditure_type::where('standard_type',1)->get();
        $cars=Car::where('deleted_at',null)->get();
        return view('pages.garages.edit',compact('garage','cars','expenditure_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Garage $garage)
    {
        $request->validate([
            'car_id'=>'required|exists:cars,id',
            'car_number'=>'required',
            'manufacturing_year'=>'required|numeric',
            'engine_number'=>'required',
            'body_number'=>'required',
            'att'=>'array',
        ]);

        DB::beginTransaction();
        try {
            // garage update
            $garage->update([
                'car_id'=>$request->car_id,
                'car_number'=>$request->car_number,
                'manufacturing_year'=>$request->manufacturing_year,
                'engine_number'=>$request->engine_number,
                'body_number'=>$request->body_number,
                'wine_number'=>$request->wine_number,
                ]);
    
            foreach ($request->att as $key => $value) {
                if($value['size'] && $value['km']){

                    if(Standart_Expenditure::where('garage_id',$garage->id)
                    ->where('expenditure_type_id',$key)->exists()){
                        Standart_Expenditure::where('garage_id',$garage->id)
                        ->where('expenditure_type_id',$key)
                        ->update([
                            'garage_id'=>$garage->id,
                            'expenditure_type_id'=>$key,
                            'size'=>$value['size'],
                            'km'=>$value['km'],
                        ]);
                    }else{
                        Standart_Expenditure::create([
                            'garage_id'=>$garage->id,
                            'expenditure_type_id'=>$key,
                            'size'=>$value['size'],
                            'km'=>$value['km'],
                        ]);
                    }
                    
                }
            }
            DB::commit();
            return redirect()->route('garages.index')->with('success','Автомобиль в гараже успешно переделан');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('garages.index')->with('error',$th->getMessage());
        }

    }

    public function destroy($garage_id)
    {
        $garage=Garage::with('driver')->find($garage_id);
        if (!$garage) {
            return response()->json(['message' => 'Автомобиль не найден'], 404);
        }
        $garage->delete();
        return response()->json(['message' => 'Автомобиль был удален из гаража'], 200);
    }
    public function driverStore(Request $request){
        $request->validate([
            'name'=>'required|unique:drivers,name,'.$request->name,
            'phone'=>'required|unique:drivers,phone,'.$request->phone,
        ]);

        Driver::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
        ]);
        return redirect()->back()->with('success','Водител успешно добавлен');
    }
    public function carStore(Request $request){
        $request->validate([
            'name'=>'required|unique:cars,name,'.$request->name,
        ]);

        Car::create([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Автомобил успешно добавлен');
    }
    public function garageExpens($type_id,$garage_id){
        if(Standart_Expenditure::where('garage_id',$garage_id)->where('expenditure_type_id',$type_id)->exists()){
            $garage_expens=Standart_Expenditure::with('expenditure_type.unit')->where('garage_id',$garage_id)->where('expenditure_type_id',$type_id)->first();
            return response()->json($garage_expens);
        }
    }

    public function updateStatus($garage_id,Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|boolean',  // Ensure status is a boolean (1 or 0)
        ]);

        $garage=Garage::find($garage_id);

        if ($garage) {
            // Update the status
            $garage->is_active = $request->status;
            $garage->save();

            return response()->json(['message' => 'Status updated successfully'],200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Driver;
use App\Models\Garage;
use App\Models\GarageDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotoristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        
        $motorists=GarageDriver::whereNull('garage_drivers.deleted_at')->WhereHas('garage', function ($query) use ($search) {
            $query->where('car_number', 'LIKE', '%' . $search . '%');
        })->orWhereHas('garage', function ($query) use ($search) {
            $query->WhereHas('car', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        })->orWhereHas('driver', function ($query) use ($search) {
            $query->where('full_name', 'LIKE', '%' . $search . '%');
        })->sortable()->paginate(10);
        $motorists->appends(request()->query());
        return view('pages.motorists.index',compact('motorists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $garages=Garage::whereNull('deleted_at')->whereDoesntHave('garage_driver', function ($query) {
            $query->where('deleted_at',null);
        })->orderBy('id','desc')->get();
        $drivers=Driver::whereNull('deleted_at')->whereDoesntHave('garage_driver', function ($query) {
            $query->where('deleted_at',null);
        })->orderBy('id','desc')->get();
        return view('pages.motorists.create',compact('garages','drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'garage_id'=>'required',
            'driver_id'=>'required',
        ]);
        if(GarageDriver::where('driver_id',$request->driver_id)->where('garage_id',$request->garage_id)->exists()){
            return redirect()->route('motorists.index')->with('error','Error');
        } else{
            GarageDriver::create([
                'user_id'=> Auth::user()->id,
                'branch_id'=>Garage::find($request->garage_id)->branch_id,
                'garage_id'=>$request->garage_id,
                'driver_id'=>$request->driver_id,
            ]);
        }


        return redirect()->route('motorists.index')->with('success','Success created');
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
    public function destroy($motorist_id)
    {
        $motorist=GarageDriver::with('driver')->find($motorist_id);
        if (!$motorist) {
            return response()->json(['message' => 'Водитель автомобиля не найден'], 404);
        }
        $motorist->delete();
        return response()->json(['message' => 'Водитель автомобиля удален'], 200);
    }
    public function updateStatus($motorist_id,Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|boolean',  // Ensure status is a boolean (1 or 0)
        ]);

        $motorist=GarageDriver::find($motorist_id);
        if ($motorist) {
            // Update the status
            $motorist->is_active = $request->status;
            $motorist->save();

            return response()->json(['message' => 'Статус успешно обновлен'],200);
        }

        return response()->json(['error' => 'Драйвер не найден'], 404);
    }
    
}

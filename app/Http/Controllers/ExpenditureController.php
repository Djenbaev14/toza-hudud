<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Expenditure;
use App\Models\Expenditure_type;
use App\Models\Expenditure_type_attribute;
use App\Models\Garage;
use App\Models\Garage_expenditure_type;
use App\Models\Type_attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenditureController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:расходование|Добавить расходование|Редактировать расходование|Удалить расходование', ['only' => ['index','show']]);
        $this->middleware('permission:Добавить расходование', ['only' => ['create','store']]);
        $this->middleware('permission:Редактировать расходование', ['only' => ['edit','update']]);
        $this->middleware('permission:Удалить расходование', ['only' => ['destroy']]);
   }
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', default: 20);
        $search = $request->input('search', '');

        
        $expenditures=Expenditure::where('deleted_at',null)->whereHas('expenditure_type', function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orWhereHas('garage', function ($query) use ($search) {
            $query->where('car_number', 'LIKE', '%' . $search . '%');
        })->orderBy('id','desc')->paginate($perPage);
        $expenditures->appends(request()->query());
        return view('pages.expenditures.index',compact('expenditures','search','perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers=Driver::whereNull('deleted_at')->get();
        $expenditure_types=Expenditure_type::all();
        return view('pages.expenditures.create',compact('drivers','expenditure_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'garage_id'=>'required|exists:drivers,id',
            'expenditure_type_id'=>'required|exists:expenditure_types,id',
        ]);
        DB::beginTransaction();
        try {
            
            $expenditure=Expenditure::create([
                'user_id'=>auth()->user()->id,
                'garage_id'=>$request->garage_id,
                'driver_id'=>Driver::where('garage_id',$request->garage_id)->first()->id,
                'expenditure_type_id'=>$request->expenditure_type_id,
                'price'=>$request->price,
                'comment'=>$request->comment,
            ]);

            $garage_expens=Garage_expenditure_type::create([
                'garage_id'=>$expenditure->garage_id,
                'driver_id'=>$expenditure->driver_id,
                'expenditure_type_id'=>$expenditure->expenditure_type_id,
                'expenditure_id'=>$expenditure->id,
                'size'=>$request->size,
                'km'=>$request->km,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Расход косыуда кателик бар');
        }
        // return redirect back
        return redirect()->route('expenditures.index')->with('success','Расход табыслы косылды');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expenditure=Expenditure::where('id',$id)->where('deleted_at',null)->first();
        return view('pages.expenditures.show',compact('expenditure'));
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
        return 1;
    }
}

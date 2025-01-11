<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Contract;
use App\Models\ContractDetail;
use App\Models\Customer;
use App\Models\Service;
use Barryvdh\DomPDF\PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContractController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:договор|Добавить договор|Редактировать договор|Удалить договор', ['only' => ['index','show']]);
        $this->middleware('permission:Добавить договор', ['only' => ['create','store']]);
        $this->middleware('permission:Редактировать договор', ['only' => ['edit','update']]);
        $this->middleware('permission:Удалить договор', ['only' => ['destroy']]);
   }
    public function index()
    {
        $contracts = Contract::whereNull('deleted_at')->get();
        return view('pages.contracts.index',compact('contracts'));
    }

    public function create()
    {
        $branches=Branch::whereNull('deleted_at')->where('is_active',1)->get();
        $clients=Customer::orderBy('id','desc')->get();
        $services=Service::orderBy('id','desc')->get();
        return view('pages.contracts.create',compact('services','clients','branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinfl_or_inn'=>'required|exists:customers,pinfl_or_inn',
            'branch_id'=>'required|exists:branches,id',
            'duration_date'=>'required|date|after:today',
            'contract_number'=>'required|unique:contracts,contract_number,'.$request->contract_number,
            'address'=>'required',
            'per_week'=>'required|array',
            'per_week.*'=>'required'
        ]);

        try {
            $customer_id=Customer::where('pinfl_or_inn','=',$request->pinfl_or_inn)->first()->id;

            $contract=new Contract();
            $contract->branch_id=$request->branch_id;
            $contract->contract_number=$request->contract_number;
            $contract->user_id=auth()->user()->id;
            $contract->customer_id=$customer_id;
            $contract->address=$request->address;
            $contract->duration_date=$request->duration_date;
            $contract->save();

            for ($i=0; $i < count($request->service_id); $i++) { 
                ContractDetail::create([
                    'contract_id'=>$contract->id,
                    'user_id'=>auth()->user()->id,
                    'customer_id'=>$customer_id,
                    'service_id'=>$request->service_id[$i],
                    'quantity'=>$request->quantity[$i],
                    'per_week'=>$request->per_week[$i]
                ]);
            }
            DB::commit();
            return redirect()->route('contracts.index')->with('success','Договор успешно добавлен');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Ошибка при добавлении договора');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract=Contract::find($id);
        return view('pages.contracts.show',compact('contract'));
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
    public function generatePDF($id)
    {
        $contract=Contract::find($id);
        $totalSum = $contract->contract_detail->sum(function($detail) {
            return $detail->service->price * $detail->quantity;
        });
        $data = ['branch'=>$contract->branch->name,'contract_number' => $contract->contract_number,'created_at'=>$contract->created_at,'per_week'=>$contract->per_week,'address'=>$contract->address,'totalSum'=>number_format($totalSum,2,',', '.').' сум','duration_date'=>$contract->duration_date,'customer_address'=>$contract->customer->addresss,'customer_name'=>$contract->customer->full_name,'customer_phone'=>$contract->customer->phone,'pinfl_or_inn'=>$contract->customer->pinfl_or_inn];  

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf', $data);

        return $pdf->download('document.pdf');
    }

    public function getServicePrice($id)
    {
        $service = Service::find($id); // Ma'lumotlar bazasidan mahsulotni topish
        if ($service) {
            return response()->json(['price' => $service->price,'unit'=>$service->unit->name]);
        }
        return response()->json(['message' => 'Mahsulot topilmadi!'], 404);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Customer::where('pinfl_or_inn', 'LIKE', "%".$query."%")->take(10)->pluck('pinfl_or_inn');

        return response()->json($results);
    }
    public function details(Request $request)
    {

        $result = Customer::where('pinfl_or_inn', '=',$request->pinfl_or_inn)->first();

        return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expenditure_type;
use App\Models\Garage;
use App\Models\Garage_expenditure_type;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:Главная страница', ['only' => ['index']]);
    // }
    
    public function index(){

        // $garage_expens=Garage_expenditure_type::with('expenditure.garage')->get();
        // // $garages=Garage::with('garage_expenditure_type')->get();
        // $expenditure_types=Expenditure_type::where('standard_type',1)->with('garage_expens')->join('garage_expenditure_types', 'garage_expenditure_types.expenditure_type_id', '=', 'expenditure_types.id')->groupBy('garage_expens.garage_id')
        // ->get();
        // return $expenditure_types;
        return view('home');
    }
}

<?php

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Garage;
use App\Models\OutputSparePartProduct;
use App\Models\OutputStationeryProduct;
use App\Models\Purchase_Spare_product;
use App\Models\Purchase_stationer_product;
use App\Models\Spare_part;
use App\Models\User;

  function totalSumPurchaseSparePart($purchase_products){
    $total=0;
    foreach ($purchase_products as $purchase_product) {
      $total+=$purchase_product->price*$purchase_product->quantity;
    }
    return $total;
  }
  function totalSumPurchaseStationery($purchase_products){
    $total=0;
    foreach ($purchase_products as $purchase_product) {
      $total+=$purchase_product->price*$purchase_product->quantity;
    }
    return $total;
  }
  function supplierBalanceSparePart($supplier_id){
    // $balance=0;
    $purchase_products=Purchase_Spare_product::where('supplier_id','=',$supplier_id)->sum(DB::raw('quantity * price'));
    // $balance+=totalSumPurchaseSparePart($purchase_products);
    return $purchase_products;
  }
  function supplierBalanceStationery($supplier_id){
    // $balance=0;
    $purchase_products=Purchase_stationer_product::where('supplier_id','=',$supplier_id)->sum(DB::raw('quantity * price'));
    // $balance+=totalSumPurchaseSparePart($purchase_products);
    return $purchase_products;
  }

  function countStationery($stationery_id){
    $count=Purchase_stationer_product::where('stationery_id','=',$stationery_id)->sum('quantity')-OutputStationeryProduct::where('stationery_id','=',$stationery_id)->sum('quantity');
    return $count;
  }
  function countSparePart($spare_part_id){
    // if(Spare_part::find($spare_part_id)->product_type=='barcode'){
      
    // }else{
      $count=Purchase_Spare_product::where('spare_part_id','=',$spare_part_id)->sum('quantity')-OutputSparePartProduct::where('spare_part_id','=',$spare_part_id)->sum('quantity');
    // }
    return $count;
  }

  function countCar(){
    return Garage::whereNull('deleted_at')->count();
  }
  function countDriver(){
    return Driver::whereNull('deleted_at')->count();
  }
  function countClient(){
    return Customer::whereNull('deleted_at')->count();
  }
  function countUser(){
    return User::whereDoesntHave('roles', function ($query) {
      $query->where('name', 'Главный админ');
  })->whereNull('deleted_at')->count();
  }

?>
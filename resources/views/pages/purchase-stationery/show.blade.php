@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

    <h4 class="fw-bold mb-3 mt-3">Покупка №{{$purchase->id}} | {{$purchase->supplier->full_name}}</h4>

        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="row  justify-content-between p-2" >
                        <div class="col-4">
                          <h4 class="fw-bold mb-3">Покупки</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('purchase-stationery.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                        <h4>Информация о поставщике</h4>
                        <table>
                          <tr>
                            <td class="fw-bold">Поставщик :</td>
                            <td>{{$purchase->supplier->full_name}}</td>
                          </tr>
                          <tr>
                            <td class="fw-bold">Телефон :</td>
                            <td>{{$purchase->supplier->phone}}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col">
                        <h4>Информация о поставщике</h4>
                        <table>
                          <tr>
                            <td ><span class="fw-bold">Дата :</span> {{$purchase->date}}</td>
                          </tr>
                          <tr>
                            <td ><span class="fw-bold">Сумма :</span> {{number_format(totalSumPurchaseStationery($purchase->purchase_stationer_product))}} сум</td>
                          </tr>
                          <tr>
                            <td><span class="fw-bold">Количество товаров :</span> {{$purchase->purchase_stationer_product->count()}}</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                      <table class="table table-bordered table-responsive ">
                        <thead>
                          <tr>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($purchase->purchase_stationer_product as $product)
                            <tr>
                              <td>{{$product->stationery->name}}</td>
                              <td>{{number_format($product->price)}} сум</td>
                              <td>{{number_format($product->quantity)}} {{$product->stationery->unit->name}}</td>
                              <td>{{number_format($product->quantity*$product->price)}} сум</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="3" class="text-end fw-bold">Итого:</td>
                            <td>{{number_format(totalSumPurchaseStationery($purchase->purchase_stationer_product))}} сум</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection

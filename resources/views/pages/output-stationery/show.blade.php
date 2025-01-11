@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

    <h4 class="fw-bold mb-3 mt-3">Расход №{{$output_stationery->id}} | {{$output_stationery->employee->name}}</h4>

        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="row  justify-content-between p-2" >
                        <div class="col-4">
                          <h4 class="fw-bold mb-3">Расход</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('output-stationery.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                        <h4>Информация о Сотрудник</h4>
                        <table>
                          <tr>
                            <td class="fw-bold">Сотрудник :</td>
                            <td>{{$output_stationery->employee->name}}</td>
                          </tr>
                          <tr>
                            <td class="fw-bold">Телефон :</td>
                            <td>{{$output_stationery->employee->phone}}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col">
                        <h4>Информация о поставщике</h4>
                        <table>
                          <tr>
                            <td ><span class="fw-bold">Дата :</span> {{$output_stationery->date}}</td>
                          </tr>
                          <tr>
                            {{-- <td ><span class="fw-bold">Сумма :</span> {{number_format(totalSumPurchaseStationery($purchase->purchase_stationer_product))}} сум</td> --}}
                          </tr>
                          <tr>
                            <td><span class="fw-bold">Количество товаров :</span> {{$output_stationery->output_stationery_product->count()}}</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                      <table class="table table-bordered table-responsive ">
                        <thead>
                          <tr>
                            <th>Наименование</th>
                            <th>Количество</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($output_stationery->output_stationery_product as $product)
                            <tr>
                              <td>{{$product->stationery->name}}</td>
                              <td>{{number_format($product->quantity)}} {{$product->stationery->unit->name}}</td>
                              {{-- <td>{{number_format($product->quantity*$product->price)}} сум</td> --}}
                            </tr>
                          @endforeach
                          {{-- <tr>
                            <td colspan="3" class="text-end fw-bold">Итого:</td>
                            <td>{{number_format(totalSumPurchaseStationery($purchase->purchase_stationer_product))}} сум</td>
                          </tr> --}}
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection

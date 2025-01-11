@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h4 class="fw-bold m-0">№{{$expenditure->id}}</h4>
                      <a href="{{route('expenditures.index')}}" class="btn btn-success">
                        Назад
                      </a>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive mb-3 col-8">
                          <table class="table table-bordered" id="expenditures-table">
                              <tbody>
                                <tr>
                                  <td scope="col" class="fw-bold">Тип расход</td>
                                  <td scope="col">{{$expenditure->expenditure_type->name}}</td>
                                </tr>
                                <tr>
                                  <td scope="col" class="fw-bold">Автомобил</td>
                                  <td scope="col">{{$expenditure->garage->car_number}} | {{$expenditure->garage->car->name}}</td>
                                </tr>
                                <tr>
                                  <td scope="col" class="fw-bold">Пользователь</td>
                                  <td scope="col">{{$expenditure->driver->full_name}}</td>
                                </tr>
                                <tr>
                                  <td scope="col" class="fw-bold">Прайс</td>
                                  <td scope="col">{{number_format($expenditure->price)}} сум</td>
                                </tr>
                                @if ($expenditure->garage_expens)
                                  <tr>
                                    <td><b>Атрибуты</b></td>
                                    <td scope="col">
                                      {{$expenditure->garage_expens->km}} km &nbsp; &nbsp; ->   &nbsp; &nbsp;{{$expenditure->garage_expens->size}}  {{$expenditure->expenditure_type->unit->name}}
                                    </td>
                                  </tr>
                                @endif
                                <tr>
                                  <td scope="col" class="fw-bold">Комментария</td>
                                  <td scope="col" >{{$expenditure->comment}}</td>
                                </tr>
                                <tr>
                                  <td scope="col" class="fw-bold">Время создания</td>
                                  <td scope="col" >{{$expenditure->created_at->format('Y-d-m H:i')}}</td>
                                </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection

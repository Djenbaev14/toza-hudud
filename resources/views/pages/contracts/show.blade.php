@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">{{$contract->full_name}}</h4>
                  </div><!-- end card header -->
                  <div class="card-body">
                    <div class="table-responsive mb-3">
                      <table class="table table-bordered mb-0" id="categories-table">
                          <tbody>
                            <tr>
                              <td class="fw-bold">ФИО</td>
                              <td>{{$contract->full_name}}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Дата рождения</td>
                              <td>{{$contract->birth_date}}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Телефон номер</td>
                              <td>{{$contract->phone}}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Паспорт серия</td>
                              <td>{{$contract->passport}}</td>
                            </tr>
                            <tr>
                              <td class="fw-bold">Время создания</td>
                              <td>{{$contract->created_at}}</td>
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

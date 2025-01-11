@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="row  justify-content-between p-2" >
                        <div class="col-4">
                          <h4 class="fw-bold mb-3">{{$service->name}}</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('services.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  <div class="card-body">
                    
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                          Информация
                          </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Заказы</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mb-0" id="categories-table">
                                <tbody>
                                  <tr>
                                    <td class="fw-bold">Название</td>
                                    <td>{{$service->name}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Единица</td>
                                    <td>{{$service->unit->name}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Цена</td>
                                    <td>{{number_format($service->price,2)}} сум</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mb-0" id="categories-table">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection

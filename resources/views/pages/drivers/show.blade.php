@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">{{$driver->full_name}}</h4>
                  </div><!-- end card header -->
                  <div class="card-body">
                    
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Основное</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Водительские права</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile-car" type="button" role="tab" aria-controls="pills-profile-car" aria-selected="false">Информация о креплении автомобиля</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mb-0" id="categories-table">
                                <tbody>
                                  <tr>
                                    <td class="fw-bold">ФИО</td>
                                    <td>{{$driver->full_name}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Дата рождения</td>
                                    <td>{{$driver->birth_date}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Телефон номер</td>
                                    <td>{{$driver->phone}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Паспорт серия</td>
                                    <td>{{$driver->passport}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Время создания</td>
                                    <td>{{$driver->created_at}}</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mb-0" id="categories-table">
                                <tbody>
                                  <tr>
                                    <td class="fw-bold">Номер сертификата</td>
                                    <td>{{$driver->driver_license->license_number}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Категории</td>
                                    <td>
                                      @foreach ($driver->driver_license->certificate_category_id as $category_id)
                                          {{$categories->find($category_id)->name}}
                                      @endforeach
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Дата выдачи</td>
                                    <td>{{$driver->driver_license->license_issue_date}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Срок годности</td>
                                    <td>{{$driver->driver_license->license_expiry_date}}</td>
                                  </tr>
                                  <tr>
                                    <td class="fw-bold">Права файл</td>
                                    <td><img src="{{asset('images/drivers/'.$driver->driver_license->license_photo)}}" width="200px"></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="pills-profile-car" role="tabpanel" aria-labelledby="pills-profile-car-tab">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered mb-0" id="categories-table">
                                <tbody>
                                  @foreach ($driver->garage_driver as $garage_driver)
                                    <tr>
                                      <td class="fw-bold">ИД</td>
                                      <td>{{$garage_driver->id}}</td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Филиал</td>
                                      <td>{{$garage_driver->branch->district->name}} &nbsp;&nbsp; {{$garage_driver->branch->name}}</td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Название автомобиля </td>
                                      <td>{{$garage_driver->garage->car->name}} | {{$garage_driver->garage->car_number}}</td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Дата создания </td>
                                      <td>{{$garage_driver->created_at}}</td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Дата завершения</td>
                                      <td><?=($garage_driver->deleted_at) ? $garage_driver->deleted_at:"\u{221E}";?></td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Актив</td>
                                      <td><?=($garage_driver->is_active) ? "\u{2714}":"\u{274C}";?></td>
                                    </tr>
                                    {{-- <tr>
                                      <td class="fw-bold">Производственный год </td>
                                      <td>{{$garage_driver->garage->manufacturing_year}}</td>
                                    </tr>
                                    <tr>
                                      <td class="fw-bold">Текущий пробег</td>
                                      <td>{{$garage_driver->garage->manufacturing_year}}</td>
                                    </tr> --}}
                                  @endforeach
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

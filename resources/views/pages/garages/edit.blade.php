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
                          <h4 class="fw-bold mb-3">№{{$garage->id}}</h4>
                        </div>
                        <div class="col-8 ">
                          <button class="btn btn-success float-end mx-2" data-bs-toggle="modal" data-bs-target="#modalGrid2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Автомобил косыу</button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('garages.update',$garage->id)}}">
                              @method("PATCH")
                              @csrf
                              
                              <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Основное</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Дополнительно</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                  <div class="row">
                                      <div class="col-6 mb-3">
                                        <label class="form-label">Выберите автомобиль:</label>
                                        <select name="car_id" id="" class="form-control">
                                          <option value="" hidden>Выберите автомобиль</option>
                                          @foreach($cars as $car)
                                          <option <?=($car->id == $garage->car_id) ? 'selected' : '';?> value="{{$car->id}}">{{$car->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-6 mb-3">
                                        <label for="" class="form-label">Номер автомобиля:</label>
                                        <input type="text" name="car_number" value="{{$garage->car_number}}" oninput="ToUpper(this)" maxlength="8" placeholder="95A123AA" class="form-control">
                                      </div>
                                      <div class="col-3 mb-3">
                                        <label for="" class="form-label">Год выпуска:</label>
                                        <input type="number" value="{{$garage->manufacturing_year}}"  name="manufacturing_year" class="form-control" id="">
                                      </div>
                                      <div class="col-3 mb-3">  
                                        <label for="" class="form-label">Текущий пробег:</label>
                                        <input type="number" disabled value="{{$garage->current_mileage}}" name="current_mileage" class="form-control" id="">
                                      </div>
                                      <hr>
                                      <div class="row">
                                        <div class="col-4 mb-3">  
                                          <label for="" class="form-label">Двигатель Номер:</label>
                                          <input type="text" value="{{$garage->engine_number}}"  oninput="ToUpper(this)" name="engine_number" class="form-control" id="">
                                        </div>
                                        <div class="col-4 mb-3">  
                                          <label for="" class="form-label">Кузов Номер:</label>
                                          <input type="text" value="{{$garage->body_number}}"  oninput="ToUpper(this)" name="body_number" class="form-control" id="">
                                        </div>
                                        <div class="col-4 mb-3">  
                                          <label for="" class="form-label">VIN Номер:</label>
                                          <input type="text" value="{{$garage->wine_number}}"  oninput="ToUpper(this)" name="wine_number" class="form-control" id="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                  <h4>Расход по нормам</h4>
                                  <div class="row">
                                    <div class="col-6">
                                      @foreach ($expenditure_types as $type)
                                        <div class="mb-3">
                                          <label for="" class="form-label">{{$type->name}}</label>
                                          <div class="row">
                                            <div class="col-6">
                                              <input type="number" name="att[{{$type->id}}][size]" value="<?=($garage->standard_expend->where('expenditure_type_id',$type->id)->count() > 0) ? $garage->standard_expend->where('expenditure_type_id',$type->id)->first()->size : '' ?>" > {{$type->unit->name}}
                                            </div>
                                            <div class="col-6">
                                              <input type="number" name="att[{{$type->id}}][km]" value="<?=($garage->standard_expend->where('expenditure_type_id',$type->id)->count() > 0) ? $garage->standard_expend->where('expenditure_type_id',$type->id)->first()->km : '' ?>"> Км
                                            </div>
                                            
                                          </div>
                                        </div>
                                        <hr>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </form>
                        </div>

                    </div>
                </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
  
  <div class="modal fade" id="modalGrid2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Автомобил косыу
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <form action="{{route('garages.car.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="">Автомобил аты</label>
                      <input type="text" required name="name" value="{{old('name')}}" placeholder="Автомобил атын киритин" class="form-control">
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <input type="submit" value="Сохранить" class="btn btn-succe">
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
    <style>
      /* Faqat yilni ko'rsatishga moslash */
      #yearPicker::-webkit-calendar-picker-indicator {
          display: none;
      }
    </style>
@endpush
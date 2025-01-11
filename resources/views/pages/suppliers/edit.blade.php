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
                          <h4 class="fw-bold mb-3">Редактировать</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('suppliers.index')}}" class="btn btn-primary float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('suppliers.update',$supplier->id)}}">
                              @csrf
                              @method("PATCH")
                              <div class="row">
                                <div class="mb-3">
                                  <label class="form-label">ФИО</label>
                                  <input type="text" name="full_name" class="form-control" value="{{$supplier->full_name}}" placeholder="ФИО киритин">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Телефон номер</label>
                                    <input type="text" maxlength="9" name="phone" value="{{$supplier->phone}}" class="form-control" placeholder="Телефон номер киритин">
                                </div>
                              </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>
                        </div>

                    </div>
                </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection
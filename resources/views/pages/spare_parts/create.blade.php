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
                          <h4 class="fw-bold mb-3">Создать</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('spare-part.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('spare-part.store')}}">
                              @csrf
                              <div class="row">
                                <div class="col-6 mb-3">
                                  <label class="form-label">Название</label>
                                  <input type="text" name="name" class="form-control" placeholder="Название">
                                  @error('name')
                                      <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Цена</label>
                                    <input type="text" name="price" class="form-control" placeholder="Цена">
                                    @error('price')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Описание</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Единица</label>
                                    <select name="unit_id" class="form-control" id="single">
                                      <option value="" hidden>Выберите</option>
                                      @foreach($units as $unit)
                                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('unit_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 ">
                                  <input type="checkbox" name="product_type" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Серия номер</label>
                               </div>
                              </div>
                                <button type="submit" class="btn btn-success">Отправить</button>
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
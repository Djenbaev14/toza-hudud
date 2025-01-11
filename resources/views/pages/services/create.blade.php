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
                          <h4 class="fw-bold mb-3">Создать Услуга
                          </h4>
                        </div>
                      </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('services.store')}}">
                              @csrf
                              <div class="row">
                                  <div class="col-12 mb-3">
                                    <label for="" class="form-label">Название:</label>
                                    <input type="text" name="name" value="{{old('name')}}" placeholder="Название" class="form-control ">
                                    @error('name')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-3">
                                    <label for="" class="form-label">Цена:</label>
                                    <input type="text" value="{{old('price')}}"  name="price" placeholder="Цена" class="form-control" id="">
                                    @error('price')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-3">
                                      <label class="form-label">Единица</label>
                                      <select name="unit_id" class="form-control" id="single">
                                        <option value="" hidden>Выберите</option>
                                        @foreach($units as $unit)
                                        <option value="{{$unit->id}}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{$unit->name}}</option>
                                        @endforeach
                                      </select>
                                      @error('unit_id')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                      @enderror
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
@endsection
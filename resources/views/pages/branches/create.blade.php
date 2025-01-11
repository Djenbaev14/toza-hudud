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
                          <a href="{{route('branches.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div>
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('branches.store')}}">
                              @csrf
                              <div class="row">
                                <div class="mb-3">
                                  <label class="form-label">Тип</label>
                                  <select name="district_id" id="single" class="form-control">
                                    <option hidden value="">Выберите</option>
                                    @foreach($districts as $district)
                                      <option value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                  </select>
                                  @error('district_id')
                                      <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Название филиал</label>
                                  <input type="text" name="name" class="form-control" placeholder="Название филиал">
                                  @error('name')
                                      <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
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
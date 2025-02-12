@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

    <div class="row  justify-content-between mt-2" >
      <div class="col-4">
        <h4 class="fw-bold mb-3">Создать</h4>
      </div>
      <div class="col-8 ">
        <a href="{{route('suppliers.index')}}" class="btn btn-success float-end mx-2">
          Назад
        </a>
      </div>
    </div>

        <div class="row mt-2">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('clients.store')}}">
                              @csrf
                                <div class="row">
                                  <div class="col-lg-12 col-sm-12 mb-3">
                                    <label class="form-label">Тип лица</label>
                                    <select name="type" class="form-control" id="dynamic-select" onchange="showAttributes()">
                                      <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }} selected>Физическое лицо</option>
                                      <option value="legal" {{ old('type') == 'legal' ? 'selected' : '' }}>Юридическое лицо</option>
                                    </select>
                                    @error('type')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label class="form-label">ФИО</label>
                                    <input type="text" name="full_name" value="{{old('full_name')}}" class="form-control" placeholder="ФИО киритин">
                                    @error('full_name')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label class="form-label">Телефон номер</label>
                                    <div class="input-group">
                                      <span class="input-group-text" id="inputGroup-sizing-sm">+998</span>
                                      <input type="text" maxlength="9" value="{{old('phone')}}" name="phone" class="form-control" placeholder="Телефон номер киритин">
                                    </div>  
                                    @error('phone')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label class="form-label">ПИФЛ или ИНН</label>
                                    <input type="number" name="pinfl_or_inn" value="{{old('pinfl_or_inn')}}" class="form-control">
                                    @error('pinfl_or_inn')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3" id="first" style="display: none"></div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label for="">Дата рождения</label>
                                    <input type="date" name="birth_date" value="{{old('birth_date')}}" class="form-control">
                                    @error('birth_date')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label for="">Район</label>
                                    <select name="district_id" class="form-control">
                                      <option value="" hidden>Весь район</option>
                                      @foreach ($districts as $district)
                                        <option value="{{$district->id}}" {{ old('district_id') == $district->id ? 'selected' : '' }} >{{$district->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('district_id')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label for="">Адрес</label>
                                    <textarea name="address" class="form-control" cols="30" rows="3">{{old('address')}}</textarea>
                                    @error('address')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="col-lg-6 col-sm-12 mb-3">
                                    <label for="">Описание</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3">{{old('description')}}</textarea>
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

@push('js')
    <script>
      
      function showAttributes() {
            const typeId = document.getElementById('dynamic-select').value;
            if(typeId=='legal'){
              
              firstCol=document.getElementById('first');
              firstCol.style.display="inline-block";
              firstCol.innerHTML='<label for="" class="form-label">Название компании</label><input type="text" name="company_name" value="{{old('company_name')}}" class="form-control">';
              
            }else{
              document.getElementById('first').style.display = 'none';
            }
      }
      window.onload = function() {
        showAttributes();
      }
    </script>
@endpush
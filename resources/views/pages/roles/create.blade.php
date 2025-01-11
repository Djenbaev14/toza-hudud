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
                          <h4 class="fw-bold mb-3">Таза Рол косыу</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('roles.index')}}" class="btn btn-success float-end mx-2">
                            Изге кайтыу
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('roles.store')}}">
                              @csrf
                                {{-- <div class="mb-3">
                                    <label class="form-label">Рол тип</label>
                                    <select name="user_type" class="form-control" onchange="myFunction(this)" id="single">
                                      <option value="" hidden>Выбрите</option>
                                      <option value="admin">Админ</option>
                                      <option value="worker">Работник</option>
                                      <option value="employee">Сотрудник</option>
                                    </select>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="form-label">Рол аты</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="row" id="permissionSection">
                                  <div class="mb-3">
                                    <label>
                                      <input type="checkbox" id="selectAll" class="form-check-input" style="cursor: pointer" /> Хаммесин белгилеу
                                    </label>
                                  </div>
                                  <div class="mb-3">
                                    <table class="table table-bordered">
                                      @foreach ($permissions as $key  => $permission)
                                        <tr>
                                          <td>{{$key}}</td>
                                          <td>
                                            @foreach ($permission as $per)
                                              <div class="bordered d-inline-block">
                                                <input class="form-check-input checkbox-item" name="permissions[]" style="cursor: pointer" type="checkbox" value="{{$per->name}}">
                                              <label class="form-check-label">
                                              {{$per->name}}
                                              </label>
                                              </div><br>
                                            @endforeach
                                          </td>
                                        </tr>
                                      @endforeach
                                    </table>
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
    // "Barchasini belgilash" checkboxni tanlang
    const selectAllCheckbox = document.getElementById('selectAll');
    // permissionSection
    // const permissionSection = document.getElementById('permissionSection');

    // Barcha boshqa checkboxlarni tanlang
    const checkboxes = document.querySelectorAll('.checkbox-item');

    // "Select All" checkbox bosilganda ishlaydi
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = this.checked; // "Select All"ning holati
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked; // Boshqa checkboxlar holatini o'zgartirish
        });
    });

    // Har bir checkbox belgilanganda "Select All"ni yangilash
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            // Agar biror checkbox belgilanmagan bo'lsa, "Select All"ni o'chirib qo'yish
            selectAllCheckbox.checked = Array.from(checkboxes).every(cb => cb.checked);
        });
    });

    // function myFunction(select){
    //   const typeId = select.value;
      
    //   if(typeId=='employee'){
    //     permissionSection.style.display='none';
    //   }else{
    //     console.log(11);
    //     permissionSection.style.display='block';
    //   }
      
    // }
  </script>
@endpush
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
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('roles.index')}}" class="btn btn-primary float-end mx-2">
                            Изге кайтыу
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('roles.update',$role->id)}}">
                              @csrf
                              @method('PATCH')
                                <div class="mb-3">
                                  <label for="name" class="form-label">Role Name</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}">
                                </div>
                                <div class="mb-3">
                                  <label>
                                    <input type="checkbox" id="selectAll" class="form-check-input" style="cursor: pointer" /> Хаммесин белгилеу
                                </label>
                                </div>
                                <div class="mb-3">
                                  <table class="table table-bordered">
                                    @foreach ($permissions as $group=> $permission)
                                        <tr>
                                          <td>{{$group}}</td>
                                          <td>
                                            @foreach ($permission as $key  => $per)
                                                <div class="bordered d-inline-block">
                                                  <input class="form-check-input checkbox-item" <?=(in_array($per->id,json_decode(json_encode($role->getAllPermissions()->pluck('id')), true))) ? 'checked' : '';?>  name="permissions[]" style="cursor: pointer" type="checkbox" value="{{$per->name}}">
                                                <label class="form-check-label">
                                                {{$per->name}}
                                                </label>
                                                </div><br>
                                            @endforeach
                                          </td>
                                        </tr>
                                    @endforeach
                                  </table>
                                <button type="submit" class="btn btn-primary">Редактировать</button>
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
</script>
@endpush
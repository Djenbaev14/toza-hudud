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
                        <div class="col-lg-4 col-sm-12">
                          <h4 class="fw-bold mb-3">Добавить водител</h4>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('drivers.update',$driver->id)}}" method="POST" enctype="multipart/form-data">
                            @method("PATCH")
                            @csrf
                          
                          <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Основное</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Водительские права</button>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <div class="row">
                                <div class="col-lg-6  col-sm-12 mb-3">
                                  <label for="">ФИО</label>
                                  <input type="text" name="full_name" value="{{$driver->full_name}}" placeholder="Водител атын киритин" class="form-control">
                                  @error('full_name')
                                  <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Дата рождения</label>
                                  <input type="date" name="birth_date" value="{{$driver->birth_date}}" class="form-control">
                                  @error('birth_date')
                                  <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Паспорт серия</label>
                                  <input type="text" placeholder="KA1234567" oninput="ToUpper(this)" maxlength="9" name="passport" value="{{$driver->passport}}" class="form-control">
                                  @error('passport')
                                  <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Телефон номер</label>
                                  <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+998</span>
                                    <input type="text" name="phone" value="{{$driver->phone}}" maxlength="9" placeholder="Телефон номерин киритин" class="form-control">
                                  </div>
                                  @error('phone')
                                  <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div> 
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Кем был дан</label>
                                  <input type="text" name="given_by_whom" value="{{$driver->given_by_whom}}" class="form-control">
                                  @error('given_by_whom')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Адрес</label>
                                  <textarea name="address" class="form-control" id="" cols="30" rows="3">{{$driver->address}}</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                              <div class="row">
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Номер сертификата</label>
                                  <input type="text" oninput="ToUpper(this)" maxlength="9" name="license_number" value="{{$driver->driver_license->license_number}}" class="form-control">
                                  @error('license_number')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Категории</label>
                                  <select id="multiple" name="certificate_category_id[]" style="width: 100%" class="js-states form-control" multiple>
                                    @foreach ($categories as $category)
                                        @if (in_array($category->id,$driver->driver_license->certificate_category_id))
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                  </select>
                                  {{-- {{$driver->driver_license->certificate_category_id[0]}} --}}
                                  @error('certificate_category_id')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                  {{-- license_categories --}}
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Дата выдачи</label>
                                  <input type="date" name="license_issue_date" value="{{$driver->driver_license->license_issue_date}}" placeholder="Дата выдачи" class="form-control">
                                  @error('license_issue_date')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <label for="">Срок годности</label>
                                  <input type="date" name="license_expiry_date" value="{{$driver->driver_license->license_expiry_date}}" placeholder="Дата выдачи" class="form-control">
                                  @error('license_expiry_date')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                  @enderror
                                </div> 
                              </div>
                              <div class="row">
                                <div class="col-lg-6 col-sm-12 mb-3">
                                  <span>Права файл</span>
                                  <div id="upload-container" >
                                            <label for="logo-upload" id="upload-label">
                                                  <span id="change-icon">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                  <img id="logo-preview" src="" style="object-fit:cover;display:none" alt="Yuklangan rasm"/>
                                                  <div id="upload-area">
                                                      <div id="placeholder">
                                                          <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                          <p>Права файл жуклен</p>
                                                      </div>
                                                  </div>
                                          </label>
                                          <input type="file" name="license_photo" value="{{old('photo')}}" id="logo-upload" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          <div class="d-flex align-items-center justify-content-end">
                              <input type="submit" value="Сохранить" class="btn btn-success">
                          </div>
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
@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <style>  
      
      #upload-label{
          width: 100%;
      }
      #upload-area{
          border: 2px dashed #ccc;
          border-radius: 20px;
          background-color: #FAFAFF;
          padding: 20px;
          width: 100%;
          margin: 0 auto 20px auto;
          cursor: pointer;
          position: relative;
      }
    
      #logo-preview{
          border-radius: 8px;
          width: 300px;
          height: 100px;
      }
    
      #placeholder{
          color: #333;
          text-align: center;
      }
    
    
      #change-icon{
          display: none;
          margin-bottom: 5px;
          object-fit: fill;
          cursor: pointer;
          font-size: 20px;
          color: #6c63ff;
          background-color: white;
          border-radius: 50%;
          padding: 2px 8px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }
    </style>
@endpush
@push('js')
  <script>
    document.getElementById("logo-upload").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file && file.size <= 10 * 1024 * 1024) { // 10 MB
            const reader = new FileReader();
            reader.onload = function (e) {
                const logoPreview = document.getElementById("logo-preview");
                logoPreview.src = e.target.result;
                logoPreview.style.display = "block";
                
                // Placeholderni yashirish
                document.getElementById("placeholder").style.display = "none";
                document.getElementById("change-icon").style.display = "inline-block";
                document.getElementById("upload-area").style.display = "none";
            };
            reader.readAsDataURL(file);
        } 
    });
  </script>
@endpush
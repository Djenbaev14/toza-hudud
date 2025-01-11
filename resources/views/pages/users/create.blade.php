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
                          <h4 class="fw-bold mb-3">Добавить</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('users.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="POST" action="{{route('users.store')}}">
                              @csrf
                              <div class="mb-3">
                                  <label class="form-label">Выберите филиал</label>
                                  <select name="branch_id" required value="{{old('branch_id')}}" class="form-control"  >
                                    <option value="" hidden>Выберите филиал</option>
                                    @foreach($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                  </select>
                                  @if($errors->has('role_name'))
                                      <div class="error text-danger">{{ $errors->first('role_name') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Выберите роль</label>
                                  <select name="role_name" required value="{{old('role_name')}}" class="form-control" id="single" onchange="roleType(this)">
                                    <option value="" hidden>Выберите роль</option>
                                    @foreach($roles as $role)
                                      <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                  </select>
                                  @if($errors->has('role_name'))
                                      <div class="error text-danger">{{ $errors->first('role_name') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">ФИО</label>
                                  <input type="text" name="name" value="{{old('name')}}" required class="form-control" placeholder="ФИО киритин">
                                  @if($errors->has('name'))
                                      <div class="error text-danger">{{ $errors->first('name') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Телефон номер</label>
                                  <input type="text" maxlength="9" required name="phone" value="{{old('phone')}}" class="form-control" placeholder="Телефон номер киритин">
                                  @if($errors->has('phone'))
                                      <div class="error text-danger">{{ $errors->first('phone') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3" id="loginDiv">
                                  <label class="form-label">Логин</label>
                                  <input type="text" name="login" id="loginInput" value="{{old('login')}}" class="form-control" placeholder="Логин киритин">
                                  @if($errors->has('login'))
                                      <div class="error text-danger">{{ $errors->first('login') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3" id="passwordDiv">
                                  <label class="form-label">Парол</label>
                                  <input type="password" name="password" id="passwordInput" value="{{old('password')}}"  class="form-control" placeholder="Парол киритин">
                                  @if($errors->has('password'))
                                      <div class="error text-danger">{{ $errors->first('password') }}</div>
                                  @endif
                              </div>
                              <div class="mb-3" id="confirmPasswordDiv">
                                  <label class="form-label">Паролди жане киритин</label>
                                  <input type="password" name="confirm_password" id="confirmInput" value="{{old('confirm_password')}}" class="form-control" placeholder="Паролди жане киритин">
                                  @if($errors->has('confirm_password'))
                                      <div class="error text-danger">{{ $errors->first('confirm_password') }}</div>
                                  @endif
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

@push('js')
    <script>
      
    function roleType(element){
            const typeId = element.value;
            
            // divAttributes
            const loginDiv = document.getElementById('loginDiv');
            const passwordDiv = document.getElementById('passwordDiv');
            const confirmPasswordDiv = document.getElementById('confirmPasswordDiv');

            const loginInput = document.getElementById('loginInput');
            const confirmInput = document.getElementById('confirmInput');
            const passwordInput = document.getElementById('passwordInput');

            fetch(`/roles/${typeId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
              if(data=='employee'){
                loginDiv.style.display = 'none';
                passwordDiv.style.display = 'none';
                confirmPasswordDiv.style.display = 'none';
                
                loginInput.disabled = true;
                confirmInput.disabled = true;
                passwordInput.disabled = true;
              }else{
                loginDiv.style.display = 'block';
                passwordDiv.style.display = 'block';
                confirmPasswordDiv.style.display = 'block';
                
                loginInput.disabled = false;
                confirmInput.disabled = false;
                passwordInput.disabled = false;
              }
              
            })
            .catch(error => {
                console.error('Xatolik yuz berdi:', error);
            });
      
    }
    </script>
@endpush
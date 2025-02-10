@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                        <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                            <div class="row">

                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border mb-0">

                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">                      
                                                        <h4 class="card-title mb-0">Личная информация</h4>                      
                                                    </div><!--end col-->                                                       
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Имя</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input class="form-control" type="text" value="{{auth()->user()->name}}">
                                                    </div>
                                                </div>


                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Телефон номер</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text">+998</span>
                                                            <input class="form-control" type="text" placeholder="Phone" aria-describedby="basic-addon1" value="{{auth()->user()->phone}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <label class="form-label">Логин</label>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <input type="text" class="form-control" value="{{auth()->user()->login}}" placeholder="Email" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div><!--end card-body-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card border mb-0">

                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">                      
                                                        <h4 class="card-title mb-0">Изменить пароль</h4>                      
                                                    </div><!--end col-->                                                       
                                                </div>
                                            </div>

                                            <div class="card-body mb-0">
                                              <form action="{{route('password.update',auth()->user()->id)}}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                
                                                
                                                <div class="form-group mb-3 row">
                                                  <label class="form-label">Старый пароль</label>
                                                  <div class="col-lg-12 col-xl-12">
                                                      <input class="form-control" type="password" name="old_password" placeholder="Старый пароль">
                                                  </div>
                                                  @error('old_password')
                                                      <span class="text-danger text-sm">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                              <div class="form-group mb-3 row">
                                                  <label class="form-label">Новый пароль</label>
                                                  <div class="col-lg-12 col-xl-12">
                                                      <input class="form-control" name="new_password" type="password" placeholder="Новый пароль">
                                                  </div>
                                                  @error('new_password')
                                                      <span class="text-danger text-sm">{{ $message }}</span>
                                                  @enderror
                                              </div>
                                              <div class="form-group mb-3 row">
                                                  <label class="form-label">Подтвердите пароль</label>
                                                  <div class="col-lg-12 col-xl-12">
                                                      <input class="form-control" name="confirm_password" type="password" placeholder="Подтвердите пароль">
                                                  </div>
                                                  @error('confirm_password')
                                                      <span class="text-danger text-sm">{{ $message }}</span>
                                                  @enderror
                                              </div>

                                              <div class="form-group row">
                                                  <div class="col-lg-12 col-xl-12">
                                                      <button type="submit" class="btn btn-success">Изменить пароль</button>
                                                      <button type="button" class="btn btn-danger">Отменить</button>
                                                  </div>
                                              </div>
                                              </form>
                                            </div><!--end card-body-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 
                </div>
            </div>
        </div>
    </div>
	</div> 
</div> 
@endsection

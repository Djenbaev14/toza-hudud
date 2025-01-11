@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">
        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список ролей</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/roles') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Рол аты бойынша излен"/>
                            {{-- <button type="submit" class="btn btn-primary mx-2">Излеу</button>
                            <a href="{{route('roles.index')}}" class="btn btn-success mx-2">Тазалау</a> --}}
                        </form>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('roles.create')}}" class="btn btn-success float-end mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить роль
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3 ">
                          <table class="table table-bordered" id="roles-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Рол Аты</th>
                                      <th scope="col">Рухсатлар</th>
                                      <th scope="col"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($roles as $role)
                                    <tr class="align-middle" >
                                      <td>{{$role->name}}</td>
                                      <td>
                                        @foreach ($role->permissions as $permission)
                                            <span class="bg-primary px-2 rounded text-light">{{$permission->name}}</span>
                                        @endforeach
                                      </td>
                                      <td>
                                        @if ($role->role_type!='employee')
                                          <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success" style="margin-right: 10px"><i class="mdi mdi-pencil  fs-18"></i></a>
                                        @endif
                                        <form class="d-inline-block " action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete  fs-18"></i></button>
                                        </form>
                                      </td>
                                    </tr>
                                @empty
                                <tr>
                                  <td colspan="5" class="text-center text-danger"><h3><b>Маглыумат жок</b></h3></td>
                                </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>

		</div> 
	</div> 
@endsection

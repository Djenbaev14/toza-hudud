@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3"> Пользователи</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/users') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control" id="search" name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                        </form>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('users.create')}}" class="btn btn-success float-end mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Пайдаланыушы косыу
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3 ">
                          <table class="table " id="roles-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Аты</th>
                                      <th scope="col">Телефон номер</th>
                                      <th scope="col">Рол Аты</th>
                                      <th scope="col">Филиал</th>
                                      <th scope="col"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($users as $user)
                                <tr class="align-middle" >
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->phone}}</td>
                                  <td>{{$user->getRoleNames()[0]}} </td>
                                  <td>{{$user->branch?->name}}</td>
                                  <td>
                                    <button type="button" class="btn btn-sm btn-success" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$user->id}}">
                                      <i class="mdi mdi-pencil  fs-18"></i>
                                    <form class="d-inline-block " action="{{ route('users.destroy', $user->id) }}" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button class="btn btn-sm btn-danger" style="margin-right: 10px" ><i class="mdi mdi-delete  fs-18"></i></button>
                                    </form>
                                      @if (!$user->hasRole('Сотрудник'))
                                        <form class="d-inline-block " action="{{ route('users.key',$user->id) }}" method="POST">
                                          @csrf
                                          <button class="btn btn-sm btn-primary"><i class="mdi mdi-key  fs-18"></i></button>
                                        </form>
                                      @endif
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


@push('js')
    
{{-- <script>
  function handleInput() {

      const input = document.getElementById('search');
  
      // Kursornng pozitsiyasini saqlab qolamiz
      const cursorPosition = input.selectionStart;
  
      // Input qiymatini qayta ishlaymiz
      input.value = input.value.replace(/[^a-zA-Z0-9]/g, ''); // Masalan, faqat harf va raqamlarni qoldirish
  
      // Kursornng pozitsiyasini tiklaymiz
      input.setSelectionRange(cursorPosition, cursorPosition);
  }
  </script> --}}
  <script>
    var delayTimer;
    function doSearch(text) {
      console.log(11);
      
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function() {
          document.getElementById('form').submit();
        }, 400); // Will do the ajax stuff after 1000 ms, or 1 s
    }
  </script>
@endpush
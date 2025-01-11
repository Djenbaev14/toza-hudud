@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список договоров</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/contracts') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control" oninput="this.form.submit()" name="search" value="{{ request('search') }}" placeholder="Поиск"/>
                        </form>
                        </div>
                        {{-- <div class="col-8">
                          <a href="{{route('customers.create')}}" class="btn btn-success float-end mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить клиент
                          </a>
                        </div> --}}
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table" id="roles-table">
                              <thead class="thead">
                                  <tr>
                                      <th class="expand"></th>
                                      <th scope="col">Дог номер</th>
                                      <th scope="col">ФИО</th>
                                      <th scope="col">ПИНФЛ или ИНН</th>
                                      <th scope="col">Общая сумма</th>
                                      <th scope="col">Тип лица</th>
                                      <th scope="col">Действия</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($contracts as $contract)
                                <tr class="header-level align-middle" style="cursor: pointer;border-style:none;">
                                  <td class="expand">+</td>
                                  <td>{{$contract->contract_number}}</td>
                                  <td>{{$contract->customer->full_name}}</td>
                                  <td>{{$contract->customer->pinfl_or_inn}}</td>
                                  <td>{{number_format($contract->contract_detail->sum(function($detail) {
                                    return $detail->service->price * $detail->quantity;
                                }),2,',', '.')}} сум</td>
                                  <td><?=($contract->customer->type == 'individual') ? 'Физическое лицо' : 'Юридическое лицо';?></td>
                                  <td>
                                    
                                      <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                           <i data-feather="more-vertical"  class="fs-8"></i>
                                      </a>

                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('contracts.pdf',$contract->id)}}"><i data-feather="download"></i> &nbsp; &nbsp; <span>Скачать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.show',$contract->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.edit',$contract->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.destroy',$contract->id)}}"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a></li>
                                        <li>
                                      </ul>
                                  </td>
                                </tr>
                                <tr class="sub-level">
                                  <td class="expand"></td>
                                  <td colspan="6" class="p-0">
                                    <table >
                                      <thead>
                                        <th>Услуг</th>
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>В неделю</th>
                                      </thead>
                                      <tbody>
                                        @foreach ($contract->contract_detail as  $index => $contract_detail)
                                            <tr>
                                              <td>{{$contract_detail->service->name}}</td>
                                              <td>{{number_format($contract_detail->service->price * $contract_detail->quantity)}} сум</td>
                                              <td>{{$contract_detail->quantity}} {{$contract_detail->service->unit->name}}</td>
                                              <td>{{$contract_detail->per_week}} {{$contract_detail->service->unit->name}}</td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td colspan="6" class="text-center"><h3 class="text-danger"><b>Маглыумат жок</b></h3></td>
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

@push('css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
  <style>
*, *:before, *:after {  box-sizing: border-box; -webkit-box-sizing: border-box; }
html { width: 100%; height: 100%; background: lighten(pink, 5%);}
    
    
table {
  width:100%;
  text-align:center;
  line-height:150%;
  th, .expand {
    color: #000;
    padding:10px;
    background-color:@table-bg;
  }
  
  .expand {
    cursor:pointer;
    width:20px!important;
  }
  .sub-level {
    display:none;
  }
}
  </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script>
      $(function(){
        $('.header-level').click(function(){
          $(this).next('.sub-level').toggle();
          
        });
      });
    </script>
@endpush
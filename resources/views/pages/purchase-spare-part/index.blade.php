@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Покупки</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/purchase-spare-part') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control" oninput="this.form.submit()" name="search" value="{{ request('search') }}" placeholder="Поиск"/>
                        </form>
                        </div>
                        <div class="col-8">
                          <a href="{{route('purchase-spare-part.create')}}" class="btn btn-success float-end mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Создать
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3 ">
                          <table class="table " id="roles-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Поставщик</th>
                                      <th scope="col">Пользователь</th>
                                      <th scope="col">Описание</th>
                                      <th scope="col">Сумма</th>
                                      <th scope="col">Статус платежа</th>
                                      <th scope="col">Дата</th>
                                      <th scope="col">Действия</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($purchases as $purchase)
                                <tr class="align-middle">
                                  <td>{{$purchase->supplier->full_name}}</td>
                                  <td>{{$purchase->user->name}}</td>
                                  <td>{{$purchase->description}}</td>
                                  <td>{{number_format(totalSumPurchaseSparePart($purchase->purchase__spare_product))}} сум</td>
                                  <td></td>
                                  <td>{{$purchase->date}}</td>
                                  <td>
                                    
                                      <a class="text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                           <i data-feather="more-vertical"  class="fs-8"></i>
                                      </a>

                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('purchase-spare-part.show',$purchase->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('purchase-spare-part.edit',$purchase->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('purchase-spare-part.destroy',$purchase->id)}}"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a></li>
                                        <li>
                                      </ul>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td colspan="7" class="text-center text-danger"><h3><b>Маглыумат жок</b></h3></td>
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

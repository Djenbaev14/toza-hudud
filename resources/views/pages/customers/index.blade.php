@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список клиенты</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/clients') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control" oninput="this.form.submit()" name="search" value="{{ request('search') }}" placeholder="Поиск"/>
                        </form>
                        </div>
                        <div class="col-8">
                          <a href="{{route('clients.create')}}" class="btn btn-success float-end mx-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить клиент
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3 ">
                          <table class="table " id="roles-table">
                              <thead>
                                  <tr>
                                      <th scope="col">ФИО</th>
                                      <th scope="col">ПИФЛ или ИНН</th>
                                      <th scope="col">Телефон номер</th>
                                      <th scope="col">День рождения</th>
                                      <th scope="col">Тип лица</th>
                                      <th scope="col">Действия</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($customers as $customer)
                                <tr class="align-middle">
                                  <td>{{$customer->full_name}}</td>
                                  <td>{{$customer->pinfl_or_inn}}</td>
                                  <td>{{$customer->phone}}</td>
                                  <td>{{$customer->birth_date}}</td>
                                  <td><?=($customer->type == 'individual') ? 'Физическое лицо' : 'Юридическое лицо';?></td>
                                  <td>
                                    
                                      <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                           <i data-feather="more-vertical"  class="fs-8"></i>
                                      </a>

                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.show',$customer->id)}}"><i data-feather="dollar-sign"></i> &nbsp; &nbsp; <span>Добавить платёж</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.show',$customer->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.edit',$customer->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.destroy',$customer->id)}}"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a></li>
                                        <li>
                                      </ul>
                                    {{-- <button type="button" class="btn btn-sm btn-success" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$customer->id}}"><i data-feather="more-pencil"></i>Редактировать</button>
                                    <form class="d-inline-block " action="{{ route('users.destroy', $customer->id) }}" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button class="btn btn-sm btn-danger" style="margin-right: 10px" ><i class="mdi mdi-delete  fs-18"></i></button>
                                    </form> --}}
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td colspan="6" class="text-center text-danger"><h3><b>Маглыумат жок</b></h3></td>
                                </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                      @if ($customers->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($customers->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $customers->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                                    @if ($page == $customers->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($customers->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $customers->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><a class="page-link">Кейинги &raquo;</a></li>
                                @endif
                            </ul>
                        </nav>
                      @endif
                  </div>
              </div>
          </div>
      </div>
		</div> 
	</div> 
@endsection

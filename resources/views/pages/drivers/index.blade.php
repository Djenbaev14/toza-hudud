@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список водителов</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/drivers') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                        </form>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="categories-table">
                              <thead>
                                  <tr>
                                      <th scope="col">@sortablelink('full_name','ФИО')</th>
                                      <th scope="col">@sortablelink('phone','Телефон номер')</th>
                                      <th scope="col">@sortablelink('created_at','Дата')</th>
                                      <th scope="col">@sortablelink('','Action')</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($drivers as $driver)
                                @endforeach
                                @forelse ($drivers as $driver)
                                    <tr class="align-middle" >
                                    <td>{{$driver->full_name}}</td>
                                    <td>{{$driver->phone}}</td>
                                    <td>{{$driver->created_at->format('Y.m.d , H:i')}}</td>
                                    <td>
                                        <a class="text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                             <i data-feather="more-vertical"  class="fs-8"></i>
                                        </a>
  
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('drivers.show',$driver->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('drivers.edit',$driver->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                            <li>
                                                <a href="#" class="dropdown-item d-flex align-items-center" onclick="deleteItem({{$driver->id}})"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a>
                                            </li>
                                        </ul>
                                    </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger"><h3 class="fw-bold">Нет данных</h3></td>
                                    </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                      @if ($drivers->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($drivers->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $drivers->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($drivers->getUrlRange(1, $drivers->lastPage()) as $page => $url)
                                    @if ($page == $drivers->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($drivers->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $drivers->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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

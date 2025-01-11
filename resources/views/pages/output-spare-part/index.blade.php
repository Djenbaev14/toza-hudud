@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Расход </h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/output-spare-part') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Пойск"/>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                        </form>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('output-spare-part.create')}}" class="btn btn-success float-end mx-2" >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить расход
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th scope="col">Пользовател</th>
                                      <th scope="col">Сотрудник</th>
                                      <th scope="col">Филиал</th>
                                      <th scope="col">Дата
                                      </th>
                                      <th scope="col"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                {{-- @forelse ($OutputSparePart as $outputStationery)
                                <tr class="align-middle" style="cursor: pointer" >
                                  <td>{{$outputStationery->user->name}}</td>
                                  <td>{{$outputStationery->employee->name}}</td>
                                  <td>{{$outputStationery->branch->name}}</td>
                                  <td>{{$outputStationery->created_at->format('Y.m.d , H:i')}}</td>
                                  <td>
                                    <a class="text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                         <i data-feather="more-vertical"  class="fs-8"></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <li><a class="dropdown-item d-flex align-items-center" href="{{route('output-stationery.show',$outputStationery->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                      <li><a class="dropdown-item d-flex align-items-center" href="{{route('output-stationery.edit',$outputStationery->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                      <li><a class="dropdown-item d-flex align-items-center" href="{{route('output-stationery.destroy',$outputStationery->id)}}"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a></li>
                                      <li>
                                    </ul>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td colspan="5" class="text-center text-danger"><h3><b>Маглыумат жок</b></h3></td>
                                </tr>
                                @endforelse --}}
                              </tbody>
                          </table>
                      </div>
                      @if ($OutputSparePart->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($OutputSparePart->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $OutputSparePart->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif

                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($OutputSparePart->getUrlRange(1, $OutputSparePart->lastPage()) as $page => $url)
                                      @if ($page == $OutputSparePart->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach

                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($OutputSparePart->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $OutputSparePart->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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
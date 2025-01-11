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
                          <form action="{{ url('/output-stationery') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Пойск"/>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                        </form>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('output-stationery.create')}}" class="btn btn-success float-end mx-2" >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить расход
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table" id="outputStationery-table">
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
                                @forelse ($outputStationeries as $outputStationery)
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
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                      @if ($outputStationeries->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($outputStationeries->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $outputStationeries->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif

                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($outputStationeries->getUrlRange(1, $outputStationeries->lastPage()) as $page => $url)
                                      @if ($page == $outputStationeries->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach

                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($outputStationeries->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $outputStationeries->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
                                      </li>
                                  @else
                                      <li class="page-item disabled"><a class="page-link">Кейинги &raquo;</a></li>
                                  @endif
                              </ul>
                          </nav>
                      @endif
                      {{-- <nav>
                          <ul class="pagination mb-0">
                              <li class="page-item disabled">
                                  <a class="page-link">Previous</a>
                              </li>
                              @for ($i = $outputStationery->from; $i < $outputStationery->from; $i++)
                                <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{$i}}</a></li>
                              @endfor
                              <li class="page-item">
                                  <a class="page-link" href="#">Next</a>
                              </li>
                          </ul>
                      </nav> --}}
                  </div>
              </div>
          </div>
      </div>

      {{-- <div class="modal fade" id="modalGrid1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="myLargeModalLabel">Расход косыу
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('outputStationery.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label for="">Автомобиллер</label>
                            <select name="garage_id" class="form-select">
                              <option hidden value="none">Автомобилди сайлан</option>
                              @foreach ($garages as $garage)
                                  <option value="{{$garage->id}}">{{$garage->car->name}} | {{$garage->car_number}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="">Расходлар</label>
                            <select name="expenditure_type_id" onchange="showAttributes(this)" id="expenditure_type" class="form-select">
                              <option disabled selected value="">Расходты сайлан</option>
                            </select>
                          </div>
                          <div class="mb-3" id="divAttributes" style="display: none">
                          </div>
                          <div class="mb-3">
                            <label for="">Сумма</label>
                            <input type="number" name="price" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label for="">Комментария</label>
                            <textarea name="comment" class="form-control" placeholder="Комментария киритин" cols="30" rows="3"></textarea>
                          </div>
                          <div class="d-flex align-items-center justify-content-end">
                              <input type="submit" value="Добавить" class="btn btn-success">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div> --}}
      <div class="modal fade" id="modalGrid2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="myLargeModalLabel">Добавить тип
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('expenditure-types.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label for="">Название</label>
                            <input type="text" required name="name" value="{{old('name')}}" placeholder="Расход атын киритин" class="form-control">
                          </div>
                          <div class="d-flex align-items-center justify-content-end">
                              <input type="submit" value="Добавить" class="btn btn-success">
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
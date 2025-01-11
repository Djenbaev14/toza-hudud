@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Товары</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/spare-part') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control" onkeyup="doSearch(this.value)" name="search" value="{{ request('search') }}" placeholder="Поиск"/>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                        </form>
                        </div>
                        <div class="col-8">
                          <a href="{{route('spare-part.create')}}" class="btn btn-success float-end mx-2">
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
                                      <th scope="col">@sortablelink('name','Имя')</th>
                                      <th scope="col">@sortablelink('count_product','Количество')</th>
                                      <th scope="col">@sortablelink('price','Цена')</th>
                                      <th scope="col">@sortablelink('','Действия')</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($spareParts as $product)
                                <tr class="align-middle">
                                  <td>{{$product->name}}</td>
                                  <td>{{$product->count_product}} {{$product->unit->name}}</td>
                                  <td>{{number_format($product->price,2)}} сум</td>
                                  <td>
                                    
                                      <a class="dropdown-toggle text-success" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                           <i data-feather="more-vertical"  class="fs-8"></i>
                                      </a>

                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.show',$product->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.edit',$product->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                        <li><a class="dropdown-item d-flex align-items-center" href="{{route('clients.destroy',$product->id)}}"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a></li>
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
                      @if ($spareParts->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($spareParts->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $spareParts->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($spareParts->getUrlRange(1, $spareParts->lastPage()) as $page => $url)
                                    @if ($page == $spareParts->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($spareParts->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $spareParts->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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

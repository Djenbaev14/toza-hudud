@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Расходлар дизими</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/expenditures') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Расход аты бойынша излен"/>
                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        </form>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('expenditures.create')}}" class="btn btn-success float-end mx-2" >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить расход
                          </a>
                          <button class="btn btn-primary float-end mx-2" data-bs-toggle="modal" data-bs-target="#modalGrid2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                                Добавить тип
                          </button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <form action="{{ url('/expenditures') }}" method="GET">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <label for="per_page">Бетдеги елементлер саны:</label>
                        <select name="per_page" class="form-select-sm" id="per_page" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                      </form>
                      <div class="table-responsive mb-3">
                          <table class="table" id="expenditures-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Расход типи</th>
                                      <th scope="col">Прайс</th>
                                      <th scope="col">Автомобил</th>
                                      <th scope="col">Жаратылган уакт
                                      </th>
                                      <th scope="col"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($expenditures as $expenditure)
                                <tr class="align-middle" style="cursor: pointer" >
                                  <td>{{$expenditure->expenditure_type->name}}</td>
                                  <td>{{number_format($expenditure->price)}} сум</td>
                                  <td>{{$expenditure->garage->car_number}} | {{$expenditure->garage->car->name}}</td>
                                  <td>{{$expenditure->created_at->format('Y.m.d , H:i')}}</td>
                                  <td>
                                    <a href="{{route('expenditures.show',$expenditure->id)}}" class="btn btn-sm btn-primary" ><i class="mdi mdi-eye  fs-18"></i></a>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$expenditure->id}}">
                                      <i class="mdi mdi-pencil  fs-18"></i></button>
                                    <form class="d-inline-block " action="{{ route('expenditures.destroy', $expenditure->id) }}" method="POST">
                                      @csrf
                                      @method("DELETE")
                                      <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete  fs-18"></i></button>
                                    </form>
                                    {{-- <div class="modal fade bs-example-modal-{{$expenditure->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Расходты озгертиу №{{$expenditure->id}}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <form action="{{route('expenditures.update',$expenditure->id)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-3">
                                                          <label for="">Автомобиллер</label>
                                                          <select name="garage_id" class="form-select">
                                                            <option hidden value="none">Автомобилди сайлан</option>
                                                            @foreach ($garages as $garage)
                                                                <option <?=($garage->id==$expenditure->garage->id) ? 'selected' : '';?> value="{{$garage->id}}">{{$garage->car->name}} | {{$garage->car_number}}</option>
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="">Расходлар</label>
                                                          <select disabled name="expenditure_type_id" class="form-select">
                                                            <option hidden value="">Расходты сайлан</option>
                                                            @foreach ($expenditure_types as $expenditure_type)
                                                                <option <?=($expenditure_type->id==$expenditure->expenditure_type->id) ? 'selected' : '';?> value="{{$expenditure_type->id}}">{{$expenditure_type->name}}</option>
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                        <div class="mb-3" >
                                                          @foreach ($expenditure->expenditure_type_attribute as $ex_att)
                                                            <div class="col-6">
                                                              <label for="">{{$ex_att->type_attribute->attribute->name}}</label>
                                                              <input type="text" class="form-control" name="type_attributes[{{$ex_att->type_attribute_id}}]" value="{{$ex_att->value}}">
                                                            </div>
                                                          @endforeach
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="">Сумма</label>
                                                          <input type="number" value="{{$expenditure->price}}" name="price" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="">Комментария</label>
                                                          <textarea name="comment" class="form-control" placeholder="Комментария киритин" cols="30" rows="3">{{$expenditure->comment}}</textarea>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <input type="submit" value="Озгертиу" class="btn btn-success">
                                                        </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
                      @if ($expenditures->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($expenditures->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $expenditures->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif

                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($expenditures->getUrlRange(1, $expenditures->lastPage()) as $page => $url)
                                      @if ($page == $expenditures->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach

                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($expenditures->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $expenditures->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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
                              @for ($i = $expenditures->from; $i < $expenditures->from; $i++)
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
                        <form action="{{route('expenditures.store')}}" method="POST" enctype="multipart/form-data">
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

@push('js')
{{-- 
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('#expenditures-table tr');

        rows.forEach(row => {
            row.addEventListener('click', function () {
                const expenditureId = this.getAttribute('data-expenditure-id');
                // Kategoriya mahsulotlari sahifasiga yo'naltirish
                window.location.href = `/expenditures/${expenditureId}`;
            });
        });
    });
  </script> --}}
    <script>
      
      // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Barcha kategoriyalarni yuklash
      fetch('/expenditure-types')
          .then(response => response.json())
          .then(datas => {
              const typeSelect = document.getElementById('expenditure_type');
              
              datas.forEach(data => {
                  const option = document.createElement('option');
                  option.value = data.id; // Kategoriya ID
                  option.textContent = data.name; // Kategoriya nomi
                  typeSelect.appendChild(option);
              });
          });

          
        function showAttributes(selectElement) {
            const typeId = selectElement.value;
            
            // divAttributes
            const divAttributes = document.getElementById('divAttributes');

            divAttributes.innerHTML = '';

            // AJAX orqali ma'lumotlar bazasidan subkategoriyalarni olish
            fetch(`/expenditure-types/${typeId}`, {
                method: 'GET',
                // headers: {
                //     'X-CSRF-TOKEN': csrfToken,
                //     'Content-Type': 'application/json',
                //     'Accept': 'application/json'
                // }
            })
            .then(response => response.json())
            .then(data => {
                
                data.forEach(type_attribute => {
                    const div = document.createElement('div');
                    div.className = 'col-6';
                    
                    const label = document.createElement('label');
                    label.textContent = type_attribute.attribute.name;


                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'type_attributes['+type_attribute.id+']';
                    input.placeholder=type_attribute.attribute.name+' киритин';
                    input.className='form-control';

                    // Elementlarni domga qo'shish
                    div.appendChild(label);
                    div.appendChild(input);
                    divAttributes.appendChild(div);

                    divAttributes.style.display='block';
                });
            })
            .catch(error => {
                console.error('Xatolik yuz berdi:', error);
            });
        }
      </script>
@endpush  

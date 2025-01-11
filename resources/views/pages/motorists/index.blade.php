@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список автомобилей</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-4">
                          <form action="{{ url('/motorists') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                            <input type="hidden" name="page" value="1">
                          </form>
                        </div>
                        @can('Добавить водители автомобилей')
                            <div class="col-8 ">
                                <a href="{{route('motorists.create')}}" class="btn btn-success float-end mx-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                                Добавить водители автомобилей</a>
                            </div>
                        @endcan
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body ">
                      <div class="table-responsive mb-3 mt-3">
                          <table class="table mb-0 " id="categories-table">
                              <thead>
                                  <tr>
                                    {{-- '⬆' --}}
                                      <th scope="col"> @sortablelink('motorist.car','Марка автомобиля')</th>
                                      <th scope="col"> @sortablelink('motorist.car_number','Номер автомобиля')</th>
                                      <th scope="col">@sortablelink('branch.name','Филиал')</th>
                                      <th scope="col">@sortablelink('driver.full_name','Водитель')</th>
                                      <th scope="col">@sortablelink('created_at','Дата')</th>
                                      <th scope="col">@sortablelink('','Статус')</th>
                                      <th scope="col">@sortablelink('','Action')</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($motorists as $motorist)
                                    <tr class="align-middle" >
                                      <td>{{$motorist->garage->car->name}}</td>
                                      <td>{{$motorist->garage->car_number}}</td>
                                      <td>{{$motorist->branch->name}}</td>
                                      <td>{{$motorist->driver->full_name}}</td>
                                      <td>{{$motorist->created_at->format('Y.m.d , H:i')}}</td>
                                      <td>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch" id="myCheckbox" <?=($motorist->is_active==1) ? "checked" : ''?> onchange="updateStatus(this.checked,{{$motorist->id}})">
                                        </div>
                                      </td>
                                      <td>
                                        <a class="text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                             <i data-feather="more-vertical"  class="fs-8"></i>
                                        </a>
  
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('motorists.show',$motorist->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('motorists.edit',$motorist->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                            <li>
                                                <a href="#" class="dropdown-item d-flex align-items-center" onclick="deleteItem({{$motorist->id}})"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a>
                                            </li>
                                        </ul>
                                      </td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td colspan="7" class="text-center text-danger"><h4><b>Нет данных</b></h4></td>
                                    </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                      @if ($motorists->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($motorists->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $motorists->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($motorists->getUrlRange(1, $motorists->lastPage()) as $page => $url)
                                    @if ($page == $motorists->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($motorists->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $motorists->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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


@push('js')
<script>
    function deleteItem(motorist_id) {
        Swal.fire({
        title: "Вы уверены?",
        text: "Вы не сможете этого исправить!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Да, удалите его!"
        }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/motorists/${motorist_id}`, {
                method: 'DELETE', // HTTP metodi
                headers: {
                    'Content-Type': 'application/json', // So'rovning content-type'ini belgilash
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    setTimeout(() => {
                        location.reload();  
                    }, 300);  
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 400,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "success",
                    title: "Водитель автомобиля удален"
                    });
                } else {
                    throw new Error('Item not found or error occurred');
                }
            })
            .then(data => {
                console.log('Response:', data); // Muvaffaqiyatli o'chirishdan keyingi javob
            })
            .catch(error => {
                console.error('Error:', error); // Xatolikni qayta ishlash
            });
        }
        });
    }
</script>

<script>
    function updateStatus(check,motorist_id){
        let status = check ? 1 : 0;
        
         // Make an API call to update the status
        fetch(`/motorists/${motorist_id}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
                if (response.ok) {
                    setTimeout(() => {
                        location.reload();  
                    }, 400);  
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "success",
                    title: "Статус успешно обновлен"
                    });
                } else {
                    throw new Error('Item not found or error occurred');
                }
        })
        .then(data => {
        })
        .catch(error => {
            console.error('Error updating status:', error);
        });
    }
</script>
@endpush
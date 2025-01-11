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
                          <form action="{{ url('/garages') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                            <input type="hidden" name="page" value="1">
                          </form>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body ">
                      <div class="table-responsive mb-3 mt-3">
                          <table class="table mb-0 " id="categories-table">
                              <thead>
                                  <tr>
                                    {{-- '⬆' --}}
                                      <th scope="col"> @sortablelink('car.name','Марка автомобиля')</th>
                                      <th scope="col"> @sortablelink('car_number','Номер автомобиля')</th>
                                      <th scope="col">@sortablelink('branch.name','Филиал')</th>
                                      <th scope="col">@sortablelink('created_at','Дата')</th>
                                      {{-- <th scope="col">@sortablelink('','Статус')</th> --}}
                                      <th scope="col">@sortablelink('','Action')</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($garages as $garage)
                                    <tr class="align-middle" >
                                      <td>{{$garage->car->name}}</td>
                                      <td>{{$garage->car_number}}</td>
                                      <td>{{$garage->branch->name}}</td>
                                      <td>{{$garage->created_at->format('Y.m.d , H:i')}}</td>
                                      {{-- <td>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch" id="myCheckbox" <?=($garage->is_active==1) ? "checked" : ''?> onchange="updateStatus(this.checked,{{$garage->id}})">
                                        </div>
                                      </td> --}}
                                      <td>
                                        <a class="text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                             <i data-feather="more-vertical"  class="fs-8"></i>
                                        </a>
  
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('garages.show',$garage->id)}}"><i data-feather="eye"></i> &nbsp; &nbsp; <span>Показать</span></a></li>
                                            <li><a class="dropdown-item d-flex align-items-center" href="{{route('garages.edit',$garage->id)}}"><i data-feather="edit"></i> &nbsp; &nbsp; <span>Редактировать</span></a></li>
                                            <li>
                                                <a href="#" class="dropdown-item d-flex align-items-center" onclick="deleteItem({{$garage->id}})"><i data-feather="trash-2"></i> &nbsp; &nbsp; <span>Удалить</span></a>
                                            </li>
                                        </ul>
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                      @if ($garages->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($garages->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $garages->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($garages->getUrlRange(1, $garages->lastPage()) as $page => $url)
                                    @if ($page == $garages->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($garages->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $garages->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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
    function deleteItem(garage_id) {
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
            fetch(`/garages/${garage_id}`, {
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
                    title: "Автомобиль был удален из гаража"
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
    function updateStatus(check,garage_id){
        let status = check ? 1 : 0;
        
         // Make an API call to update the status
        fetch(`/garages/${garage_id}/update-status`, {
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
                    title: "Статус"
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
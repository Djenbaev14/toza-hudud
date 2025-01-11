@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Создать</h4>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <form action="{{route('expenditures.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label for="">Пользователю</label>
                            <select name="garage_id" id="garageId" class="form-select">
                              <option hidden value="none">Пользователю</option>
                              @foreach ($drivers as $driver)
                                  <option value="{{$driver->garage->id}}">{{$driver->full_name}} | {{$driver->garage->car_number}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="">Расходлар</label>
                            <select name="expenditure_type_id"  onchange="showAttributes(this)" id="expenditure_type" class="form-select">
                              <option disabled selected value="">Расходты сайлан</option>
                              @foreach ($expenditure_types as $expenditure_type)
                                  <option value="{{$expenditure_type->id}}">{{$expenditure_type->name}}</option>
                              @endforeach
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
      </div>

		</div> 
	</div> 
@endsection

@push('js')

  {{-- <script>
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
      // fetch('/expenditure-types')
      //     .then(response => response.json())
      //     .then(datas => {
      //         const typeSelect = document.getElementById('expenditure_type');
              
      //         datas.forEach(data => {
      //             const option = document.createElement('option');
      //             option.value = data.id; // Kategoriya ID
      //             option.textContent = data.name; // Kategoriya nomi
      //             typeSelect.appendChild(option);
      //         });
      //     });

          
        function showAttributes(selectElement) {
            const typeId = selectElement.value;
            const garageId=document.getElementById('garageId').value;
            
            if (garageId != "none") {
            // divAttributes
            
            const divAttributes = document.getElementById('divAttributes');

            divAttributes.innerHTML = '';

            fetch(`/garages/${typeId}/${garageId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                
                    const row = document.createElement('div');
                    row.className = 'row';

                    const col1 = document.createElement('div');
                    col1.className = 'col-6';
                    col1.textContent = data.expenditure_type.unit.name;
                    

                    const input1 = document.createElement('input');
                    input1.type = 'number';
                    input1.name = 'size';
                    // input.placeholder=type_attribute.attribute.name+' киритин';
                    input1.className='form-control';

                    const col2 = document.createElement('div');
                    col2.className = 'col-6';
                    col2.textContent = "km";
                    
                    const input2 = document.createElement('input');
                    input2.type = 'number';
                    input2.name = 'km';
                    // input.placeholder=type_attribute.attribute.name+' киритин';
                    input2.className='form-control';

                    col1.appendChild(input1);
                    col2.appendChild(input2);
                    row.appendChild(col1);
                    row.appendChild(col2);
                    divAttributes.appendChild(row);

                    divAttributes.style.display='block';
            })
            .catch(error => {
                console.error('Xatolik yuz berdi:', error);
            });
            }
        }
      </script>
@endpush  

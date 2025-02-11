@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="row  justify-content-between p-2" >
                        <div class="col-4">
                          <h4 class="fw-bold mb-3">Добавить водители автомобилей</h4>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('motorists.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                              <label for="">Список автомобилей</label>
                              <select name="garage_id" onchange="showGarage(this)" style="width: 100%" class="garage form-control" >
                                <option value="" hidden>Список автомобилей</option>
                                @forelse ($garages as $garage)
                                    <option value="{{$garage->id}}">{{$garage->car->name}}|{{$garage->car_number}}</option>
                                  @empty
                                @endforelse
                              </select>
                              <div class="mt-3" id="divAttributesGarage" style="display: none"></div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                              <label for="">Список автомобилей</label>
                              <select name="driver_id" onchange="showGarage(this)" style="width: 100%" class="garage form-control" >
                                <option value="" hidden>Список автомобилей</option>
                                @forelse ($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->full_name}}</option>
                                  @empty
                                @endforelse
                              </select>
                              <div class="mt-3" id="divAttributesDriver" style="display: none"></div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-end">
                              <input type="submit" value="Сохранить" class="btn btn-success">
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
@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <style>  
      
      #upload-label{
          width: 100%;
      }
      #upload-area{
          border: 2px dashed #ccc;
          border-radius: 20px;
          background-color: #FAFAFF;
          padding: 20px;
          width: 100%;
          margin: 0 auto 20px auto;
          cursor: pointer;
          position: relative;
      }
    
      #logo-preview{
          border-radius: 8px;
          width: 300px;
          height: 100px;
      }
    
      #placeholder{
          color: #333;
          text-align: center;
      }
    
    
      #change-icon{
          display: none;
          margin-bottom: 5px;
          object-fit: fill;
          cursor: pointer;
          font-size: 20px;
          color: #6c63ff;
          background-color: white;
          border-radius: 50%;
          padding: 2px 8px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }
    </style>
@endpush
@push('js')
  <script>
    function ShowCar(element){
            const typeId = element.value;
            
            // divAttributesGarage
            const divListCar = document.getElementById('divListCar');
            const divAttributesGarage = document.getElementById('divAttributesGarage');
            const single = document.getElementById('single');
            single.innerHTML='';
            divAttributesGarage.innerHTML='';
            const optionHidden=document.createElement('option');
            optionHidden.value="";
            optionHidden.textContent="Список автомобилей";
            optionHidden.hidden=true;
            single.appendChild(optionHidden);

            fetch(`/branches/${typeId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
              
              divListCar.style.display='block';
                
                    
                
                data.forEach(garage => {
                    
                    const option = document.createElement('option');
                    option.textContent = garage.car.name + " | " + garage.car_number;
                    option.value =garage.id;
                    
                    single.appendChild(option);

                });
            })
            .catch(error => {
                console.error('Xatolik yuz berdi:', error);
            });
      
    }
    function showGarage(selectElement) {
            const typeId = selectElement.value;
            
            const divAttributesGarage = document.getElementById('divAttributesGarage');
            divAttributesGarage.innerHTML = '';

            fetch(`/garages/${typeId}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                
                    const table =document.createElement('table');
                    table.className='table table-bordered'; 
                    const tr1 = document.createElement('tr');
                    const tr2 = document.createElement('tr');
                    const tr3 = document.createElement('tr');
                    const tr4 = document.createElement('tr');
                    
                    const td1 = document.createElement('td');
                    td1.textContent = 'Год изготовления';
                    td1.className='fw-bold';
                    const td2 = document.createElement('td');
                    td2.textContent = data.manufacturing_year;
                    
                    
                    const td3 = document.createElement('td');
                    td3.textContent = 'Двигатель Номер';
                    td3.className='fw-bold';
                    const td4 = document.createElement('td');
                    td4.textContent = data.engine_number;
                    
                    const td5 = document.createElement('td');
                    td5.textContent = 'Кузов Номер';
                    td5.className='fw-bold';
                    const td6 = document.createElement('td');
                    td6.textContent = data.body_number;
                    
                    const td7 = document.createElement('td');
                    td7.textContent = 'VIN Номер';
                    td7.className='fw-bold';
                    const td8 = document.createElement('td');
                    td8.textContent = data.wine_number;
                    

                    tr1.appendChild(td1);
                    tr1.appendChild(td2);
                    tr2.appendChild(td3);
                    tr2.appendChild(td4);
                    tr3.appendChild(td5);
                    tr3.appendChild(td6);
                    tr4.appendChild(td7);
                    tr4.appendChild(td8);

                    table.appendChild(tr1);
                    table.appendChild(tr2);
                    table.appendChild(tr3);
                    table.appendChild(tr4);
                    divAttributesGarage.appendChild(table);

                    divAttributesGarage.style.display='block';
            })
            .catch(error => {
                console.error('Xatolik yuz berdi:', error);
            });
        }
  </script>
@endpush
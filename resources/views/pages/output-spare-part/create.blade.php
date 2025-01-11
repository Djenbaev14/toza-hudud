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
                          <h4 class="fw-bold mb-3">Создать</h4>
                        </div>
                        <div class="col-8 ">
                          <a href="{{route('output-stationery.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('output-stationery.store')}}">
                              @csrf
                              <div class="row">
                                <div class="col-4">
                                  <div class="mb-3">
                                    <label class="form-label">Филиал</label>
                                    <select name="branch_id" value="{{old('branch_id')}}" onchange="ShowGarages(this)" class="form-control">
                                      <option value="" hidden>Выберите филиал</option>
                                      @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="mb-3" id="divGarages" style="display: none">
                                    <label class="form-label">Автомобил</label>
                                    <select name="garage_id" value="{{old('garage_id')}}" onchange="showDriver(this)" style="width: 100%" class="form-control" id="single">
                                      <option value="" hidden>Выберите автомобил</option>
                                    </select>
                                  </div>
                                  <div class="mb-3" id="divDriver" style="display: none">
                                  </div>
                                  <div class="mb-3">
                                      <label class="form-label">Описание</label>
                                      <textarea name="description" value="{{old('description')}}" id="" cols="30" rows="3" class="form-control" ></textarea>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Дата </label>
                                    <input type="datetime-local" value="{{old('date')}}" id="current-time" class="form-control" name="date">
                                  </div>
                                </div>
                                <div class="col-8">
                                  <div id="form-container">
                                      <!-- Formning birinchi qatori -->
                                      <div class="form-row row mb-3">
                                        <div class="col-5">
                                          <label for="" class="form-label">Продукт</label>
                                          <select name="product_id[]" value="{{old('product_id[]')}}" class="form-control  product-select" required>
                                              <option value="">Выберите</option>
                                              @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}} ({{countStationery($product->id)}})</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-5">
                                          <label for="" class="form-label">Количество</label>
                                          <input type="number" class="form-control quantity-input" required name="quantity[]" value="1" min="1">
                                        </div>
                                        <div class="col-2 row align-items-center mt-4">
                                          <a type="button" class="remove-row text-danger">Удалить</a>
                                        </div>
                                        <div class="col-5 mt-3">
                                          <input type="text" style="display: none" class="form-control form-control-sm barcode-input" name="barcode[]" oninput="ToUpper(this)" maxlength="7" placeholder="Серия номер">
                                        </div>
                                        {{-- <div class="col-5 mt-3" style="position: relative;">
                                          <input type="text" id="search-box" placeholder="Qidiruv..." autocomplete="off">
                                          <ul id="search-results"></ul>
                                        </div> --}}
                                      </div>
                                  </div><hr>
                                  <a type="button" class="text-success" id="add-row">Добавить услугу</a>
                                </div>
                              </div>
                                <button type="submit" class="btn btn-success">Отправить</button>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <style>
    #search-results {
              border: 1px solid #ddd;
              max-height: 200px;
              overflow-y: auto;
              position: absolute;
              background: #fff;
              z-index: 1000;
              width: 100%;
          }
          #search-results li {
              padding: 5px 10px;
              cursor: pointer;
          }
          #search-results li:hover {
              background: #f0f0f0;
          }
  </style>
@endpush
@push('js')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
        // Select2 qo'llash
        $('#searchable-select').select2();
    });
</script>
<script>
  const options = {
      timeZone: 'Asia/Tashkent',   // Toshkent vaqt zonasi
      year: 'numeric',             // Yil
      month: '2-digit',            // Oy
      day: '2-digit',              // Kun
      hour: '2-digit',             // Soat
      minute: '2-digit',           // Daqiqa
      hour12: false                // 24-soat formatida
  };
  
  const date = new Date();
  const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
  
  const [month, day, year, hour, minute] = formattedDate.match(/\d+/g);
  const tashkentFormattedTime = `${year}-${month}-${day}T${hour}:${minute}`;
  
  document.getElementById('current-time').value = tashkentFormattedTime;
</script>
  <script>
    // Form konteynerini topish
    const formContainer = document.getElementById('form-container');
    const addRowButton = document.getElementById('add-row');

    // Qator qo‘shish funksiyasi
    addRowButton.addEventListener('click', () => {
        const newRow = document.querySelector('.form-row').cloneNode(true); // Birinchi qatordan nusxa olish
        const inputs = newRow.querySelectorAll('input');
        const selects = newRow.querySelectorAll('select');

        // Har bir inputni tozalash
        inputs.forEach(input => {
            input.value = input.name === 'quantity[]' ? 1 : ''; // Default qiymat sifatida "1" ni saqlash
        });

        // Selectni tozalash
        selects.forEach(select => {
            select.value = '';
        });

        // Form konteyneriga yangi qator qo‘shish
        formContainer.appendChild(newRow);
        updateGrandTotal();
    });

    // Qatorni o‘chirish funksiyasi
    formContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-row')) {
            const rows = formContainer.querySelectorAll('.form-row');
            if (rows.length > 1) {
                e.target.closest('.form-row').remove();
                updateGrandTotal(); 
            } else {
                alert('Oxirgi qatordan boshqa qatorlarni o‘chirishingiz mumkin!');
            }
        }
    });
  </script>
  <script>
    
    function ShowGarages(element){
              const typeId = element.value;
              
              const divGarages = document.getElementById('divGarages');
              const single = document.getElementById('single');

              fetch(`/branches/getGarages/${typeId}`, {
                  method: 'GET',
              })
              .then(response => response.json())
              .then(data => {
                
                divGarages.style.display='block';
                  
                      
                  
                  data.forEach(garage_driver => {
                      
                      const option = document.createElement('option');
                      option.textContent = garage_driver.garage.car.name +' | '+ garage_driver.garage.car_number ;
                      option.value =garage_driver.id;
                      
                      single.appendChild(option);

                  });
              })
              .catch(error => {
                  console.error('Xatolik yuz berdi:', error);
              });
        
      }

      function showDriver(element){
        
              const typeId = element.value;
              
              const divDriver = document.getElementById('divDriver');

              fetch(`/getDriver/${typeId}`, {
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
                    td1.textContent = 'Водител';
                    td1.className='fw-bold';
                    const td2 = document.createElement('td');
                    td2.textContent = data.driver.full_name;
                    
                    
                    const td3 = document.createElement('td');
                    td3.textContent = 'Двигатель Номер';
                    td3.className='fw-bold';
                    const td4 = document.createElement('td');
                    td4.textContent = data.garage.engine_number;
                    
                    const td5 = document.createElement('td');
                    td5.textContent = 'Кузов Номер';
                    td5.className='fw-bold';
                    const td6 = document.createElement('td');
                    td6.textContent = data.garage.body_number;
                    
                    const td7 = document.createElement('td');
                    td7.textContent = 'VIN Номер';
                    td7.className='fw-bold';
                    const td8 = document.createElement('td');
                    td8.textContent = data.garage.wine_number;
                    

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
                    divDriver.appendChild(table);

                    divDriver.style.display='block';
                      
                  
              })
              .catch(error => {
                  divDriver.innerHTML = '';
                  console.error('Xatolik yuz berdi:', error);
              });
        
      }
  </script>
  <script>
    
          // Mahsulot tanlanganda narxni olib kelish
            formContainer.addEventListener('change', (e) => {
                  if (e.target.classList.contains('product-select')) {
                      const row = e.target.closest('.form-row');
                      const productId = e.target.value;
                      const quantityInput = row.querySelector('.quantity-input');

                      if (productId) {
                          // AJAX orqali narxni olib kelish
                          fetch(`/output-stationery/quantity-stationery/${productId}`, {
                            method: 'GET',
                          })
                          .then(response => response.json())
                          .then(data => {
                            quantityInput.max=data;
                          })
                          .catch(error => console.error('Error:', error));
                      }
                  }
              });
  </script>
  <script>
    $(document).ready(function () {
        $('#search-box').on('keyup', function () {
            let query = $(this).val();
            
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('output-spare-part.search') }}",
                    type: "GET",
                    data: { query: query },
                    success: function (data) {
                      
                        let results = $('#search-results');
                        results.empty();

                        if (data.length > 0) {
                            data.forEach(item => {
                                results.append(`<li>${item.name}</li>`);
                            });
                        } else {
                            results.append('<li>No results found</li>');
                        }
                    }
                });
            } else {
                $('#search-results').empty();
            }
        });

        // Listga bosilganda
        $(document).on('click', '#search-results li', function () {
            $('#search-box').val($(this).text());
            $('#search-results').empty();
        });
    });
</script>

@endpush
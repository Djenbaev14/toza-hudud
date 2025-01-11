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
                                    <select name="branch_id" value="{{old('branch_id')}}" onchange="ShowEmployee(this)" class="form-control">
                                      <option value="" hidden>Выберите филиал</option>
                                      @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="mb-3" id="divEmployee" style="display: none">
                                    <label class="form-label">Сотрудник</label>
                                    <select name="employee_id" value="{{old('employee_id')}}" style="width: 100%" class="form-control" id="single">
                                      <option value="" hidden>Выберите сотрудник</option>
                                    </select>
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
@endpush
@push('js')
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
    
    function ShowEmployee(element){
              const typeId = element.value;
              
              // divAttributes
              const divEmployee = document.getElementById('divEmployee');
              const single = document.getElementById('single');
              // single.innerHTML='';
              // const optionHidden=document.createElement('option');
              // optionHidden.textContent="Список сотрудников";
              // optionHidden.hidden=true;
              // single.appendChild(optionHidden);

              fetch(`/branches/getEmployee/${typeId}`, {
                  method: 'GET',
              })
              .then(response => response.json())
              .then(data => {
                divEmployee.style.display='block';
                  
                      
                  
                  data.forEach(employee => {
                      
                      const option = document.createElement('option');
                      option.textContent = employee.name;
                      option.value =employee.id;
                      
                      single.appendChild(option);

                  });
              })
              .catch(error => {
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

@endpush
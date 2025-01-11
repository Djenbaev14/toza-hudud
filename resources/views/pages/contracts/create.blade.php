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
                          <a href="{{route('contracts.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div>
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('contracts.store')}}">
                              @csrf
                              <div class="row">
                                <div class="col-4">
                                  <div class="mb-3">
                                    <label class="form-label">Филиал</label>
                                    <select name="branch_id" id="single" class="form-control">
                                      <option hidden value="">Выберите</option>
                                      @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('branch_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <div class="" style="position: relative;">
                                      <label class="form-label">Клиент</label>
                                        <input type="text" class="form-control" id="search-box" name="pinfl_or_inn" placeholder="ПИНФЛ или ИНН..." autocomplete="off">
                                        <ul id="search-results" class="list-group"></ul>
                                    </div>
                                    @error('pinfl_or_inn')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                    <div id="client-details" class="mt-3">
                                    </div>
                                  </div>
                                  <div class="mb-3">
                                      <label class="form-label">Договор номер</label>
                                      <input type="text" name="contract_number" placeholder="Договор номер" class="form-control" value="{{old('contract_number')}}" id="">
                                      @error('contract_number')
                                          <span class="text-danger text-sm">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Адрес</label>
                                    <textarea name="address" placeholder="Адрес" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                  <div class="mb-3">
                                    <label class="form-label">Срок выполнения </label>
                                    <input type="date" value="{{old('date')}}" id="current-time" class="form-control" name="duration_date">
                                    @error('duration_date')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="mb-3">
                                    <div id="grand-total">Общий Итого: 0</div>
                                  </div>
                                </div>
                                <div class="col-8">
                                  <div id="form-container">
                                      <!-- Formning birinchi qatori -->
                                      <div class="form-row row mb-3">
                                        <div class="col-3">
                                          <label for="" class="form-label">Услуг</label>
                                          <select name="service_id[]" value="{{old('service_id[]')}}" class="form-control form-control-sm product-select">
                                              <option value="">Выберите</option>
                                              @foreach ($services as $service)
                                                <option value="{{$service->id}}">{{$service->name}}</option>
                                              @endforeach
                                          </select>
                                          @error('service_id[]')
                                              <span class="text-danger text-sm">{{ $message }}</span>
                                          @enderror
                                        </div>
                                        <div class="col-3">
                                          <label for="" class="form-label">Цена</label>
                                          <input type="text" readonly class="form-control form-control-sm price-input" required name="price[]" placeholder="Цена">
                                          @error('price[]')
                                              <span class="text-danger text-sm">{{ $message }}</span>
                                          @enderror
                                        </div>
                                        <div class="col-3">
                                          <label for="" class="form-label">Количество &nbsp;</label><span class="unit-span"></span>
                                          <input type="text" class="form-control form-control-sm quantity-input" required name="quantity[]" value="1" >
                                        </div>
                                        {{-- <div class="col-3">
                                          <label for="" class="form-label">Итого</label>
                                          <input type="number" class="form-control form-control-sm total-input" name="summa[]" placeholder="Итого" readonly>
                                        </div> --}}
                                        <div class="col-3">
                                          <label for="" class="form-label">В неделю </label>
                                          <input type="number" class="form-control form-control-sm" name="per_week[]" placeholder="В неделю">
                                        </div>
                                        <div class="col-3 mt-3">
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
<style>
  #search-results {
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
<script>
  // Hozirgi sanani olish
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, '0'); // Oy 0 dan boshlanadi, shuning uchun +1
  const day = String(today.getDate()).padStart(2, '0');

  // 'YYYY-MM-DD' formatida birlashtirish
  const currentDate = `${year}-${month}-${day}`;

  // Input maydoniga qiymatni yozish
  document.getElementById('current-time').value = currentDate;
</script>

<script>
  // Form konteynerini topish
  const formContainer = document.getElementById('form-container');
  const addRowButton = document.getElementById('add-row');
  const grandTotalElement = document.getElementById('grand-total');

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
  function updateGrandTotal() {
            let grandTotal = 0;
            const priceInput = document.querySelectorAll('.price-input');
            const quantityInput = document.querySelectorAll('.quantity-input');
            
            priceInput.forEach((input,index) => {
            totalPrice=input.value * quantityInput[index].value;
            console.log(totalPrice);
            
            grandTotal += parseFloat(totalPrice) || 0; // Agar qiymat bo'lmasa, 0 olish
            });
            const formattedTotal = new Intl.NumberFormat('ru-RU', {
              // style: 'currency',
              // currency: 'Sum', // Valyutani kerakli formatga mos ravishda o'zgartirish mumkin
              minimumFractionDigits: 2
            }).format(grandTotal);
              grandTotalElement.textContent = `Общий Итого: ${formattedTotal} sum`;
  }
   // Mahsulot tanlanganda narxni olib kelish
   formContainer.addEventListener('change', (e) => {
                if (e.target.classList.contains('product-select')) {
                    const row = e.target.closest('.form-row');
                    const productId = e.target.value;
                    const priceInput = row.querySelector('.price-input');
                    const quantityInput = row.querySelector('.quantity-input');
                    const unitSpan = row.querySelector('.unit-span');

                    if (productId) {
                        // AJAX orqali narxni olib kelish
                        fetch(`/contracts/get-service-price/${productId}`, {
                          method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.price) {
                              
                                priceInput.value = data.price; // Narxni o‘rnatish
                                // totalInput.value = data.price * quantityInput.value; // Umumiy qiymatni hisoblash
                                unitSpan.textContent="("+data.unit+")";
                                updateGrandTotal(); // Yig‘indini yangilash
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        priceInput.value = '';
                        updateGrandTotal(); // Yig‘indini yangilash
                    }
                }
            });
            // Miqdor o'zgarganda totalni hisoblash
            formContainer.addEventListener('input', (e) => {
                if (e.target.classList.contains('quantity-input')) {
                    const row = e.target.closest('.form-row');
                    const priceInput = row.querySelector('.price-input');
                    const quantityInput = e.target;

                    updateGrandTotal();
                }
            });
            formContainer.addEventListener('input', (e) => {
                if (e.target.classList.contains('price-input')) {
                    const row = e.target.closest('.form-row');
                    const quantityInput = row.querySelector('.quantity-input');
                    const priceInput = e.target;

                    updateGrandTotal();
                }
            });
</script>

<script>
  $(document).ready(function () {
      $('#search-box').on('keyup', function () {
        
          let query = $(this).val();
          
          if (query.length > 0) {
              $.ajax({
                  url: "{{ route('contracts.search') }}",
                  type: "GET",
                  data: { query: query },
                  success: function (data) {
                    
                      let results = $('#search-results');
                      results.empty();

                      if (data.length > 0) {
                        
                          data.forEach(item => {
                              results.append(`<li class='list-group-item'>${item}</li>`);
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
      // $(document).on('click', '#search-results li', function () {
      //     $('#search-box').val($(this).text());
      //     $('#search-results').empty();

      // });

      $(document).on('click', '#search-results li', function () {
          let pinfl_or_inn = $(this).text();
          
          $('#search-box').val($(this).text());
          $('#search-results').empty();

          $.ajax({
              url: "{{ route('contracts.details') }}", // Ensure this route returns client details
              type: "GET",
              data: { pinfl_or_inn: pinfl_or_inn },
              success: function (data) {
                  let details = $('#client-details');
                  details.empty();
                  
                  if (data) {
                    // Create a new table
                    let table = $('<table>').addClass('table table-bordered');
                    let tbody = $('<tbody>');

                    // Populate the table with client details
                    tbody.append(`<tr><td class='fw-bold'>ФИО</td><td>${data.full_name}</td></tr>`);
                    tbody.append(`<tr><td class='fw-bold'>Адрес</td><td>${data.address}</td></tr>`);
                    tbody.append(`<tr><td class='fw-bold'>Телефон номер</td><td>${data.phone}</td></tr>`);
                    // Add more fields as needed

                    table.append(tbody);
                    details.append(table);
                  } else {
                      details.append('<p>Подробностей об этом клиенте нет.</p>');
                  }
              }
          });
      });
});


</script>



@endpush
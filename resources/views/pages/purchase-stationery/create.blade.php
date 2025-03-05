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
                          <a href="{{route('purchase-stationery.index')}}" class="btn btn-success float-end mx-2">
                            Назад
                          </a>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{route('purchase-stationery.store')}}">
                              @csrf
                              <div class="row">
                                <div class="col-4">
                                  <div class="mb-3">
                                    <label class="form-label">Поставщик</label>
                                    <select name="supplier_id" value="{{old('supplier_id')}}" class="form-control" id="single">
                                      <option value="" hidden>Выберите</option>
                                      @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->full_name}}</option>
                                      @endforeach
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
                                  <div class="mb-3">
                                    <div id="grand-total">Общий Итого: 0</div>
                                  </div>
                                </div>
                                <div class="col-8">
                                  <div id="form-container">
                                      <!-- Formning birinchi qatori -->
                                      <div class="form-row row mb-3">
                                        <div class="col-3">
                                          <label for="" class="form-label">Продукт</label>
                                          <select name="product_id[]" value="{{old('product_id[]')}}" class="form-control form-control-sm product-select" required>
                                              <option value="">Выберите</option>
                                              @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-3">
                                          <label for="" class="form-label">Цена</label>
                                          <input type="number" class="form-control form-control-sm price-input" required name="price[]" placeholder="Цена">
                                        </div>
                                        <div class="col-3">
                                          <label for="" class="form-label">Количество</label>
                                          <input type="number" class="form-control form-control-sm quantity-input" required name="quantity[]" value="1" min="1">
                                        </div>
                                        <div class="col-3">
                                          <label for="" class="form-label">Итого</label>
                                          <input type="number" class="form-control form-control-sm total-input" name="summa[]" placeholder="Итого" readonly>
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
                const totalInputs = document.querySelectorAll('.total-input');
                totalInputs.forEach(input => {
                    grandTotal += parseFloat(input.value) || 0; // Agar qiymat bo'lmasa, 0 olish
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
                    const totalInput = row.querySelector('.total-input');
                    const quantityInput = row.querySelector('.quantity-input');

                    if (productId) {
                        // AJAX orqali narxni olib kelish
                          const APP_URL = "{{ config('app.url') }}";
                        fetch(`/stationery/get-product-price/${productId}`, {
                          method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.price) {
                                priceInput.value = data.price; // Narxni o‘rnatish
                                totalInput.value = data.price * quantityInput.value; // Umumiy qiymatni hisoblash
                                updateGrandTotal(); // Yig‘indini yangilash
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        priceInput.value = '';
                        totalInput.value = '';
                        updateGrandTotal(); // Yig‘indini yangilash
                    }
                }
            });
            // Miqdor o'zgarganda totalni hisoblash
            formContainer.addEventListener('input', (e) => {
                if (e.target.classList.contains('quantity-input')) {
                    const row = e.target.closest('.form-row');
                    const priceInput = row.querySelector('.price-input');
                    const totalInput = row.querySelector('.total-input');
                    const quantityInput = e.target;

                    totalInput.value = priceInput.value * quantityInput.value;
                    updateGrandTotal();
                }
            });
            formContainer.addEventListener('input', (e) => {
                if (e.target.classList.contains('price-input')) {
                    const row = e.target.closest('.form-row');
                    const quantityInput = row.querySelector('.quantity-input');
                    const totalInput = row.querySelector('.total-input');
                    const priceInput = e.target;

                    totalInput.value = priceInput.value * quantityInput.value;
                    updateGrandTotal();
                }
            });
</script>



@endpush
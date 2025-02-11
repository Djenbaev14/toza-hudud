@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="content">
        <div class="container-xxl">
            <div class="row mt-4">
                            <div class="col-md-12 col-xl-12">
                                <div class="row g-3">

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-14 mb-1">Клиенты</div>
                                                </div>

                                                <div class="d-flex align-items-baseline mb-2">
                                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">91.6K</div>
                                                    <div class="me-auto">
                                                        <span class="text-primary d-inline-flex align-items-center">
                                                            15%
                                                            <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="website-visitors" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-14 mb-1">Должники</div>
                                                </div>

                                                <div class="d-flex align-items-baseline mb-2">
                                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">15%</div>
                                                    <div class="me-auto">
                                                        <span class="text-danger d-inline-flex align-items-center">
                                                            10%
                                                            <i data-feather="trending-down" class="ms-1" style="height: 22px; width: 22px;"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="conversion-visitors" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-14 mb-1">Долги</div>
                                                </div>

                                                <div class="d-flex align-items-baseline mb-2">
                                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">90 Sec</div>
                                                    <div class="me-auto">
                                                        <span class="text-success d-inline-flex align-items-center">
                                                            25%
                                                            <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="session-visitors" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-14 mb-1">Заказы в процессе
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-baseline mb-2">
                                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">2,986</div>
                                                    <div class="me-auto">
                                                        <span class="text-success d-inline-flex align-items-center">
                                                            4%
                                                            <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="active-users" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end sales -->
            </div> <!-- end row -->

            {{-- <div class="card mt-4">
                <div class="row">
                    <div class="col-6">
                        <canvas id="myLineChart" 
                                width="380" height="180">
                        </canvas>
                    </div>
                </div>
            </div> --}}
        </div> 
	</div> 
@endsection

@push('js')
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // data for showing the line chart
  let labels = ['1', '2', 
                '3', '4', '5'];
  let dataset1Data = [10, 25, 13, 18, 30];
  let dataset2Data = [20, 15, 28, 22, 10];

  // Creating line chart
  let ctx = 
      document.getElementById('myLineChart').getContext('2d');
  let myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: [
              {
                  label: 'Solid Line',
                  data: dataset1Data,
                  borderColor: 'blue',
                  borderWidth: 2,
                  fill: false,
              },
              {
                  label: 'Solid Line',
                  data: dataset2Data,
                  borderColor: 'red',
                  borderWidth: 2,
                  fill: false,
              },
              {
                  label: 'Solid Line',
                  data: [15, 10, 20, 25, 12],
                  borderColor: 'green',
                  borderWidth: 2,
                  fill: true,
              }
          ]
      },
      options: {
          responsive: true,
          scales: {
              x: {
                  title: {
                      display: true,
                      text: 'Дни',
                      font: {
                          padding: 4,
                          size: 20,
                          weight: 'bold',
                          family: 'Arial'
                      },
                      color: 'darkblue'
                  }
              },
              y: {
                  title: {
                      display: true,
                      text: 'Расход топлива',
                      font: {
                          size: 20,
                          weight: 'bold',
                          family: 'Arial'
                      },
                      color: 'darkblue'
                  },
                  beginAtZero: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Values',
                  }
              }
          }
      }
  });
</script>

@endpush
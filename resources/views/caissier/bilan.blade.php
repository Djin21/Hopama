@extends('caissier.layouts.app')

@section('activeBilan')
  active
@endsection

<?php 
  use App\Models\Patient; 
  use App\Models\Examen; 
  use App\Models\Paiement; 

  // $nbrHomme = Paiement::where('')
  // $examens = Examen::orderBy

  // $test = 10
?>

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Bilan</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="row">
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Paiements
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Enregistré dans la journee</h5>
                  <!-- <div class="d-flex justify-content-between pe-5">
                    <p class="card-text bx bx-group"></p>
                    <p class="card-text">30</p>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Patients
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Enregistré au cours du mois</h5>
                  <!-- <div class="text-start pe-5 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Consultations
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-file" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 90</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Nombre de consultations</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 px-3">
              <div class="card p-3" style="height: 400px">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="card-title m-0 me-2">Patients</h4>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="transactionID"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                      <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart" style="width: 100%; height: 100%"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 px-3">
              <div class="card p-3" style="height: 400px">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h4 class="card-title m-0 me-2">Examens</h4>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="transactionID"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                      <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                      <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart2" style="width: 100%; height: 100%"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mx-auto mt-4">
              <div class="card">
                <div class="card-header">
                  <h4>Test chart</h4>
                </div>
                <div class="card-body">
                  <div id="testchart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- / Main content -->

  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('assets/chart-js/dist/chart.js') }}"></script>
  <script src="{{ asset('assets/js/bilan.js') }}"></script>
  <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          // scales: {
          //     y: {
          //         beginAtZero: true
          //     }
          // },
          plugins: {
            legend: {
                display: true,
                position: 'bottom',
                align: 'start',
                fullsize: true
            }
        }
        }
    });

    const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          animations: {
            tension: {
              duration: 1000,
              easing: 'linear',
              from: 1,
              to: 0,
              loop: true
            }
          },
          // scales: {
          //   y: { // defining min and max so hiding the dataset does not change scale range
          //     min: 0,
          //     max: 50
          //   }
          // }
          scales: {
              y: {
                  beginAtZero: true
              }
          }
        }
    });
    </script>
  @endsection
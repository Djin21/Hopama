@extends('medecin.layouts.app')

@section('content')

@section('statistiques')
  active
@endsection

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Tableau de bord</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="row">
          <!-- Total Revenue -->
          <div class="col-12 col-md-4 order-3 order-md-2">
            <div class="row">
              <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Statistique Accouchement</h5>
                    <small class="text-muted">Mois</small>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="orederStatistics"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                      <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalshowIntervalle">Intervalle</a>
                      <a class="dropdown-item" href="">Refresh</a>
                      <a class="dropdown-item" href="javascript:void(0);">Share</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2">{{ $nbrAccouchements->count() }}</h2>
                      <span>Total accouchements</span>
                    </div>
                    <div id="orderStatisticsChart"></div>
                  </div>
                  <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"
                          ><i class="bx bx-mobile-alt"></i
                        ></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Accouchement</h6>
                          <small class="text-muted">Global</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">{{ $nbrAccouchements->count() }}</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Naissances</h6>
                          <small class="text-muted">Global</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">{{ $nbrNaissances }}</small>
                        </div>
                      </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">Deces</h6>
                          <small class="text-muted">Global</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">{{ $nbrDeces }}</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4 h-100">
            <div class="card h-100">
              <div class="row row-bordered g-0 h-100">
                <div class="col-md-12">
                  <h5 class="card-header m-0 me-2 pb-3">Nombre d'accouchements</h5>
                  <div id="accouchementChat" class="px-2"></div>
                </div>
                {{-- <div class="col-md-4">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="dropdown">
                        <button
                          class="btn btn-sm btn-outline-primary dropdown-toggle"
                          type="button"
                          id="growthReportId"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          2022
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                          <a class="dropdown-item" href="javascript:void(0);">2021</a>
                          <a class="dropdown-item" href="javascript:void(0);">2020</a>
                          <a class="dropdown-item" href="javascript:void(0);">2019</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="growthChart"></div>
                  <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                  <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                    <div class="d-flex">
                      <div class="me-2">
                        <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                      </div>
                      <div class="d-flex flex-column">
                        <small>2022</small>
                        <h6 class="mb-0">$32.5k</h6>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="me-2">
                        <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                      </div>
                      <div class="d-flex flex-column">
                        <small>2021</small>
                        <h6 class="mb-0">$41.2k</h6>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
          <!--/ Total Revenue -->
        </div>
      </div>
    </div>

  </div>

  {{-- Refresh stats accouchements --}}
<form action="{{ route('medecin.statistiques')}}" method="get">
  <div class="modal fade modalExam" id="modalshowIntervalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Intervalle</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Minimum</label>
              <input
                type="date"
                class="form-control"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
                id="minAccouch"
                name="minAccouch"
              />
            </div>
          </div>
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Maximum</label>
              <input
                type="date"
                class="form-control"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
                id="maxAccouch"
                name="maxAccouch"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Annuler
          </button>
          <button href="" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    {{-- {{ route('medecin.dashboard', ['test' => 1]) }} --}}
    </div>
  </div>
</form>

<form action="{{ route('medecin.statistiques')}}" method="get">
  <div class="modal fade modalExam" id="modalshowIntervallePatient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Intervalle</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Minimum</label>
              <input
                type="number"
                class="form-control"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
                id="minPat"
                name="minPat"
              />
            </div>
          </div>
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Maximum</label>
              <input
                type="number"
                class="form-control"
                id="basic-icon-default-fullname"
                aria-describedby="basic-icon-default-fullname2"
                id="maxPat"
                name="maxPat"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Annuler
          </button>
          <button href="" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    {{-- {{ route('medecin.dashboard', ['test' => 1]) }} --}}
    </div>
  </div>
</form>
  {{-- / Refresh stats accouchements --}}

  <script>
    (function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;
    const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
    orderChartConfig = {
      chart: {
        height: 165,
        width: 130,
        type: 'donut',
      },
      labels: ['Naissances', 'Deces'],
      series: [{{ (($nbrNaissances-$nbrDeces)/($nbrNaissances+$nbrDeces))*100 }}, {{ ($nbrDeces/($nbrNaissances+$nbrDeces))*100 }}],
      colors: [config.colors.info, config.colors.success],
      stroke: {
        width: 5,
        colors: cardColor
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '0.8125rem',
                color: axisColor,
                label: 'Total',
                formatter: function (w) {
                  return '100%';
                }
              }
            }
          }
        }
      }
    };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }

  var options = {
          series: [{
          name: 'Accouchements',
          data: [ {{ $totalAccouchements[0] }}, {{ $totalAccouchements[1] }}, {{ $totalAccouchements[2] }}, {{ $totalAccouchements[3] }}, {{ $totalAccouchements[4] }}, {{ $totalAccouchements[5] }}, {{ $totalAccouchements[6] }}, {{ $totalAccouchements[7] }}, {{ $totalAccouchements[8] }}, {{ $totalAccouchements[9] }}, {{ $totalAccouchements[10] }}, {{ $totalAccouchements[11] }}]
        }, {
          name: 'Naissances',
          data: [ {{ $totalNaissances[0] }}, {{ $totalNaissances[1] }}, {{ $totalNaissances[2] }}, {{ $totalNaissances[3] }}, {{ $totalNaissances[4] }}, {{ $totalNaissances[5] }}, {{ $totalNaissances[6] }}, {{ $totalNaissances[7] }}, {{ $totalNaissances[8] }}, {{ $totalNaissances[9] }}, {{ $totalNaissances[10] }}, {{ $totalNaissances[11] }}]
        }, {
          name: 'Deces',
          data: [ {{ $totalDeces[0] }}, {{ $totalDeces[1] }}, {{ $totalDeces[2] }}, {{ $totalDeces[3] }}, {{ $totalDeces[4] }}, {{ $totalDeces[5] }}, {{ $totalDeces[6] }}, {{ $totalDeces[7] }}, {{ $totalDeces[8] }}, {{ $totalDeces[9] }}, {{ $totalDeces[10] }}, {{ $totalDeces[11] }}]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#accouchementChat"), options);
        chart.render();
})();
  </script>

@endsection

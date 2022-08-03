<?php
  use App\Models\Maladie;
?>

@extends('medecin.layouts.app')

@section('stats_diagnostique')
  active
@endsection

@section('content')

<?php

$maladies = Maladie::orderBy('created_at')->get();

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Diagnostiques</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row ps-0 py-3">
        <div class="col-12 col-lg-12 m-0 order-2 order-md-3 order-lg-2 mb-4 h-100">
          <div class="card h-auto m-0">
            <div class="row row-bordered g-0 h-auto">
              <div class="col-md-8 p-3">
                <div class="row d-flex justify-content-between">
                  <h5 class="card-header m-0 me-2 pb-3">Nombre de patients</h5>
                </div>
                <div class="row">
                  <div id="statMaladieChart" class="px-2 pt-4"></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card h-100">
                  <div class="card-header d-flex align-items-center justify-content-between pb-0 pt-3">
                    <div class="card-title mb-0">
                      <h5 class="m-0 me-2">Statistique Patients</h5>
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
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalshowMaladiePatient" style="cursor: pointer;">Maladie</a>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalshowIntervallePatient" style="cursor: pointer;">Intervalle</a>
                        {{-- <a class="dropdown-item" href="javascript:void(0);">Share</a> --}}
                      </div>
                    </div>
                  </div>
                  <div class="card-body shadow-0 border-0 pt-4 h-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="d-flex flex-column align-items-center gap-1">
                        <h2 class="mb-2">100</h2>
                        <span>Total Patients</span>
                      </div>
                      <div id="orderStatisticsPatientChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                      <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <span class="avatar-initial rounded bg-label-success"><i class="bx bi-hospital"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">Maladie</h6>
                            {{-- <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6> --}}
                            <small class="text-muted">Global</small>
                          </div>
                          <div class="user-progress">
                            <small class="fw-semibold">{{ $maladie }}</small>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <span class="avatar-initial rounded bg-label-primary"
                            ><i class="bx bi-people"></i
                          ></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">Patients</h6>
                            <small class="text-muted">Global</small>
                          </div>
                          <div class="user-progress">
                            <small class="fw-semibold">{{ $totalActuCompletPatients }}</small>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <span class="avatar-initial rounded bg-label-secondary"><i class="bx bi-people"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6>
                            {{-- <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6> --}}
                            <small class="text-muted">Global</small>
                          </div>
                          <div class="user-progress">
                            <small class="fw-semibold">{{ $totalActuPatients }}</small>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <span class="avatar-initial rounded bg-label-warning"><i class="bx bi-gender-female"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">Femmes [{{$minAge}}, {{$maxAge}}]</h6>
                            {{-- <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6> --}}
                            <small class="text-muted">Global</small>
                          </div>
                          <div class="user-progress">
                            <small class="fw-semibold">{{ $totalActuFemme }}</small>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <span class="avatar-initial rounded bg-label-danger"><i class="bx bi-gender-male"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-0">Hommes [{{$minAge}}, {{$maxAge}}]</h6>
                            {{-- <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6> --}}
                            <small class="text-muted">Global</small>
                          </div>
                          <div class="user-progress">
                            <small class="fw-semibold">{{ $totalActuHomme }}</small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-content p-0">
        <div class="card tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Liste des maladies</h5>
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                  type="text"
                  class="form-control border-0 shadow-none searchexam"
                  placeholder="Search..."
                  aria-label="Search..."
                  id="searchexam"
                  oninput="voila()"
                />
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <caption class="ms-4">
                Nombre de patient : 150
              </caption>
              <thead>
                <tr>
                  <th>Nom de la maladie</th>
                  <th class="text-end me-4">Nombre</th>
                </tr>
              </thead>
              <tbody id="tout">

              </tbody>
            </table>
          </div>
        </div>
    </div>
    </div>

</div>
<div class="space-impression" style="position: fixed; bottom:0; right:0;">
  <a href="{{ route('medecin.impressionStatMaladies') }}" class="btn btn-primary me-3 mb-3 shadow-lg" style="color: white;">Imprimer <i class="bi bi-print"></i> </a>
</div>

<form action="{{ route('medecin.statMaladie')}}" method="get">
    <input type="text" class="d-none" name="maladie" value="{{ $maladie }}">
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
      </div>
    </div>
</form>

<form action="{{ route('medecin.statMaladie')}}" method="get">
    <input type="number" class="d-none" name="minPat" value="{{ $minAge }}"/>
    <input type="number" class="d-none" name="maxPat" value="{{ $maxAge }}"/>
    <div class="modal fade modalExam" id="modalshowMaladiePatient" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        
          @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Maladie</h5>
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
                <label for="maladie" class="form-label">Maladie</label>
                <input
                  type="text"
                  class="form-control"
                  id="maladie"
                  name="maladie"
                  oninput="loadMaladies()"
                />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start d-none" id="listMaladies">
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

   <script>
		let c = $('.searchexam');
		$('.searchexam').val('');
		let state = 0;
		let state2 = 0;
    let maladies = [];

		@foreach ($maladies as $maladie)
			maladies.push("{{$maladie->nom}}");
		@endforeach

		function setMaladie(id){
			$('#maladie').val(maladies[id-1]);
		}

		function loadMaladies(){
			// maladie
			state2 = 0;
			$('#listMaladies').removeClass('d-none');
			$('#listMaladies').load("/medecin/listeMaladies/" + $('#maladie').val(), function(){});
		}

      function voila(){
        $('#tout').load("/medecin/listStatMaladie/"+ c.val(), function(){
          state = 0;
        });
      }
</script>
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script>
  (function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  setInterval(() => {
      if($('.searchexam').val() == ''){
        if(state == 0){
          $('#tout').load("/medecin/listStatMaladie/10", function(){});
          state = 1;
        }
      }
    }, 200);
  
    setInterval(() => {
      if($('#maladie').val() == ''){
        if(state2 == 0){
          $('#listMaladies').addClass('d-none');
          state2 = 1;
        }
      }
    }, 500);

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  const chartOrderStatisticsPatient = document.querySelector('#orderStatisticsPatientChart'),
    orderChartPatientConfig = {
      chart: {
        height: 165,
        width: 130,
        type: 'donut',
      },
      labels: ["Hommes", "Femmes"],
      series: [{{ ($totalActuHomme/($totalActuPatients == 0 ? 1 : $totalActuPatients))*100 }}, {{ (($totalActuFemme)/($totalActuPatients == 0 ? 1 : $totalActuPatients))*100 }}],
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
  if (typeof chartOrderStatisticsPatient !== undefined && chartOrderStatisticsPatient !== null) {
    const statisticsPatientChart = new ApexCharts(chartOrderStatisticsPatient, orderChartPatientConfig);
    statisticsPatientChart.render();
  }

  var options = {
      series: [{
      name: 'Patients',
      type: 'area',
      data: [{{$totalCompletPatients[0]}}, {{ $totalCompletPatients[1] }}, {{ $totalCompletPatients[2] }}, {{ $totalCompletPatients[3] }}, {{ $totalCompletPatients[4] }}, {{ $totalCompletPatients[5] }}, {{ $totalCompletPatients[6] }}, {{ $totalCompletPatients[7] }}, {{ $totalCompletPatients[8] }}, {{ $totalCompletPatients[9] }}, {{ $totalCompletPatients[10] }}, {{ $totalCompletPatients[11] }}]
    }, {
      name: 'Patients[{{$minAge}}, {{$maxAge}}]',
      type: 'area',
      data: [{{$totalPatients[0]}}, {{ $totalPatients[1] }}, {{ $totalPatients[2] }}, {{ $totalPatients[3] }}, {{ $totalPatients[4] }}, {{ $totalPatients[5] }}, {{ $totalPatients[6] }}, {{ $totalPatients[7] }}, {{ $totalPatients[8] }}, {{ $totalPatients[9] }}, {{ $totalPatients[10] }}, {{ $totalPatients[11] }}]
    }, {
      name: 'Hommes',
      type: 'bar',
      data: [{{$totalHomme[0]}}, {{$totalHomme[1]}}, {{$totalHomme[2]}}, {{$totalHomme[3]}}, {{ $totalHomme[4] }}, {{ $totalHomme[5] }}, {{ $totalHomme[6] }}, {{ $totalHomme[7] }}, {{ $totalHomme[8] }}, {{ $totalHomme[9] }}, {{ $totalHomme[10] }}, {{ $totalHomme[11] }}]
    }, {
      name: 'Femmes',
      type: 'bar',
      data: [{{$totalFemme[0]}}, {{ $totalFemme[1] }}, {{ $totalFemme[2] }}, {{ $totalFemme[3] }}, {{ $totalFemme[4] }}, {{ $totalFemme[5] }}, {{ $totalFemme[6] }}, {{ $totalFemme[7] }}, {{ $totalFemme[8] }}, {{ $totalFemme[9] }}, {{ $totalFemme[10] }}, {{ $totalFemme[11] }}]
    }],
      chart: {
      height: 400,
      type: 'bar',
      stacked: false,
    },
    stroke: {
      width: [1, 1, 1],
      curve: 'smooth',
      lineCap: 'round,'
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '30%',
        borderRadius: 12,
        startingShape: 'rounded',
        endingShape: 'rounded'
      }
    },
    colors: [config.colors.secondary, config.colors.info, config.colors.warning, config.colors.success],
    dataLabels: {
      enabled: false
    },
    
    fill: {
      opacity: [0.30, 0.55, 0.85, 0.85],
      gradient: {
        inverseColors: false,
        shade: 'light',
        type: "vertical",
        opacityFrom: 0.85,
        opacityTo: 0.55,
        stops: [0, 100, 100, 100]
      }
    },
    markers: {
      size: 0
    },
    xaxis: {
    categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
    labels: {
      style: {
        fontSize: '13px',
        colors: axisColor
      }
    },
    axisTicks: {
      show: false
    },
    axisBorder: {
      show: false
    }
  },
    yaxis: {
      title: {
        text: '',
      },
      min: 0
    },
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: function (y) {
          if (typeof y !== "undefined") {
            return y.toFixed(0) + " ";
          }
          return y;
    
        }
      }
    }
  };

    var chart = new ApexCharts(document.querySelector("#statMaladieChart"), options);
    chart.render();
  })();
</script>

@endsection
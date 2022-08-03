@extends('medecin.layouts.app')

@section('content')

@section('dashboard')
  active
@endsection


    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Tableau de bord</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="row">
          <div class="col-lg-8 mb-4 ps-0 order-0">
            <div class="card h-100">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Bonjour a vous {{ $personnel->nom }}</h5>
                    <p class="mb-4">
                      Bienvenue sur votre espace de travail
                      Aujourd'hui vous avez <span class="fw-bold">{{ count($rdvsToday) }}</span> rendez-vous de prevu
                    </p>

                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">Nouveau</a>
                  </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left p-0 m-0">
                  <div class="card-body py-0 px-0 ">
                    {{-- <img
                      src="../assets/img/illustrations/man-with-laptop-light.png"
                      height="140"
                      alt="View Badge User"
                      data-app-dark-img="illustrations/man-with-laptop-dark.png"
                      data-app-light-img="illustrations/man-with-laptop-light.png"
                    /> --}}
                    <img
                      src="{{ asset('assets/img/illustrations/doc1.jpg') }}"
                      height="180"
                      alt="View Badge User"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 order-1 m-0">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-6 mb-4 p-0">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/chart-success.png"
                          alt="chart success"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="{{ route('medecin.consultation.liste') }}" style="cursor: pointer;">Voir plus</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Consultations</span>
                    <h3 class="card-title mb-2">{{ $consultsMois->count() }}</h3>
                    <small class="text-success fw-semibold"><i class="bx bxs-badge-check"></i> Effectuées</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-4 p-0 ps-3">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/wallet-info.png"
                          alt="Credit Card"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt6"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="{{ route('medecin.rdv') }}" style="cursor: pointer;">Voir plus</a>
                        </div>
                      </div>
                    </div>
                    <span>Rendez-vous</span>
                    <h3 class="card-title mb-1">{{ count($rdvsToday) }}</h3>
                    <small class="text-warning fw-semibold">En attentes <i class="bi bi-three-dots m-0 p-0 mt-auto"></i></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ps-0">
          <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4 h-100">
            <div class="card h-100">
              <div class="row row-bordered g-0 h-100">
                <div class="col-md-12">
                  <h5 class="card-header m-0 me-2 pb-3">Nombre de consultations/sexe</h5>
                  <div id="statsRegroupes" class="px-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row ps-0 py-3">
          <div class="col-12 col-lg-12 m-0 order-2 order-md-3 order-lg-2 mb-4 h-100">
            <div class="card h-auto m-0">
              <div class="row row-bordered g-0 h-auto">
                <div class="col-md-8 p-3">
                  <div class="row d-flex justify-content-between">
                    <h5 class="card-header m-0 me-2 pb-3">Nombre de patients</h5>
                  </div>
                  <div class="row">
                    <div id="totalPatientAgeChart" class="px-2 pt-4"></div>
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
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalshowIntervallePatient">Intervalle</a>
                          <a class="dropdown-item" href="">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body shadow-0 border-0 pt-4 h-auto">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">{{ $totalPatientsAgeMois }}</h2>
                          <span>Total Patients</span>
                        </div>
                        <div id="orderStatisticsPatientChart"></div>
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
                              <h6 class="mb-0">Patients</h6>
                              <small class="text-muted">Global</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">{{ $totalConsultMois }}</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Patients [{{$minAge}}, {{$maxAge}}]</h6>
                              <small class="text-muted">Global</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">{{ $nbrPatientsAgeMois }}</small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  {{-- <div class="d-flex align-items-center justify-content-between pb-0">
                    <div class="mb-0">
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
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalshowIntervalle">Intervalle</a>
                        <a class="dropdown-item" href="">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                      </div>
                    </div>
                  </div> --}}
                  <div class="d-flex flex-column justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                      <h2 class="mb-2">{{ $totalPatientsAgeMois }}</h2>
                      <span>Total patients</span>
                    </div>
                    <div id="orderStatisticsPatientChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="row">
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
          <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4 h-100">
            <div class="card h-100">
              <div class="row row-bordered g-0 h-100">
                <div class="col-md-12">
                  <h5 class="card-header m-0 me-2 pb-3">Nombre de consultations</h5>
                  <div id="totalRevenueChart" class="px-2"></div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Total Revenue -->
        </div> --}}
      </div>
    </div>

  </div>

  {{-- Refresh stats accouchements --}}
<form action="{{ route('medecin.dashboard')}}" method="get">
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
  {{-- / Refresh stats accouchements --}}

<form action="{{ route('medecin.dashboard')}}" method="get">
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

<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
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
      series: [{{ $nbrNaissances }}, {{ $nbrDeces }}],
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

  const chartOrderStatisticsPatient = document.querySelector('#orderStatisticsPatientChart'),
    orderChartPatientConfig = {
      chart: {
        height: 165,
        width: 130,
        type: 'donut',
      },
      labels: ["Patients[{{$minAge}}, {{$maxAge}}]", "Patients"],
      series: [{{ ($nbrPatientsAgeMois/($totalConsultMois == 0 ? 1 : $totalConsultMois))*100 }}, {{ (($totalConsultMois-$nbrPatientsAgeMois)/($totalConsultMois == 0 ? 1 : $totalConsultMois))*100 }}],
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

  // Total des revenues
  const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
    totalRevenueChartOptions = {
      series: [
        {
          name: 'Hommes',
          data: [{{$nbrPatientsAgeAnnee[0]}}, {{$nbrPatientsAgeAnnee[1]}}, {{$nbrPatientsAgeAnnee[2]}}, {{$nbrPatientsAgeAnnee[3]}}, {{ $nbrPatientsAgeAnnee[4] }}, {{ $nbrPatientsAgeAnnee[5] }}, {{ $nbrPatientsAgeAnnee[6] }}, {{ $nbrPatientsAgeAnnee[7] }}, {{ $nbrPatientsAgeAnnee[8] }}, {{ $nbrPatientsAgeAnnee[9] }}, {{ $nbrPatientsAgeAnnee[10] }}, {{ $nbrPatientsAgeAnnee[11] }}]
        },
        {
          name: 'Femmes',
          data: [{{$totalConsultAnnee[0]}}, {{ $totalConsultAnnee[1] }}, {{ $totalConsultAnnee[2] }}, {{ $totalConsultAnnee[3] }}, {{ $totalConsultAnnee[4] }}, {{ $totalConsultAnnee[5] }}, {{ $totalConsultAnnee[6] }}, {{ $totalConsultAnnee[7] }}, {{ $totalConsultAnnee[8] }}, {{ $totalConsultAnnee[9] }}, {{ $totalConsultAnnee[10] }}, {{ $totalConsultAnnee[11] }}]
        }
      ],
      chart: {
        height: 300,
        stacked: false,
        type: 'bar',
        toolbar: { show: false },
        animations: {
          enabled: true,
          easing: 'easeinout',
          speed: 1000,
          animateGradually: {
              enabled: true,
              delay: 250
          },
          dynamicAnimation: {
              enabled: true,
              speed: 150
          }
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      // colors: [config.colors.info, config.colors.primary],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 0,
        lineCap: 'round',
        // colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
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
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
    };
  if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();
  }
  const totalPatientAgeChartEl = document.querySelector('#totalPatientAgeChart'),
  totalPatientAgeChartOptions = {
      series: [
        {
          name: 'Ages[{{$minAge}}, {{$maxAge}}]',
          data: [{{$nbrPatientsAgeAnnee[0]}}, {{$nbrPatientsAgeAnnee[1]}}, {{$nbrPatientsAgeAnnee[2]}}, {{$nbrPatientsAgeAnnee[3]}}, {{ $nbrPatientsAgeAnnee[4] }}, {{ $nbrPatientsAgeAnnee[5] }}, {{ $nbrPatientsAgeAnnee[6] }}, {{ $nbrPatientsAgeAnnee[7] }}, {{ $nbrPatientsAgeAnnee[8] }}, {{ $nbrPatientsAgeAnnee[9] }}, {{ $nbrPatientsAgeAnnee[10] }}, {{ $nbrPatientsAgeAnnee[11] }}]
        },
        {
          name: 'Total',
          data: [{{$totalConsultAnnee[0]}}, {{ $totalConsultAnnee[1] }}, {{ $totalConsultAnnee[2] }}, {{ $totalConsultAnnee[3] }}, {{ $totalConsultAnnee[4] }}, {{ $totalConsultAnnee[5] }}, {{ $totalConsultAnnee[6] }}, {{ $totalConsultAnnee[7] }}, {{ $totalConsultAnnee[8] }}, {{ $totalConsultAnnee[9] }}, {{ $totalConsultAnnee[10] }}, {{ $totalConsultAnnee[11] }}]
        }
      ],
      chart: {
        height: 350,
        stacked: false,
        type: 'bar',
        toolbar: { show: false },
        animations: {
          enabled: true,
          easing: 'easeinout',
          speed: 1000,
          animateGradually: {
              enabled: true,
              delay: 250
          },
          dynamicAnimation: {
              enabled: true,
              speed: 150
          }
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      // colors: [config.colors.info, config.colors.primary],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 0,
        lineCap: 'round',
        // colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
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
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
    };
  if (typeof totalPatientAgeChartEl !== undefined && totalPatientAgeChartEl !== null) {
    const totalPatientAgeChart = new ApexCharts(totalPatientAgeChartEl, totalPatientAgeChartOptions);
    totalPatientAgeChart.render();
  }

  var options = {
      series: [{
      name: 'Consultations',
      type: 'area',
      data: [{{$totalConsultAnnee[0]}}, {{ $totalConsultAnnee[1] }}, {{ $totalConsultAnnee[2] }}, {{ $totalConsultAnnee[3] }}, {{ $totalConsultAnnee[4] }}, {{ $totalConsultAnnee[5] }}, {{ $totalConsultAnnee[6] }}, {{ $totalConsultAnnee[7] }}, {{ $totalConsultAnnee[8] }}, {{ $totalConsultAnnee[9] }}, {{ $totalConsultAnnee[10] }}, {{ $totalConsultAnnee[11] }}]
    }, {
      name: 'Hommes',
      type: 'bar',
      data: [{{$consultHommes[0]}}, {{$consultHommes[1]}}, {{$consultHommes[2]}}, {{$consultHommes[3]}}, {{ $consultHommes[4] }}, {{ $consultHommes[5] }}, {{ $consultHommes[6] }}, {{ $consultHommes[7] }}, {{ $consultHommes[8] }}, {{ $consultHommes[9] }}, {{ $consultHommes[10] }}, {{ $consultHommes[11] }}]
    }, {
      name: 'Femmes',
      type: 'bar',
      data: [{{$consultFemmes[0]}}, {{ $consultFemmes[1] }}, {{ $consultFemmes[2] }}, {{ $consultFemmes[3] }}, {{ $consultFemmes[4] }}, {{ $consultFemmes[5] }}, {{ $consultFemmes[6] }}, {{ $consultFemmes[7] }}, {{ $consultFemmes[8] }}, {{ $consultFemmes[9] }}, {{ $consultFemmes[10] }}, {{ $consultFemmes[11] }}]
    }],
      chart: {
      height: 350,
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
    colors: [config.colors.info, config.colors.warning, config.colors.success],
    dataLabels: {
      enabled: false
    },
    
    fill: {
      opacity: [0.55, 0.85, 0.85],
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

    var chart = new ApexCharts(document.querySelector("#statsRegroupes"), options);
    chart.render();
})();
  </script>

@endsection

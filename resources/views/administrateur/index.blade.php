@extends('administrateur.layouts.app')

@section('dashboard')
  active
@endsection

@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Tableau de bord</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          
          <div class="row">
            <div class="col-md-6 col-xl-4">
              <div class="card bg-primary text-white mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Patients
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title text-white">Enregistré dans la journee</h5>
                  <!-- <div class="d-flex justify-content-between pe-5">
                    <p class="card-text bx bx-group"></p>
                    <p class="card-text">30</p>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card bg-secondary text-white mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Patients
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title text-white">Enregistré au cours du mois</h5>
                  <!-- <div class="text-start pe-5 d-flex justify-content-start align-items-end">
                    <i class="bx bx-group" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 120</p>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="card bg-info text-white mb-3">
                <div class="card-header d-flex justify-content-start align-items-center">Consultations
                  <div class="ms-auto pe-4 d-flex justify-content-start align-items-end">
                    <i class="bx bx-file" style="font-size: 2rem;"></i>
                    <p class="card-text" style="font-size: 1.25rem;"> 90</p>
                  </div>
                </div>
                <div class="card-body">
                  <h5 class="card-title text-white">Nombre de consultations</h5>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

@endsection

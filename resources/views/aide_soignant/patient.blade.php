@extends('aide_soignant.layouts.app')

@section('patient')
  active open
@endsection

@section('patientListe')
  active
@endsection

@section('content')

<?php

use App\Models\Paiement; 

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Patient</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
          <li class="nav-item">
            <button
              type="button"
              class="nav-link active"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-home"
              aria-controls="navs-pills-top-home"
              aria-selected="true"
            >
              Tout
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-profile"
              aria-controls="navs-pills-top-profile"
              aria-selected="false"
            >
              Suivit
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-manque"
              aria-controls="navs-pills-top-manque"
              aria-selected="false"
            >
              Hospitalisee
            </button>
          </li>
        </ul>
        <div class="tab-content p-0">
            <div class="card tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-header">Liste des patients</h5>
                <div class="navbar-nav align-items-center">
                  <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none searchexam"
                      placeholder="Search..."
                      aria-label="Search..."
                      id="searchexam1"
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
                      <th>Nom du patient</th>
                      <th>Dernier passage</th>
                      <th>Etat</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="tout">

                  </tbody>
                </table>
              </div>
            </div>
          <div class="card tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des patients</h5>
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
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
                    <th>Nom du patient</th>
                    <th>Dernier passage</th>
                    <th>Etat</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="suivit">
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="card tab-pane fade" id="navs-pills-top-manque" role="tabpanel">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des patients</h5>
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
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
                    <th>Nom du patient</th>
                    <th>Dernier passage</th>
                    <th>Etat</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="hospitalisee">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script>
      let c = $('.searchexam');
      $('.searchexam').val('');
      let state = 0;
      let globalPatient = 0;

      setInterval(() => {
        if($('.searchexam').val() == ''){
          if(state == 0){
            $('#tout').load("/aide_soignant/listAll/all", function(){});
            $('#suivit').load("/aide_soignant/listSuivit/all", function(){});
            $('#hospitalisee').load("/aide_soignant/listHospitalisee/all", function(){});
            state = 1;
          }
        }
      }, 100);

      function voila(){
        $('#tout').load("/aide_soignant/listAll/"+ c.val(), function(){
          state = 0;
        });
        $('#suivit').load("/aide_soignant/listSuivit/"+ c.val(), function(){
          state = 0;
        });
        $('#hospitalisee').load("/aide_soignant/listHospitalisee/"+ c.val(), function(){
          state = 0;
        });
      }
  </script>

@endsection
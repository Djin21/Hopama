@extends('aide_soignant.layouts.app')

@section('patient')
  active open
@endsection

@section('paramsPatient')
  active
@endsection

@section('content')

<?php

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Patient/</span> Enregistrer parametres</h4>
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
              Fil d'attente
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
              Historique
            </button>
          </li>
          {{-- <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-messages"
              aria-controls="navs-pills-top-messages"
              aria-selected="false"
            >
              Rendez-vous
            </button>
          </li> --}}
        </ul>
        <div class="tab-content p-0">
          {{-- <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel"> --}}
            <div class="card tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
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
                      <th>Date paiement</th>
                      <th>Validite</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="moi">
                    
                  </tbody>
                </table>
              </div>
            </div>
          {{-- </div> --}}
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
                    {{-- <th>Etat</th> --}}
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="toi">
                  
                </tbody>
              </table>
            </div>
          </div>
          {{-- <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
            <p>
              Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
              cupcake gummi bears cake chocolate.
            </p>
            <p class="mb-0">
              Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
              roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
              jelly-o tart brownie jelly.
            </p>
          </div> --}}
        </div>
      </div>

      <!-- Basic Layout & Basic with Icons -->
      {{-- <div class="row">
        <div class="col-xxl">
          <div class="card">
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
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="moi">
                  
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div> --}}
    </div>

  </div>

  <div
      id="toast"
      class="bs-toast toast toast-placement-ex m-2 top-0 end-0 bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-delay="2000"
    >
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Enregistrement</div>
        <small>A l'instant</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">La consultation a bien ete enregistre</div>
  </div>

  <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script>
      let val = 1;
      let x = document.getElementById('cel');
      let c = $('#searchexam');
      $('#searchexam').val('');
      let state = 0;
      let globalPatient = 0;

      function show(){
        $('#toast').fadeIn();
        $('#toast').addClass('show');
        setTimeout(() => {
            $('#toast').fadeOut();
            $('#toast').removeClass('show');
        }, 2000);
      }
      @isset($success)
          show();
      @endisset

      $('tbody.moi').load("/aide_soignant/listPatient/all", function(){});
      $('tbody.toi').load("/aide_soignant/histSession/all", function(){});
      // $('.test').html('<p>Aurevoir</p>');
      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('tbody.moi').load("/aide_soignant/listPatient/all", function(){});
            $('tbody.toi').load("/aide_soignant/histSession/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('tbody.moi').load("/aide_soignant/listPatient/"+ c.val(), function(){
          state = 0;
        });
        $('tbody.toi').load("/aide_soignant/histSession/"+ c.val(), function(){
          state = 0;
        });
      }

      
      function save(patient){
        globalPatient = patient;
        $("#patient_id").val(patient);
      }
    </script>

@endsection
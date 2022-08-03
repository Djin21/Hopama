@extends('aide_soignant.layouts.app')

@section('accouchement')
  active open
@endsection

@section('accouchement_nouveau')
  active
@endsection

@section('content')

<?php
    use App\Models\Patient;

    $patients = Patient::where('sexe', 1)->get();
?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Patient</h4>

      <!-- Basic Layout & Basic with Icons -->
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
              Nombre de patient : {{$patients->count()}}
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
            $('#tout').load("/aide_soignant/listPatientFille", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#tout').load("/aide_soignant/listPatientFille", function(){
          state = 0;
        });
      }
  </script>

@endsection
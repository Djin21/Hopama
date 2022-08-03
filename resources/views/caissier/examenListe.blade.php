<?php

use App\Models\Paiement;
use App\Models\Examen_prescrit;

$cptExam = 0;
if(Paiement::all() != Null){
  $cptExam = 0 ;
}else{
  $cptExam = Paiement::all()->count();
}

$cptExamPres = 0;
$cptExamPres = Examen_prescrit::where('etatPaiement', 0)->get()->count();

?>
@extends('caissier.layouts.app')

@section('examen')
  active
@endsection

@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Examen</h4>
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
          <li class="nav-item ms-auto">
            <a href="{{ route('caisse.paiementExamen.patient') }}"
              type="button"
              class="btn btn-primary"
              aria-selected="false"

            >
              Nouveau
          </a>
          </li>
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
                    Nombre d'examen prescrit : {{ $cptExamPres }}
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
                  Nombre d'examen payé : {{ $cptExam }}
                </caption>
                <thead>
                  <tr>
                    <th>Nom du patient</th>
                    <th>Examen</th>
                    {{-- <th>Type</th> --}}
                    <th class="text-end me-4">Date du paiement</th>
                  </tr>
                </thead>
                <tbody class="toi my-4">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

    <script>
      let val = 1;
      let x = document.getElementById('cel');
      let c = $('#searchexam');
      $('#searchexam').val('');
      let state = 0;
      let globalPatient = 0;

      $('tbody.moi').load("/caisse/listExamenPrescrit/all", function(){});
      $('tbody.toi').load("/caisse/listExamenEffectue/all", function(){});
      // $('.test').html('<p>Aurevoir</p>');
      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('tbody.moi').load("/caisse/listExamenPrescrit/all", function(){});
            $('tbody.toi').load("/caisse/listExamenEffectue/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('tbody.moi').load("/caisse/listExamenPrescrit/"+ c.val(), function(){
          state = 0;
        });
        $('tbody.toi').load("/caisse/listExamenEffectue/"+ c.val(), function(){
          state = 0;
        });
      }

      
      function save(patient){
        globalPatient = patient;
        $("#patient_id").val(patient);
      }
    </script>

@endsection
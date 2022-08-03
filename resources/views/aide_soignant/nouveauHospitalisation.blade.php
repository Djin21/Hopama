@extends('aide_soignant.layouts.app')

@section('hospitalisation')
  active open
@endsection

@section('hospitalisation_nouveau')
  active
@endsection

@section('content')

<?php

use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Consultation;
use App\Models\Session;
use App\Models\Salle;

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hospitalisation/</span> Nouveau</h4>

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
              Nombre de patient : 150
            </caption>
            <thead>
              <tr>
                <th>Nom du patient</th>
                <th>Date Hospitalisation</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($hospitalisations as $hospitalisation)
                <?php
                  $prescription = Prescription::where('id', $hospitalisation->prescription_id)->first();
                  $consultation = Consultation::where('id', $prescription->consultation_id)->first();
                  $session = Session::where('id', $consultation->session_id)->first();
                  $patient = Patient::where('id', $session->patient_id)->first();
                ?>
                    <tr>
                      {{-- <td>{{ $patient->nom }} {{ $patient->prenom }}</td>
                      <td>{{ $accouchement->created_at->format('d-m-Y') }}</td>
                      <td>{{ $accouchement->nbrEnfant }}</td>
                      <td>{{ $accouchement->nbrDeces }}</td> --}}
                      <td>{{ $patient->nom }} {{ $patient->prenom }}</td>
                      <td>{{ $hospitalisation->created_at->format("d-m-Y") }}</td>
                      <td>
                        <button class="btn w-auto py-2 px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalModifHospi{{$hospitalisation->id}}"><i class="bx bx-edit p-0 m-0" style="color: black;"></i></button>
                      </td>
                    </tr>
                    <form action="{{ route('aide_soignant.setNewHospi') }}" method="post">
                      <input type="text" name="hospi" value="{{ $hospitalisation->id }}" class="d-none">
                      <input type="text" id="idLit" name="idLit" value="" class="d-none">
                      <div class="modal fade modalExam" id="modalModifHospi{{$hospitalisation->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          @csrf
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalCenterTitle">Modifier</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <div class="row g-md-2 newHospi">
                                <div class="row g-md-2 mb-4">
                                  <div class="col mb-0 text-start">
                                    <label for="emailWithTitle" class="form-label">Salle d'hospitalisation</label>
                                    <select class="form-select" id="selectSalle" aria-label="Default select example" name="salleHospi" onchange="loadLit()">
                                        <?php
                                          $salles = Salle::orderBy('created_at', 'desc')->get();  
                                        ?>
                                        @foreach ($salles as $salle)
                                          <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="row g-md-2 mb-4">
                                  <div class="col mb-0 text-start" id="toi">
                                    
                                  </div>
                                </div>
                                <div class="row g-md-2 mb-4">
                                  <div class="col mb-0 text-start">
                                    <label for="emailWithTitle" class="form-label">Duree</label>
                                    <input
                                      type="number"
                                      class="form-control"
                                      id="basic-icon-default-fullname"
                                      placeholder="Nombre de jour"
                                      aria-label="Nombre de jour"
                                      aria-describedby="basic-icon-default-fullname2"
                                      name="dureeHospi"
                                      value="10"
                                      disabled
                                    />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Annuler
                              </button>
                              <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                          </div>
                        
                        </div>
                      </div>
                    </form>
                @endforeach
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

      loadLit();

      function loadLit(){
        // $('#moi').load("/aide_soignant/listeLit/"+ $('#selectSalle').val() + "", function(){});
        $('#toi').load("/aide_soignant/listeLit/"+ $('#selectSalle').val() + "", function(){});
      }

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

      function setLit(id){
        let t = document.getElementById('litSelect');
        $('#idLit').val(t.value);
      }
  </script>
@endsection
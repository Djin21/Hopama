@extends('administrateur.layouts.app')

@section('examen')
  active
@endsection

@section('content')

<?php

use App\Models\Examen; 
use App\Models\Service; 

$examenCpt = Examen::all()->count();
$services = Service::orderBy('nom')->get();

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold pt-3">Examen</h4>
        <div class="row mb-3 mt-0 pt-0 text-end" style="width: 100%">
            {{-- <a href="{{ route('admin.examen.show') }}" class="ms-auto mt-0"><button type="button" class="btn btn-primary" style="width: auto;">Nouveau</button></a> --}}
            <button type="button" class="btn btn-primary ms-auto mt-0" style="width: auto;" data-bs-toggle='modal' data-bs-target='#modalNewExamen'>Nouveau</button>
            <button type="button" class="btn btn-primary ms-2 mt-0" style="width: auto;" data-bs-toggle='modal' data-bs-target='#modalRestaureService'>Restaurer</button>
          </div>
      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="card">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des Examens</h5>
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
                  Nombre des examens : {{ $examenCpt }}
                </caption>
                <thead>
                  <tr>
                    <th>Nom de l'examen</th>
                    <th class="text-center">Service</th>
                    <th class="text-center">Prix</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="moi">
                  
                </tbody>
              </table>
            </div>
          </div>
          
          

        </div>
      </div>
    </div>

  </div>
  <form action="{{ route('admin.examen.modifier', ['idExamen' => 0]) }}" method="post">
    <input type="text" name="type" value="1" class="d-none">
    <div class="modal fade modalExam" id="modalNewExamen" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        
          @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Nouveau</h5>
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
              <label for="nameWithTitle" class="form-label">Nom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    placeholder="Nom de l'examen"
                    aria-label="Nom de l'examen"
                    aria-describedby="basic-icon-default-fullname2"
                    name="nomExamen"
                  />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
              <label for="emailWithTitle" class="form-label">Service</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                      @foreach ($services as $service)
                        <option value="{{$service->id}}">{{$service->nom}}</option>
                      @endforeach
                  </select>
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Prix</label>
                  <input
                    type="number"
                    id="basic-icon-default-phone"
                    class="form-control phone-mask"
                    placeholder="2000"
                    aria-label="2000"
                    aria-describedby="basic-icon-default-phone2"
                    name="prixExamen"
                  />
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
  <div class="modal fade modalExam" id="modalRestaureService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Restaurer</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <h5>Voulez vous retaurer les examens qui on ete supprimés ?</h5>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Annuler
          </button>
          <a href="{{ route('admin.examen.restaurer') }}"><button type="submit" class="btn btn-primary">Restaurer</button></a>
        </div>
      </div>
    
    </div>
  </div>
  {{-- <div class="buy-now">
    <a
      href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
      target="_blank"
      class="btn btn-primary btn-buy-now"
      >Nouveau</a
    >
  </div> --}}

  <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script>
      let val = 1;
      let x = document.getElementById('cel');
      let c = $('#searchexam');
      $('#searchexam').val('');
      $('#patient_id').val('');
      let state = 0;
      let exams = ['1'];
      let tx = [];
      let globalPatient = 0;

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#moi').load("/admin/listExamen/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#moi').load("/admin/listExamen/"+ c.val(), function(){
          state = 0;
        });
      }

      
      function save(patient){
        globalPatient = patient;
        $("#patient_id").val(patient);
      }
    </script>

@endsection
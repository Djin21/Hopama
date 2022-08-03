@extends('administrateur.layouts.app')

@section('service')
  active
@endsection

@section('content')

<?php

use App\Models\Service; 

$serviceCpt = Service::all()->count();
$services = Service::orderBy('nom')->get();

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold pt-3 mb-0">Service</h4>
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
              <h5 class="card-header">Liste des Services</h5>
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
                  Nombre des services : {{ $serviceCpt }}
                </caption>
                <thead>
                  <tr>
                    <th>Nom du service</th>
                    <th class="text-center">Examens</th>
                    {{-- <th class="text-center">Code</th> --}}
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
  <form action="{{ route('admin.service.modifier', ['idService' => 0]) }}" method="post">
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
                    placeholder="Nom du service"
                    aria-label="Nom du service"
                    aria-describedby="basic-icon-default-fullname2"
                    name="nomService"
                  />
              </div>
            </div>
            {{-- <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Code</label>
                  <input
                    type="test"
                    id="basic-icon-default-phone"
                    class="form-control phone-mask"
                    placeholder="12bb2v3"
                    aria-label="12bb2v3"
                    aria-describedby="basic-icon-default-phone2"
                    name="codeService"
                  />
              </div>
            </div> --}}
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label me-3">Peut on y faire des consultation ?</label>
              <div class="form-check form-check-inline my-auto">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="consultable"
                    id="inlineRadio1"
                    value="1"
                    onclick="showPrix()"
                  />
                  <label class="form-check-label" for="inlineRadio1">Oui</label>
                </div>
                <div class="form-check form-check-inline my-auto">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="consultable"
                    id="inlineRadio2"
                    value="0"
                    {{-- onclick="hidePrix()" --}}
                    checked
                  />
                  <label class="form-check-label" for="inlineRadio2">Non</label>
                </div>
              </div>
            </div>
            {{-- <div class="row g-md-2 mb-4 d-none prixConsultation">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Prix</label>
                  <input
                    type="test"
                    id="basic-icon-default-phone"
                    class="form-control phone-mask"
                    placeholder="2000"
                    aria-label="2000"
                    aria-describedby="basic-icon-default-phone2"
                    name="prixConsultation"
                  />
              </div>
            </div> --}}
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
          <a href="{{ route('admin.service.restaurer') }}"><button type="submit" class="btn btn-primary">Restaurer</button></a>
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
      let state = 0;
      let exams = ['1'];
      let tx = [];
      let globalPatient = 0;

      function showPrix(){
        $('.prixConsultation').removeClass('d-none');
      }

      function hidePrix(){
        $('.prixConsultation').addClass('d-none');
      }

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#moi').load("/admin/listService/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#moi').load("/admin/listService/"+ c.val(), function(){
          state = 0;
        });
      }
    </script>

@endsection
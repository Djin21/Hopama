@extends('administrateur.layouts.app')

@section('salle')
  active
@endsection

@section('content')

<?php

use App\Models\Service; 
use App\Models\Personnel; 
use App\Models\Salle; 

$salleCpt = Salle::all()->count();
$services = Service::orderBy('nom')->get();

// $dates = Paiement::where('patient_id', 3)->get();
// $datePass = $dates[$dates->count()-1]->created_at;

// dd($datePass);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold pt-3 mb-0">Personnel</h4>
        <div class="row mb-3 mt-0 pt-0 text-end" style="width: 100%">
            {{-- <a href="{{ route('admin.examen.show') }}" class="ms-auto mt-0"><button type="button" class="btn btn-primary" style="width: auto;">Nouveau</button></a> --}}
            <button type="button" class="btn btn-primary ms-auto mt-0" style="width: auto;" data-bs-toggle='modal' data-bs-target='#modalNewExamen'>Nouveau</button>
            <button type="button" class="btn btn-primary ms-2 mt-0" style="width: auto;" data-bs-toggle='modal' data-bs-target='#modalRestaurePersonnel'>Restaurer</button>
        </div>
      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="card">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des salles</h5>
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
                  Nombre de salle : {{ $salleCpt }}
                </caption>
                <thead>
                  <tr>
                    <th>Salle</th>
                    <th class="text-center">Lits</th>
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
  <form action="{{ route('admin.salle.modifier', ['idSalle' => 0]) }}" method="post">
    <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modalNewExamen" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nouvelle salle</h5>
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
                        placeholder="Nom de la salle"
                        aria-label="Nom de la salle"
                        aria-describedby="basic-icon-default-fullname2"
                        name="nomSalle"
                      />
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Description</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Description de la salle"
                          aria-label="Description de la salle"
                          aria-describedby="basic-icon-default-fullname2"
                          name="descriptionSalle"
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

  <div class="modal fade modalExam" id="modalRestaurePersonnel" tabindex="-1" aria-hidden="true">
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
            <h6>Voulez vous retaurer les examens qui on ete supprimés ?</h6>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Annuler
          </button>
          <a href="{{ route('admin.salle.restaurer') }}"><button type="submit" class="btn btn-primary">Restaurer</button></a>
        </div>
      </div>
    
    </div>
  </div>
  @isset($etatLit)
  <div
      id="toastLit"
      class="bs-toast toast toast-placement-ex m-2 top-0 end-0 bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-delay="5000"
    >
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Enregistrement</div>
        <small>A l'instant</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">Le lit a bien ete ajoutee a la salle : {{ $etatLit }}</div>
    </div>
    @endisset

    <div
      id="toastSalle"
      class="bs-toast toast toast-placement-ex m-2 top-0 end-0 bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-delay="5000"
    >
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Enregistrement</div>
        <small>A l'instant</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">La salle a bien ete cree</div>
    </div>

    <div
      id="toastUpdateSalle"
      class="bs-toast toast toast-placement-ex m-2 top-0 end-0 bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-delay="5000"
    >
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Mise a jour</div>
        <small>A l'instant</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">La salle a bien ete modifiee</div>
    </div>

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

      function show(element){
        element.fadeIn();
        element.addClass('show');
        setTimeout(() => {
            element.fadeOut();
            element.removeClass('show');
        }, 2000);
      }
      @isset($etatSalle)
          show($('#toastSalle'));
      @endisset

      @isset($etatLit)
          show($('#toastLit'));
      @endisset

      @isset($etatUpdateSalle)
          show($('#toastUpdateSalle'));
      @endisset

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#moi').load("/admin/listSalle/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#moi').load("/admin/listSalle/"+ c.val(), function(){
          state = 0;
        });
      }
    </script>

@endsection
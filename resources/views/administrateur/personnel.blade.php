@extends('administrateur.layouts.app')

@section('personnel')
  active
@endsection

@section('content')

<?php

use App\Models\Service; 
use App\Models\Personnel; 

$personnelCpt = Personnel::all()->count();
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
              <h5 class="card-header">Liste du personnel</h5>
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
                  Nombre de personnel : {{ $personnelCpt }}
                </caption>
                <thead>
                  <tr>
                    <th>Nom du personnel</th>
                    <th class="text-center">Service</th>
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
  <form action="{{ route('admin.personnel.modifier', ['idPersonnel' => 0]) }}" method="post">
    <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modalNewExamen" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Ajouter personnel</h5>
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
                      placeholder="Nom du personnel"
                      aria-label="Nom du personnel"
                      aria-describedby="basic-icon-default-fullname2"
                      name="nomPersonnel"
                    />
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Prenom</label>
                    <input
                      type="text"
                      class="form-control"
                      id="basic-icon-default-fullname"
                      placeholder="Prenom du personnel"
                      aria-label="Prenom du personnel"
                      aria-describedby="basic-icon-default-fullname2"
                      name="prenomPersonnel"
                    />
                  </div>
                </div>
                  <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Sexe</label>
                    <div class="form-check form-check-inline my-auto">
                        <input
                          class="form-check-input ms-3"
                          type="radio"
                          name="sexePersonnel"
                          id="inlineRadio1"
                          value="masculin"
                        />
                        <label class="form-check-label" for="inlineRadio1">Masculin</label>
                      </div>
                      <div class="form-check form-check-inline my-auto">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="sexePersonnel"
                          id="inlineRadio2"
                          value="feminin"
                        />
                        <label class="form-check-label" for="inlineRadio2">Feminin</label>
                      </div>
                    </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Date de naissance</label>
                        <input
                          type="date"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Nom du personnel"
                          aria-label="Nom du personnel"
                          aria-describedby="basic-icon-default-fullname2"
                          name="dateNaissPersonnel"
                        />
                    </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Lieu de naissance</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Nom du personnel"
                          aria-label="Nom du personnel"
                          aria-describedby="basic-icon-default-fullname2"
                          name="lieuNaissPersonnel"
                        />
                    </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Telephone</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Numero"
                          aria-label="Numero"
                          aria-describedby="basic-icon-default-fullname2"
                          name="telPersonnel"
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
                  <label for="nameWithTitle" class="form-label">Code d'access</label>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="code"
                        aria-label="code"
                        aria-describedby="basic-icon-default-fullname2"
                        name="codePersonnel"
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
          <a href="{{ route('admin.personnel.restaurer') }}"><button type="submit" class="btn btn-primary">Restaurer</button></a>
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

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#moi').load("/admin/listPersonnel/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#moi').load("/admin/listPersonnel/"+ c.val(), function(){
          state = 0;
        });
      }
    </script>

@endsection
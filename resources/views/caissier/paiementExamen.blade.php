@extends('caissier.layouts.app')

@section('activePaiement')
  active open
@endsection

@section('activeNouveauPaiement')
  active
@endsection

@section('content')


<?php $test = "Salut a toi"; ?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Nouvel Examen</h4>

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
              onclick="erase2()"
            >
              Nouveau
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
              onclick="erase1()"
            >
              Patient
            </button>
          </li>
        </ul>
        <div class="tab-content p-0">
            <div class="card tab-pane fade show active py-4 px-4" id="navs-pills-top-home" role="tabpanel">
              <form method="POST" action="{{ route('caisse.paiementExamen.save') }}">
                @csrf
                <div class="row mb-4 mx-md-4">
                  <label class="col-sm-12 col-form-label mb-2" for="basic-icon-default-fullname">Nom :</label>
                  <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="nom"
                        placeholder="Nom du patient"
                        aria-label="Nom du patient"
                        aria-describedby="basic-icon-default-fullname2"
                        name="nomPatient"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-4 mx-md-4">
                  <label class="col-sm-12 col-form-label mb-2" for="basic-icon-default-fullname">Prenom : </label>
                  <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                      <span id="prenom2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="prenom"
                        placeholder="Prenom du patient"
                        aria-label="Prenom du patient"
                        aria-describedby="basic-icon-default-fullname2"
                        name="prenomPatient"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-4 mx-md-4 align-items-center pb-2">
                  <label class="col-sm-1 col-form-label pe-0 me-0" for="basic-icon-default-company">Sexe :</label>
                  <div class="col-sm-10 text-start">
                    <div class="form-check form-check-inline my-auto">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="sexePatient"
                        id="inlineRadio1"
                        value="0"
                        checked
                      />
                      <label class="form-check-label" for="inlineRadio1">Masculin</label>
                    </div>
                    <div class="form-check form-check-inline my-auto">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="sexePatient"
                        id="inlineRadio2"
                        value="1"
                      />
                      <label class="form-check-label" for="inlineRadio2">Feminin</label>
                    </div>
                  </div>
                </div>
                <div class="row mb-4 mx-md-4">
                  <label class="col-sm-12 col-form-label mb-2" for="basic-icon-default-fullname">Date de naissance : </label>
                  <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"
                        ><i class="bx bx-time"></i
                      ></span>
                      <input
                        type="date"
                        class="form-control"
                        id="dateNaiss"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name="dateNaissPatient"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-4 mx-md-4">
                  <label class="col-sm-12 col-form-label mb-2" for="basic-icon-default-fullname">lieu de naissance : </label>
                  <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                      <span  class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="lieuNaiss"
                        placeholder="Lieu"
                        aria-label="Lieu"
                        aria-describedby="basic-icon-default-fullname2"
                        name="lieuNaissPatient"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-4 mx-md-4">
                  <label class="col-sm-12 col-form-label mb-2" for="basic-icon-default-fullname">Habitation : </label>
                  <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                      <span  class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="habitation"
                        placeholder="Habitation"
                        aria-label="habitation"
                        aria-describedby="basic-icon-default-fullname2"
                        name="habitationPatient"
                      />
                    </div>
                  </div>
                </div>

                <input type="text" class="d-none" name="type" value = '1'>
                <div class="row justify-content-end p-0 m-0" style="width: 100%;">
                  {{-- <div class=""> --}}
                    <button type="submit" class="btn btn-primary ms-auto me-4" style="width: auto;" name="enregistrerBtn">Enregistrer</button>
                  {{-- </div> --}}
                </div>
              </form>
            </div>
          <div class="card tab-pane fade py-4 px-4" id="navs-pills-top-profile" role="tabpanel">
            <form method="POST" action="{{ route('caisse.paiementExamen.save') }}">
              @csrf
            <div class="align-items-center">
              <div class="d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                  type="text"
                  oninput="voila()"
                  id="searchexam"
                  class="form-control border-0 shadow-none"
                  placeholder="Search..."
                  aria-label="Search..."
                />
              </div>
            </div>
            <div class="moi col-12">
              
            </div>
            <input type="text" class="d-none" name="type" value = '2'>
            <input type="text" class="d-none" name="patient" id="patient_id" required>
            <div class="row justify-content-end">
              <div class="col-sm-3">
                <button class="btn btn-primary" name="choiceBtn" id="saveBtn1">Enregistrer</button>
              </div>
            </div>
            </form>
          </div>
        </div>
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
      <div class="toast-body">Le paiement a bien ete enregistre</div>
    </div>

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

      function show(){
        $('#toast').fadeIn();
        $('#toast').addClass('show');
        setTimeout(() => {
            $('#toast').fadeOut();
            $('#toast').removeClass('show');
        }, 2000);
      }
      @isset($state)
          show();
      @endisset

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('div.moi').load("/caisse/listPatient/all", function(){});
            state = 1;
          }
        }
      }, 500);

      setInterval(() => {
        // refresh();
        verify();
      }, 100);

      function verify(){
        let table = document.querySelectorAll('input[name="patient"]');
        tx.forEach((element) => {
          table.forEach((checkbox) => {
            if(element == checkbox.value){
              checkbox.checked = true;
            }
          });
        });
      }
      
      function fresh(id){
        let tmp = [];
        let elmt = document.querySelectorAll('input[name="patient"]');
        elmt.forEach((element) => {
          if(element.value == id){
            if(element.checked){
              tx.push(element.value);
            }else{
              delete tx[tx.indexOf(element.value)]
              tx.forEach((element) => {
                if(element != undefined){
                  tmp.push(element);
                }
              });
              tx = tmp;
            }
          }
        });
      }
      function refresh(id){
        let tmp = [];
        let elmt = document.querySelectorAll('input[name="patient"]');
        elmt.forEach((element) => {
          if(element.value == id){
            if(element.checked){
              element.checked = false;
            }else{
              element.checked = true;
            }
          }
        });
        fresh(id);
      }

      function voila(){
        $('div.moi').load("/caisse/listPatient/"+ c.val(), function(){
          state = 0;
        });
      }

      function erase1(){
        $('#nom').val('');
        $('#prenom').val('');
      }

      function erase2(){
        $('#searchexam').val('');
      }

      
      function save(patient){
        refresh(patient);
          globalPatient = patient;
          $("#patient_id").val(patient);
      }
    </script>

@endsection

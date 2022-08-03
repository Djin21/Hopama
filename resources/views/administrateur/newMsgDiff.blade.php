<?php
    use App\Models\Patient;

    $patients = Patient::orderBy('nom')->get();
?>

@extends('administrateur.layouts.app')

@section('message')
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
  <form action="{{ route('admin.sendMsg') }}" method="post">
    <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold pt-3 mb-0">Personnel</h4>
            <div class="row mb-3 mt-3 pt-0 text-end" style="width: 100%">
                <div class="card col-12 mx-auto" id="firstPart">
                    <div class="card-body">
                        <div class="row g-md-2 mb-4">
                            <div class="col mb-0 text-start">
                              <div class="row d-flex flex-row justify-content-end">
                                {{-- <h3 class="me-auto w-auto">Patient</h3> --}}
                                <button type="button" class="btn btn-secondary w-auto p-0 p-2" onclick="uncheckAll()">Tout deselectionner</button>
                                <button type="button" class="btn btn-secondary w-auto p-0 p-2 ms-2" onclick="checkAll()">Tout selectionner</button>
                              </div>
                                <div class="d-flex align-items-center">
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
                            <div class="py-3" id="patient">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row w-100 p-0 m-0 text-end d-flex justify-content-end" style="position: fixed; bottom:0; right:0;">
                <button type="button" class="btn btn-primary w-auto m-3" data-bs-toggle="modal" data-bs-target="#secondPart">Suivant</button>
            </div>
    </div>

  </div>
    <div class="modal fade modalExam" id="secondPart" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        
            @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Nouveau message</h5>
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
                    <label for="nameWithTitle" class="form-label">Message</label>
                    <textarea class="form-control" name="msgDiffus" id="msg" cols="30" rows="10"></textarea>
                </div>
            </div>
            {{-- <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                <label for="nameWithTitle" class="form-label">Date et heure d'envoi</label>
                    <input
                        type="date"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="Prenom du personnel"
                        aria-label="Prenom du personnel"
                        aria-describedby="basic-icon-default-fullname2"
                        name="descriptionSalle"
                    />
                </div>
                </div> --}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Annuler
            </button>
            <button type="submit" class="btn btn-primary">Envoyer</button>
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

      voila();
      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#patient').load("/admin/listePatientStat/10", function(){});
            state = 1;
          }
        // $('#patient').load("/admin/listePatientStat/10", function(){});
        // $('#choicePat').addClass('d-none');
        }
      }, 100);

      let pats = [];
      @foreach ($patients as $patient)
          pats.push("{{ $patient->nom }}");
      @endforeach
      let patients = $('div.patientsChoice');
      function refresh(){
        let tmp = [];
        let table = document.querySelectorAll('input[name="patient[]"]');
        for (let index = 0; index < table.length; index++) {
            const element = table[index];
            if(element.checked){
                // $('#nomPatient').val(pats[element.value-1]);
                // patients[element.value-1].removeClass('d-none');
                let tmp = element.value-1;
                $('#patients'+ tmp).removeClass('d-none');
            }else{
                patients[element.value-1].addClass('d-none');
            }
        }
        // let div = document.createElement('div');
        // div.id = 'content';
        // div.innerHTML = '<p>CreateElement example</p>';

        // document.body.appendChild(div);
        
      }

      setInterval(() => {
        // refresh();
        verify();
      }, 100);

      function checkAll(){
        let table = document.querySelectorAll('input[name="patient[]"]');
        table.forEach((checkbox) => {
            checkbox.checked = true;
        });
      }

      function uncheckAll(){
        let table = document.querySelectorAll('input[name="patient[]"]');
        table.forEach((checkbox) => {
            checkbox.checked = false;
        });
      }

    function verify(){
        let table = document.querySelectorAll('input[name="patient[]"]');
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
        let elmt = document.querySelectorAll('input[name="patient[]"]');
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
        let elmt = document.querySelectorAll('input[name="patient[]"]');
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
          state = 0;
        // $('#choicePat').removeClass('d-none');
        $('#patient').load("/admin/listePatientStat/"+ c.val(), function(){
          state = 0;
        });
      }

    </script>

@endsection
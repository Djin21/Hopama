@extends('caissier.layouts.app')

@section('activePaiement')
  active open
@endsection

@section('activeNouveauPaiement')
  active open
@endsection

@section('activeNouveauPaiementClient')
  active
@endsection

@section('content')


<?php $test = "Salut a toi"; ?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Nouveau paiement</h4>

      <form method="POST" action="{{ route('caisse.consultationPaiement.save') }}">
        @csrf
          <div class="card py-2 px-4">
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
            <input type="text" class="d-none" name="type" value = '2'>
          </div>
            <div class="row d-flex justify-content-end pt-3" style="width: 100%">
                <button type="submit" class="btn btn-primary ms-auto" style="width: auto">Enregistrer</button>
            </div>
      <div class="moi col-12">
              
    </div>
    </form>
    </div>

    <script>
      let val = 1;
      let x = document.getElementById('cel');
      let y = document.getElementById('examen');
      let c = $('#searchexam');
      c.val('');
      let state = 0;
      let exams = ['1'];
      let tx = [];

      $('div.moi').load("/caisse/loadListeConsultation/all", function(){});

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('div.moi').load("/caisse/loadListeConsultation/all", function(){});
            state = 1;
          }
          // alert('Salut')
        }
        
      }, 500);

      setInterval(() => {
        verify();
      }, 100);

      function verify(){
        let table = document.querySelectorAll('input[name="consultation"]');
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
        let elmt = document.querySelectorAll('input[name="consultation"]');
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
        let elmt = document.querySelectorAll('input[name="consultation"]');
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
        $('div.moi').load("/caisse/loadListeConsultation/" + c.val(), function() {
          state = 0;
        });
      }
    </script>

<script>
  let globalExam = tx;
  function save(examen){
      refresh(examen);
      globalExam = examen;
      $("#saveBtn").html("<a href='/caisse/paiementClient/"+globalExam+"' style='color:white; text-style:none;'>Enregistrer</a>");
  }
</script>

@endsection

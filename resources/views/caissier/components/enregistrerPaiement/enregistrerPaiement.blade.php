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

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>


<?php $test = "Salut a toi"; ?>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Nouveau paiement</h4>

      <div class="nav-align-top mb-4">
        <div class="tab-content p-0">
          <div class="card tab-pane fade show active py-4 px-4" id="navs-pills-top-profile" role="tabpanel">
            <form method="POST" action="#">
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
                <button class="btn btn-primary" name="saveBtn" id="saveBtn">Enregistrer</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Basic Layout & Basic with Icons -->
      {{-- <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="col-xl-8 mx-auto">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                  <button
                    type="button"
                    class="nav-link active"
                    role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-justified-home"
                    aria-controls="navs-justified-home"
                    aria-selected="true"
                  >
                    <i class="tf-icons bx bx-home"></i> Examen
                  </button>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                  
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
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-3">
                        <button class="btn btn-primary" id="saveBtn" name="enregistrerBtn" >Enregistrer</button>
                      </div>
                    </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
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

      $('div.moi').load("/listExam/all", function(){});
      

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('div.moi').load("/listExam/all", function(){});
            state = 1;
          }
          // alert('Salut')
        }
        
      }, 500);

      setInterval(() => {
        // refresh();
        verify();
      }, 100);

      // function refresh(){
      //   let tmp = [];
      //   let table = document.querySelectorAll('input[name="exam"]');
      //   table.forEach((element) => {
      //     if(tx.includes(element.value)){
      //       if(!element.checked){
      //         delete tx[tx.indexOf(element.value)]
      //         tx.forEach((element) => {
      //           if(element != undefined){
      //             tmp.push(element);
      //           }
      //         });
      //         tx = tmp;
      //       }
      //     }else{
      //       if(element.checked){
      //         tx.push(element.value);
      //       }
      //     }
      //   });
        
      // }

      function verify(){
        let table = document.querySelectorAll('input[name="exam"]');
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
        let elmt = document.querySelectorAll('input[name="exam"]');
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
        let elmt = document.querySelectorAll('input[name="exam"]');
        elmt.forEach((element) => {
          if(element.value == id){
            if(element.checked){
              element.checked = false;
            }else{
              element.checked = true;
            }
          }
        });
        // fresh(id);
      }

      function voila(){
        // let checkBtn = document.querySelectorAll('input[name="exam"]:checked');
        // for(let i=0; i<checkBtn.length; i++){
        //   tx.push(checkBtn[i].value);
        // }
        // document.querySelectorAll('input[name="exam"]').forEach((element) => {
        //   if (element.checked) {
        //     ex.push[element]
        //   }
        // });
        $('div.moi').load("/listExam/"+ c.val(), function() {
          state = 0;
        });
        
        // exams.forEach(exam => {
        //   if(exam !=0){
        //     $('input.check').eq()
        //   }
        // });
        // for(let i=0; i<exams.lenght; i++){
        //   if(exams[i] != 0){
        //     // $('input.check').eq(i).add
        //     document.querySelectorAll('input[name="exam"]').
        //   }
        // }
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

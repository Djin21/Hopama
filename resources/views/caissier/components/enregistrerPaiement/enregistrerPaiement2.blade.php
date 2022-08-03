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

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
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
                        {{-- @include('caissier.test') --}}
    
                        {{-- @include('caissier.test') --}}
                        {{-- <x-listComponent id='first' name="valeur" :exam="$test"/> --}}
                      </div>
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-3">
                        <button class="btn btn-primary" id="saveBtn" name="enregistrerBtn" onclick="alert(globalExam)" >Enregistrer</button>
                      </div>
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <script>
      let val = 1;
      let x = document.getElementById('cel');
      let y = document.getElementById('examen');
      let c = $('#searchexam');
      c.val('');

      // $('div.moi').load("/listExam/all", function(){});

      setInterval(() => {
        if($('#searchexam').val() == ''){
          $('div.moi').load("/listExam/all", function(){});
          // alert('Salut')
        }
      }, 500);

      function voila(){
        // alert(c.val());
        // $('div.moi').load("/listExam/"+ c.val() + "", function(){});
        // $('div.moi').fadeOut();
        
        $('div.moi').load("/listExam/"+ c.val(), function() {
            $('div.moi').fadeIn();
        });
      }

      function enregistrerPaie(){
          
      }
    </script>

@endsection

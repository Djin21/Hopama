@extends('service.layouts.app')

@section('activePaiement')
  active open
@endsection

@section('activePaiementHistorique')
  active
@endsection

<?php 
  use App\Models\Patient; 
  // use App\Models\Examen;
  use App\Models\Session;
  use App\Models\Examen;
  use App\Models\Examen_effectue;

?>

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Historique</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="card">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des examens</h5>
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <caption class="ms-4">
                  Nombre d'examen : 
                </caption>
                <thead>
                  <tr>
                    <th>Nom du patient</th>
                    <th>Examen</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @isset($paiements)
                        
                  @foreach ($paiements as $paiement)
                    <?php 
                      // $patient = Patient::where('id', $paiement->patient_id)->firstOrFail();
                      // $examen = Examen::where('id', $paiement->examen_id)->firstOrFail();
                      $examen = Examen::where('id', $paiement->examen_id)->first();
                      $patient = Patient::where('id', $paiement->patient_id)->first();
                      $resultat = Examen_effectue::where('paiement_id', $paiement->id)->first()->resultat;
                    ?>
                  <tr>
                    <td><strong>{{ $patient->nom }} {{ $patient->prenom }}</strong></td>
                    <td>{{ $examen->nom }}</td>
                    {{-- <td><span class="badge bg-label-primary">{{ $examen->nom }}</span></td> --}}
                    <td>
                      <button
                        type="button"
                        class="btn text-nowrap"
                        data-bs-toggle="popover"
                        data-bs-offset="0,14"
                        data-bs-placement="bottom"
                        data-bs-html="true"
                        data-bs-content="<a class='dropdown-item' style='cursor: pointer;' data-bs-toggle='modal' data-bs-target='#modalResultat{{$paiement->id}}'><i class='bx bx-edit-alt me-1'></i> Examiner</a>" 
                        title=""
                        style="cursor: pointer;"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <form action="{{ route('service.setResult')}}" method="post">
                        <input type="text" name="paiement" value="{{$paiement->id}}" class="d-none">
                        <div class="modal fade modalExam" id="modalResultat{{$paiement->id}}" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            
                              @csrf
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Resultat</h5>
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
                                    <textarea class="form-control" name="resultat" id="resultat" cols="30" rows="10">{{ $resultat == Null ? '' : $resultat }}</textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                          </div>
                        </div>
                      </form>
                      <!-- <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                          >
                        </div>
                      </div> -->
                    </td>
                  </tr>
                  @endforeach
                  @endisset
                </tbody>
              </table>
            </div>
          </div>
          
          

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
  <!-- / Main content -->

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

      function voila(){
        $('div.moi').load("/caisse/listPatient/"+ c.val(), function(){
          state = 0;
        });
      }
    </script>
  @endsection
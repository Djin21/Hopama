@extends('caissier.layouts.app')

@section('activePaiement')
  active open
@endsection

@section('activePaiementHistorique')
  active
@endsection

<?php 
  use App\Models\Patient; 
  use App\Models\Session;
  use App\Models\Type_consultation;

  $sessions = Session::orderBy('created_at')->get();
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
              <h5 class="card-header">Liste des paiements</h5>
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
                  Nombre de paiement : {{ $sessions->count() }}
                </caption>
                <thead>
                  <tr>
                    <th>Nom du patient</th>
                    <th>Date de paiement</th>
                    <th>Examen</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sessions as $session)
                    <?php 
                      // $patient = Patient::where('id', $paiement->patient_id)->firstOrFail();
                      // $examen = Examen::where('id', $paiement->examen_id)->firstOrFail();
                      $type_consultation = Type_consultation::where('id', $session->type_consultation_id)->firstOrFail();
                      $patient = Patient::where('id', $session->patient_id)->firstOrFail();
                    ?>
                  <tr>
                    <td><strong>{{ $patient->nom }} {{ $patient->prenom }}</strong></td>
                    {{-- <td>{{ $paiement->created_at->format('d/m/Y | H:i') }}</td> --}}
                    <td>{{ $session->created_at->format('d/m/Y | H:i') }}</td>
                    {{-- <td><span class="">{{ $examen->nom }}</span></td> --}}
                    <td><span class="">{{ $type_consultation->nom }}</span></td>
                    {{-- <td><span class="badge bg-label-primary">{{ $examen->nom }}</span></td> --}}
                    <td>
                      <button
                        type="button"
                        class="btn text-nowrap"
                        data-bs-toggle="popover"
                        data-bs-offset="0,14"
                        data-bs-placement="bottom"
                        data-bs-html="true"
                        data-bs-content="<a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-edit-alt me-1'></i> Modifier</a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-delete me-1'></i> Supprimer</a>" 
                        title=""
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
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
@extends('aide_soignant.layouts.app')

@section('patient')
  active open
@endsection

@section('historique')
  active
@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Historique</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="card">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des patients</h5>
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
                  Nombre de patient : 150
                </caption>
                <thead>
                  <tr>
                    <th>Nom du patient</th>
                    <th>Date de passage</th>
                    <th>Motif</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="moi">
                  {{-- <tr>
                    <td><strong>Albert Cook</strong></td>
                    <td>20/04/2021</td>
                    <td><span class="badge bg-label-primary">Suivit</span></td>
                    <td>
                      <button
                        type="button"
                        class="btn text-nowrap"
                        data-bs-toggle="popover"
                        data-bs-offset="0,14"
                        data-bs-placement="bottom"
                        data-bs-html="true"
                        data-bs-content="<a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-edit-alt me-1'></i> Modifier</a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Donnees</a>" 
                        title=""
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button> --}}
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
                    {{-- </td>
                  </tr> --}}
                </tbody>
              </table>
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
      let c = $('#searchexam');
      $('#searchexam').val('');
      $('#patient_id').val('');
      let state = 0;
      let exams = ['1'];
      let tx = [];
      let globalPatient = 0;

      setInterval(() => {
        if($('#searchexam').val() == ''){
          if(state == 0){
            $('#moi').load("/medecin/listPatient/all", function(){});
            state = 1;
          }
        }
      }, 500);

      function voila(){
        $('#moi').load("/medecin/listPatient/"+ c.val(), function(){
          state = 0;
        });
      }

      
      function save(patient){
        globalPatient = patient;
        $("#patient_id").val(patient);
      }
    </script>

  <!-- / Main content -->

  @endsection
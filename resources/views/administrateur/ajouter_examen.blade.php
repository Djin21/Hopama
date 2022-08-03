@extends('administrateur.layouts.app')

@section('patient')
  active open
@endsection

@section('nouveauPatient')
  active
@endsection

@section('content')

<?php 
  use App\Models\Examen; 
  use App\Models\Service; 

  $services = Service::orderBy('nom')->get();

?>



    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Examen/</span> Nouvel examen</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Informations du patient</h5>
              <!-- <small class="text-muted float-end">Merged input group</small> -->
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('admin.examen.ajouter') }}">
                @csrf
                <div class="row mb-4">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nom</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="Nom de l'examen"
                        aria-label="Nom de l'examen"
                        aria-describedby="basic-icon-default-fullname2"
                        name="nomExamen"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Service</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                          {{-- <option selected>Services</option>
                          <option value="Accueil">Accueil</option>
                          <option value="Medecin">Medecin</option>
                          <option value="Laboratoire">Laboratoire</option>
                          <option value="Echographie">Echographie</option> --}}
                          @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->nom}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <label class="col-sm-2 form-label" for="basic-icon-default-phone">Prix</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"
                        ><i class="bx bx-phone"></i
                      ></span>
                      <input
                        type="number"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="691345683"
                        aria-label="691345683"
                        aria-describedby="basic-icon-default-phone2"
                        name="prixExamen"
                      />
                    </div>
                  </div>
                </div>
                <!-- <div class="row mb-3">
                  <label class="col-sm-2 form-label" for="basic-icon-default-message">Message</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-message2" class="input-group-text"
                        ><i class="bx bx-comment"></i
                      ></span>
                      <textarea
                        id="basic-icon-default-message"
                        class="form-control"
                        placeholder="Hi, Do you have a moment to talk Joe?"
                        aria-label="Hi, Do you have a moment to talk Joe?"
                        aria-describedby="basic-icon-default-message2"
                      ></textarea>
                    </div>
                  </div>
                </div> -->
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>
                </div>
              </form>
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
      <div class="toast-body">L'examen a bien ete enregistre</div>
    </div>

  </div>

  <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
  <script>
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
  </script>

@endsection



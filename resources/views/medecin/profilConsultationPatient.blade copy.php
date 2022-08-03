@extends('medecin.layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y ps-0">

    {{-- <div class="row" style="height: 50vh; width: 100%; background-color:antiquewhite">

    </div>
    <div class="row" style="height: 50vh; width: 100%; background-color:blue">

    </div> --}}
    {{-- Best color rgba(255, 255, 255, 0.699) --}}
    <div class="row" style="width: 100%;">
        <div class="row m-0 ms-3 p-0" style="height: 280px;">
            <div class="col-md-3 p-2">
                <div class="card space-profile text-center d-flex flex-column align-items-center pt-4 pb-3" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <div class="image rounded-pill" style="height: 80px; width: 80px; background-color:aliceblue">

                    </div>
                    <div class="name pt-4">
                        <h5 class="mb-1 pb-0" style="font-weight: 600">Roland Jurique</h5>
                        <a href="" class="bn m-0 " style="color: rgba(128, 128, 128, 0.39); width:auto; height:auto;">Envoyer un message</a>
                    </div>
                    <div class="name pt-4">
                        <p class="m-0 p-0" style="font-size: 0.85rem">Prochain rendez-vous</p>
                        <h6 class="m-0 p-0 mt-1" style="font-weight: 600">00/00/0000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-5 p-2">
                <div class="card space-profile p-4 ps-4 ps-md-5 d-flex flex-column justify-content-evenly" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <div class="row mb-2 mb-md-0">
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143); color:rgb(143, 143, 143)">Date de naissance :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Telephone :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00000000</strong></h6>
                        </div>
                    </div>
                    <div class="row mb-2 mb-md-0">
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Sexe :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Adresse :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                        </div>
                    </div>
                    <div class="row mb-2 mb-md-0">
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Statut matrimonial :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                        </div>
                        <div class="col-6">
                            <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Enregistre le :</p>
                            <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="text-start ps-3" style="font-weight: 600">Parametres corporelles</h5>
                    <ul class="m-0 p-0 mx-4 pt-3" style="list-style: none">
                        <li class="d-flex justify-content-between">
                            <p>Temperature</p>
                            <h6 style="font-size: 1.05rem">Valeur</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Tension</p>
                            <h6 style="font-size: 1.05rem">Valeur</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Poids</p>
                            <h6 style="font-size: 1.05rem">Valeur</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Taille</p>
                            <h6 style="font-size: 1.05rem">Valeur</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row m-0 ms-3 p-0" style="height: 280px;">
            <div class="col-md-4 p-2">
                <div class="card space-profile text-center d-flex flex-column align-items-center pt-4 pb-3" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="" style="font-weight: 600">Symptomes et antecedents</h5>
                  <div class="mt-3 px-2" style="width: 100%;">
                        <ul class="nav nav-pills m-0 p-0 mb-2 p-1 row d-flex justify-content-center" style="width: 100%; background-color:rgba(201, 201, 201, 0.103); border-radius: 10px" role="tablist">
                          <li class="nav-item col-6 m-0 p-0">
                            <button
                              type="button"
                              class="nav-link active val py-1"
                              role="tab"
                              data-bs-toggle="tab"
                              data-bs-target="#navs-pills-justified-home"
                              aria-controls="navs-pills-justified-home"
                              aria-selected="true"
                            >
                              Symptomes
                            </button>
                          </li>
                          <li class="nav-item col-6 m-0 p-0">
                            <button
                              type="button"
                              class="nav-link val py-1"
                              role="tab"
                              data-bs-toggle="tab"
                              data-bs-target="#navs-pills-justified-messages"
                              aria-controls="navs-pills-justified-messages"
                              aria-selected="false"
                            >
                              Antecedent
                            </button>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                            <div class="text-start" id="test-scroll" style="height: 115px; overflow-y: hidden;">
                              Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps
                              powder. Bear claw candy topping.
                              Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon
                              jelly-o jelly-o ice cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow
                              jujubes sweet.lksd sdfksjdfl hlksd hfkjshdklfh lkdsfkhkdfh lkjshdjflhksh dfihskldfjjsdfh
                            </div>
                            <div class="row test-start m-0 p-0" style="width: 100%">
                              <button class="btn m-0 p-0 mt-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalSymptomes'><i class="bx bx-edit"></i> Editer</button>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                            <ul class="p-0 m-0" style="list-style: none">
                              <li class="mb-3">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent;">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent'>
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                              </li>
                              <li class="mb-3">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent;">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent'>
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                              </li>
                              <li class="mb-3">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent;">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0">
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                              </li>
                            </ul>
                            <div class="row test-start m-0 p-0" style="width: 100%">
                              <button class="btn m-0 p-0" style="width:auto;"><i class="bx bx-edit"></i> Voir plus</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="card space-profile p-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 p-0" style="font-weight: 600">Prescription</h5>
                    <div class="dropdown btn m-0 p-0 text-end">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu py-3">
                        <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalPrescription'
                          ></i><i class='bx bx-edit-alt me-1'></i>Nouveau</a
                        >
                        <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href=""
                          ><i class="bx bx-trash me-1"></i> Examen</a
                        >
                        <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href=""
                          ><i class="bx bx-trash me-1"></i> Ordonnance</a
                        >
                        <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href=""
                          ><i class="bx bx-trash me-1"></i> Hospitalisation</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="m-0 p-0">Examens</h6>
                  </div>
                  <div>
                    <ul class="p-0 m-0 pt-3" style="list-style: none">
                      <li class="mb-2">
                        <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                          <div class="text-start">
                            <p class="p-0 m-0" style="font-size: 0.85rem">Service</p>
                            <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                              Nom de l'examen
                            </p>
                          </div>
                            <button class="btn m-0 p-0 text-start">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </div>
                      </li>
                      <li class="mb-2">
                        <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                          <div class="text-start">
                            <p class="p-0 m-0" style="font-size: 0.85rem">Service</p>
                            <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                              Nom de l'examen
                            </p>
                          </div>
                            <button class="btn m-0 p-0 text-start">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </div>
                      </li>
                      <li class="mb-2">
                        <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                          <div class="text-start">
                            <p class="p-0 m-0" style="font-size: 0.85rem">Service</p>
                            <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                              Nom de l'examen
                            </p>
                          </div>
                            <button class="btn m-0 p-0 text-start">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="row m-0 p-0 pb-3" style="height: 50%">
                  <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="text-start" style="font-weight: 600">Rendez-vous</h5>
                    
                  </div>
                </div>
                <div class="row m-0 p-0" style="height: 50%">
                  <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="text-start" style="font-weight: 600">Notes</h5>
                    <div class="row m-0 p-0">
                      <div class="text-start m-0 p-0 btn" style="height: 50px; overflow-y: hidden; font-size: 0.9rem">
                        Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame jh adshkas djkasdhas hdvhasv jkvdhasj kvdhvashkj vdjasvh dvas fbsdjfpljvasjkdfvhgadiu fvjhweavhfewivbwe fjbsd j fi
                      </div>
                      <div class="row test-start m-0 p-0 mt-2" style="width: 100%">
                        <button class="btn m-0 p-0" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalNotes'><i class="bx bx-edit"></i> Editer</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modals --}}
{{-- Symptomes --}}

<form action="{{ route('admin.service.modifier', ['idService' => 0]) }}" method="post">
  <input type="text" name="type" value="1" class="d-none">
  <div class="modal fade modalExam" id="modalSymptomes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Symptomes</h5>
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
              <textarea class="form-control" name="symptomes" id="symptomes" cols="30" rows="10"></textarea>
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

{{-- / Symptomes --}}

{{-- Antecedent --}}

  <div class="modal fade modalExam" id="modalAntecedent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Theme de l'antecedent</h5>
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
              <p>Description de l'antecedent</p>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </div>

  {{-- / Antecedent --}}

{{-- Prescription --}}

<form action="{{ route('admin.service.modifier', ['idService' => 0]) }}" method="post">
  <input type="text" name="type" value="1" class="d-none">
  <div class="modal fade modalExam" id="modalPrescription" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Prescription</h5>
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
              <label for="emailWithTitle" class="form-label">Type de prescription</label>
              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                  <option value="1">Examen</option>
                  <option value="2">Ordonnance</option>
                  <option value="3">Hospitalisation</option>
              </select>
            </div>
          </div>
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              liste des examens
            </div>
          </div>
          <div class="row g-md-2 mb-4 d-none newOrdonnance">
            <div class="col mb-0 text-start">
              <textarea class="form-control" name="symptomes" id="ordonnance" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="row g-md-2 mb-4 d-none newHospi">
            <div class="col mb-0 text-start">
              <label for="emailWithTitle" class="form-label">Salle d'hospitalisation</label>
              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                  <option value="">Salle 1</option>
                  <option value="">Salle 2</option>
                  <option value="">Salle 3</option>
              </select>
            </div>
          </div>
          <div class="row g-md-2 mb-4 d-none newHospi">
            <div class="col mb-0 text-start">
              <label for="emailWithTitle" class="form-label">Lit</label>
              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                  <option value="">Lit 1</option>
                  <option value="">Lit 2</option>
                  <option value="">Lit 3</option>
              </select>
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

{{-- / Prescription --}}

{{-- Notes --}}

<form action="{{ route('admin.service.modifier', ['idService' => 0]) }}" method="post">
  <input type="text" name="type" value="1" class="d-none">
  <div class="modal fade modalExam" id="modalNotes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Notes</h5>
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
              <textarea class="form-control" name="notes" id="notes" cols="30" rows="10"></textarea>
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

{{-- / Notes --}}

{{-- showNotes --}}

<div class="modal fade modalExam" id="modalshowNotes" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Notes</h5>
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
            <p>Description de la note</p>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</div>

{{-- / showNotes --}}

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script>
</script>

@endsection
@extends('aide_soignant.layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y ps-0">

    {{-- <div class="row" style="height: 50vh; width: 100%; background-color:antiquewhite">

    </div>
    <div class="row" style="height: 50vh; width: 100%; background-color:blue">

    </div> --}}
    {{-- Best color rgba(255, 255, 255, 0.699) --}}
    <div class="row my-0 py-0">
        <div class="col-8">
            <div class="row" style="height: 300px;">
                <div class="col-md-5 p-2">
                    <div class="card space-profile text-center d-flex flex-column align-items-center pt-4 pb-3" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                        <div class="image rounded-pill align-items-center d-flex flex-column justify-content-center" style="height: 80px; width: 80px; background-color:#696cff">
                            <span class="bx bx-user my-auto" style="font-size: 2rem; color:white"></span>
                          </div>
                          <div class="name pt-4">
                              <h5 class="mb-1 pb-0" style="font-weight: 600">{{ $patient->nom }} {{ $patient->prenom }}</h5>
                              <a href="{{ route('global.sendSmsOne', ['idPatient' => $patient->id]) }}" class="bn m-0 " style="color: rgba(128, 128, 128, 0.39); width:auto; height:auto;">Envoyer un message</a>
                          </div>
                          <div class="name pt-4">
                              <p class="m-0 p-0" style="font-size: 0.85rem">Prochain rendez-vous</p>
                              <h6 class="m-0 p-0 mt-1" style="font-weight: 600">{{ $rdv == Null ? 'Aucun' : $rdvDate }}</h6>
                          </div>
                          <div class="row test-end m-0 p-0 pe-4 pb-3" style="width: auto; position:absolute; bottom:0; right:0;">
                            <button class="btn m-0 p-0 mt-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalRdv'><i class="bx bx-edit"></i></button>
                          </div>
                    </div>
                </div>
                <div class="col-md-7 p-2">
                    <div class="card space-profile p-4 ps-4 ps-md-5 d-flex flex-column justify-content-evenly" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                        <div class="row mb-2 mb-md-0">
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143); color:rgb(143, 143, 143)">Date de naissance :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->dateNaiss == Null ? 'Inconnu' : $patient->dateNaiss }}</strong></h6>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Telephone :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->telephone == Null ? 'Inconnu' :  $patient->telephone}}</strong></h6>
                            </div>
                        </div>
                        <div class="row mb-2 mb-md-0">
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Sexe :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->sexe == 0 ? 'Masculin' : 'Feminin' }}</strong></h6>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Adresse :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->adresse == Null ? 'Inconnu' : $patient->adresse }}</strong></h6>
                            </div>
                        </div>
                        <div class="row mb-2 mb-md-0">
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Lieu de naissance :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Profession :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>00/00/0000</strong></h6>
                            </div>
                        </div>
                        <div class="row mb-2 mb-md-0">
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Statut matrimonial :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->statutMatrimonial == 0 ? 'Celibataire' : 'Marier' }}</strong></h6>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Enregistre le :</p>
                                <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->created_at->format('d/m/Y') }}</strong></h6>
                            </div>
                        </div>
                        <div class="row test-end m-0 p-0 pe-4 pb-3" style="width: auto; position:absolute; bottom:0; right:0;">
                            <button class="btn m-0 p-0 mt-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalInfosPatient'><i class="bx bx-edit"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 280px;">
                <div class="col-12 p-2">
                    <div class="card space-profile text-center d-flex flex-column align-items-center pt-4 pb-3 px-3" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                        @foreach ($medecins as $key => $medecin)
                          <div onclick="setInfosConsult({{$key}})" class="card d-flex flex-row justify-content-between shadow-none rounded-1 mx-2 pt-3 px-3 pb-2 w-100 medecinParam" style="background-color:transparent; border-bottom: 0.3px solid rgba(128, 128, 128, 0.226);">
                            <div>{{ $medecin->nom }} {{ $medecin->prenom }}</div>
                            <div>{{ $services[$key]->nom }}</div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row pt-2" style="height: 360px;">
                <div class="col-12">
                    <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                        <h5 class="text-start ps-3" style="font-weight: 600">Parametres corporelles</h5>
                        <ul class="m-0 p-0 mx-4 pt-3" style="list-style: none">
                            <li class="d-flex justify-content-between">
                                <p>Temperature</p>
                                <h6 style="font-size: 1.05rem">{{ $parametres->temperature == 0 ? '--' : $parametres->temperature }}°C</h6>
                            </li>
                            <li class="d-flex justify-content-between pt-2">
                                <p>Tension</p>
                                <h6 style="font-size: 1.05rem">{{ $parametres->tension == 0 ? '--' : $parametres->tension }}</h6>
                            </li>
                            <li class="d-flex justify-content-between pt-2">
                                <p>Poids</p>
                                <h6 style="font-size: 1.05rem">{{ $parametres->poids == 0 ? '--' : $parametres->poids }}Kg</h6>
                            </li>
                            <li class="d-flex justify-content-between pt-2">
                                <p>Taille</p>
                                <h6 style="font-size: 1.05rem">{{ $parametres->taille == 0 ? '--' : $parametres->taille }}cm</h6>
                            </li>
                        </ul>
                        <div class="text-center m-0 p-0 my-3 mx-auto w-100" style="position: absolute; bottom:0;">
                            <button class="btn btn-outline-secondary mx-auto">Precedent</button>
                            <button class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#modalCenter">Mise a jour</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 150px;">
                <div class="col-12 py-2">
                    <div class="card space-profile text-start pt-4 pb-3 px-3" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                        <h6 class="text-center">Consultations</h6>
                        <h6 class="text-start ms-4 fw-bold" id="nomMedecin">Medecin</h6>
                        <h5 class="text-start ms-4 fw-bold" id="serviceMedecin">Nom du service</h5>
                    </div>
                </div>
            </div>
            <form action="{{ route('aide_soignant.enreg_parametres', ['idPatient' => $patient->id]) }}" method="post">
              @csrf
              <input type="text" name="type" value="2" class="d-none">
              <input type="text" id="typeMedecin" value="" name="medecin" class="d-none">
              <div class="row pb-3  w-100" style="height: auto;">
                  <button class="btn btn-primary w-100 m-3">Enregistrer</button>
              </div>
            </form>
        </div>
    </div>

</div>

{{-- Informations personnelles --}}
<form action="{{ route('aide_soignant.saveInfosPatient', ['idPatient' => $patient->id]) }}" method="post">
    <input type="text" name="type" value="0" class="d-none">
    <div class="modal fade modalExam" id="modalInfosPatient" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        
          @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Informations du patient</h5>
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
                <label for="nameWithTitle" class="form-label">Nom</label>
                <input
                  type="text"
                  class="form-control"
                  id="basic-icon-default-fullname"
                  placeholder="{{ $patient->nom }}"
                  value="{{ $patient->nom }}"
                  aria-label="Nom du personnel"
                  aria-describedby="basic-icon-default-fullname2"
                  name="nomPatient"
                />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="nameWithTitle" class="form-label">Prenom</label>
                <input
                  type="text"
                  class="form-control"
                  id="basic-icon-default-fullname"
                  placeholder="{{ $patient->prenom }}"
                  value="{{ $patient->prenom }}"
                  aria-label="Prenom du patient"
                  aria-describedby="basic-icon-default-fullname2"
                  name="prenomPatient"
                />
              </div>
            </div>
              <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                <label for="nameWithTitle" class="form-label">Sexe</label>
                <div class="form-check form-check-inline my-auto">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sexePatient"
                      id="inlineRadio1"
                      value="0"
                      {{ $patient->sexe == 0 ? 'checked' : '' }}
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
                      {{ $patient->sexe == 1 ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="inlineRadio2">Feminin</label>
                  </div>
                </div>
              </div>
              <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                <label for="nameWithTitle" class="form-label">Date de naissance</label>
                    <input
                      type="date"
                      class="form-control"
                      id="basic-icon-default-fullname"
                      value="{{ $patient->dateNaiss }}"
                      aria-label="Nom du personnel"
                      aria-describedby="basic-icon-default-fullname2"
                      name="dateNaissPatient"
                    />
                </div>
              </div>
              <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                <label for="nameWithTitle" class="form-label">Telephone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="basic-icon-default-fullname"
                      placeholder="{{ $patient->telephone == Null ? '' : $patient->telephone }}"
                      value="{{ $patient->telephone == Null ? '' : $patient->telephone }}"
                      aria-label="Numero"
                      aria-describedby="basic-icon-default-fullname2"
                      name="telPatient"
                    />
                </div>
              </div>
              <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                  <label for="nameWithTitle" class="form-label">Statut matrimonial</label>
                  <select class="form-select" id="kj" aria-label="Default select example" name="statutMatrimonialePatient">
                    <option value="0" {{ $patient->statutMatrimonial == 0 ? 'selected' : '' }}>Celebataire</option>
                    <option value="1" {{ $patient->statutMatrimonial == 1 ? 'selected' : '' }}>Marier</option>
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
  {{-- / Informations personnelles --}}

  {{-- Parametres --}}
<form action="{{ route('aide_soignant.enreg_parametres', ['idPatient' => $patient->id]) }}" method="post">
    <input type="text" name="type" value="1" class="d-none">
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        
          @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Nouvelles donnees</h5>
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
              <label for="nameWithTitle" class="form-label">Temperature</label>
              <input
                  type="text"
                  id="nameWithTitle"
                  class="form-control"
                  placeholder="Entrer la temperature"
                  name="temperature"
              />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
              <label for="emailWithTitle" class="form-label">Tension</label>
              <input
                  type="text"
                  id="emailWithTitle"
                  class="form-control"
                  placeholder="Entrer la tension"
                  name="tension"
              />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Poids</label>
                <input
                  type="text"
                  id="emailWithTitle"
                  class="form-control"
                  placeholder="Entrer le poids"
                  name="poids"
                />
              </div>
            </div>
            <div class="row g-md-2">
              <div class="col mb-0 text-start">
                <label for="dobWithTitle" class="form-label">Taille</label>
                <input
                  type="text"
                  id="dobWithTitle"
                  class="form-control"
                  placeholder="Entrer la taille"
                  name="taille"
                />
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
  {{-- / Parametres --}}

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script>
  let med = [];
  let services = [];
  @foreach ($medecins as $med)
    med.push("{{$med->nom}} {{$med->prenom}}");
  @endforeach

  @foreach ($services as $serv)
    services.push("{{$serv->nom}}");
  @endforeach
  function setInfosConsult(id){
    $('#nomMedecin').text(med[id]);
    $('#serviceMedecin').text(services[id]);
    $('#typeMedecin').val(id);
  }
</script>

@endsection
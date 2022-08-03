<?php
  use App\Models\Session;
  use App\Models\Type_consultation;
  use App\Models\Service;
  use App\Models\Consultation;
  use App\Models\Paiement;
  use App\Models\Personnel;
  use App\Models\Examen;
  use App\Models\Antecedent;
  
  $antecedents = Antecedent::where('patient_id', $patient->id)->get();
?>

@extends('medecin.layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y ps-0">

    {{-- <div class="row" style="height: 50vh; width: 100%; background-color:antiquewhite">

    </div>
    <div class="row" style="height: 50vh; width: 100%; background-color:blue">

    </div> --}}
    {{-- Best color rgba(255, 255, 255, 0.699) --}}
    <div class="row m-0 p-0" style="width: 100%; height: 110vh">
        <div class="col-md-8" style="height: 100%">
            <div class="row h-100" style="height: 100%">
              <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link active"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-home"
                      aria-controls="navs-pills-justified-home"
                      aria-selected="true"
                    >
                      <i class="tf-icons bx bx-home"></i> Consultations
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-profile"
                      aria-controls="navs-pills-justified-profile"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-user"></i> Examens
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-messages"
                      aria-controls="navs-pills-justified-messages"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-message-square"></i> Rendez-vous
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-hospi"
                      aria-controls="navs-pills-justified-hospi"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-message-square"></i> Hospitalisation
                    </button>
                  </li>
                </ul>
                <div class="w-100 p-2 d-flex justify-content-start rounded-3 mb-3 shadow-sm" style="background-color: white;">
                  <div class="navbar-nav align-items-center d-flex justify-content-start w-100">
                    <div class="nav-item d-flex align-items-center w-100">
                      <i class="bx bx-search fs-4 lh-0"></i>
                      <input
                        type="text"
                        class="form-control border-0 shadow-none w-100"
                        placeholder="Search..."
                        aria-label="Search..."
                        id="searchexam"
                        
                      />
                    </div>
                  </div>
                </div>
                <div class="tab-content p-0 p-3 rounded-3" style="height: 100%; background-color:white;">
                  <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    @foreach ($consultations as $row)
                    @foreach ($row as $consultation)
                    <?php
                      $session = Session::where('id', $consultation->session_id)->first();
                      // $type = Type_consultation::where('id', $session->type_consultation_id)->first();
                      $type_consultation = Type_consultation::where('id', $session->type_consultation_id)->first();
                      $service = Service::where('id', $type_consultation->service_id)->first();
                      
                      $personnel = Personnel::where('id', $consultation->personnel_id)->first();
                    ?>
                      <div class="card d-flex align-items-center flex-row justify-content-evenly py-3 px-4 mb-3" style="border-radius:10px; background-color:rgba(201, 201, 201, 0.05);">
                        <p class="p-0 m-0 me-auto">{{ $service->nom }}</p>
                        <p class="p-0 m-0 mx-auto">{{ $consultation->dateRealisation }}</p>
                        <p class="p-0 m-0 mx-auto">{{ $personnel->nom }}</p>
                        <div class="dropdown btn m-0 p-0 text-end align-items-center">
                          <button type="button" class="btn m-0 p-0 dropdown-toggle hide-arrow d-flex border-0 align-items-center" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded p-0 m-0"></i>
                          </button>
                          <div class="dropdown-menu py-1">
                            <a href="{{ route('global.profile_patient', ['idConsultation' => $consultation->id]) }}" class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
                              ></i><i class='bx bx-trash me-1'></i>Consulter</a
                            >
                            <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalShowResult'
                              ></i><i class='bx bx-trash me-1'></i>Resultat</button
                            >
                          </div>
                        </div>
                        <div class="modal fade modalExamDelete" id="modalShowResult" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
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
                                <div class="row g-md-2">
                                  <div class="col mb-0 text-start">
                                    <div class="row g-md-2 mb-4" id="resultatConsul">
                                      <label for="" class="form-label">Maladie :</label>
                                      <div class="col mb-0 text-start">
                                        <input
                                          type="text"
                                          class="form-control"
                                          id="resultatConsultation"
                                          name="resultatConsultation"
                                          value="{{ $consultation->resultat == Null ? '' : $consultation->resultat }}"
                                          disabled
                                        />
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    @endforeach
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    {{-- @foreach ($examenPrescrit as $examenPrescrit)
                      
                    @endforeach --}}
                    @foreach ($examensEff as $examenEff)
                    @if ($examenEff != Null)
                    <?php
                      $paie = Paiement::where('id', $examenEff->paiement_id)->first();
                      $nomExam = Examen::where('id', $paie->examen_id)->first()->nom;
                      $nomPersonnel = Personnel::where('id', $examenEff->personnel_id)->first()->nom;
                    ?>
                      <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                          <p class="p-0 m-0 me-auto">{{ $nomExam  }}</p>
                          <p class="p-0 m-0 mx-auto">{{ $examenEff->created_at->format('d/m/Y') }}</p>
                          <p class="p-0 m-0">{{ $nomPersonnel }}</p>
                      </div>
                    @endif
                    @endforeach
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                    @foreach ($rdvs as $rdv)
                    <?php
                      $tmp = Consultation::where('id', $rdv->consultation_id)->first()->personnel_id;
                      $nomPersonnel = Personnel::where('id', $tmp)->first()->nom;
                      $date=date_create("$rdv->date");
                    ?>
                      <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">{{ $nomPersonnel }}</p>
                        <p class="p-0 m-0 mx-auto">{{ $rdv->created_at->format('d/m/Y') }}</p>
                        <p class="p-0 m-0">{{  date_format($date, 'd/m/Y | h:i')}}</p>
                        <p class="p-0 m-0">{{ $rdv->etat == 1 ? 'Effectuer' : 'Non effectuer'}}</p>
                      </div>
                    @endforeach
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-hospi" role="tabpanel">
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        {{-- Color : #696cff --}}
        <div class="col-md-4 px-2" style="height: 100%; ">
            <div style="height: 100%; width:100%;">
                <div class="infosPerso pb-4 card" style="width:100%; border-radius: 20px; background-color:white;">
                    <div class="row p-0 m-0 d-flex justify-content-center text-center pt-3 pb-4 infosPersoFirst" style=" width:100%; background-color:#696cff;">
                        <div class="image rounded-pill align-items-center d-flex flex-column justify-content-center" style="height: 80px; width: 80px; background-color: white;">
                            <span class="bx bx-user my-auto" style="font-size: 2rem; color:#696cff;"></span> 
                          </div>
                          <div class="name pt-4">
                              <h5 class="mb-1 pb-0" style="font-weight: 600; color:white;">{{ $patient->nom }} {{ $patient->prenom }}</h5>
                              <a href="" class="bn m-0 " style="color: rgba(255, 255, 255, 0.39); width:auto; height:auto;">Envoyer un message</a>
                          </div>
                          <div class="name pt-2">
                              <p class="m-0 p-0" style="font-size: 0.85rem; color:white;">Prochain rendez-vous</p>
                              <h6 class="m-0 p-0 mt-1" style="font-weight: 600; color:white;">{{ count($rdvs) == 0 ? 'Aucun' : $rdvs[count($rdvs)]->date }}</h6>
                          </div>
                    </div>
                    <div class="row d-flex justify-content-center p-0 m-0" style=" width:100%;">
                        <div class="mt-2" style=" width:100%;">
                            <div class="row pb-3 pt-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143); color:rgb(143, 143, 143)">Date de naissance :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->dateNaiss == Null ? 'Inconnu' : $patient->dateNaiss }}</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Telephone :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->telephone == Null ? 'Inconnu' : $patient->telephone }}</strong></h6>
                                </div>
                            </div>
                            <div class="row pb-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Sexe :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->sexe == 1 ? 'Feminin' : 'Masculin' }}</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Adresse :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->adresse == Null ? 'Inconnu' : $patient->adresse }}</strong></h6>
                                </div>
                            </div>
                            <div class="row pb-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Statut matrimonial :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->statutMatrimonial == 0 ? 'Celibataire' : 'Marier' }}</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Enregistre le :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>{{ $patient->created_at->format('d/m/Y') }}</strong></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 p-0 pt-4 mt-3 card" style=" width:100%; border-radius: 20px; background-color:white;">
                    <h5 class="text-start ms-4" style="font-weight: 600; width:100%">Antecedents</h5>
                    <ul class="m-0 p-0 m-0 mb-5 px-3 pt-2" style="list-style: none">
                      @if ($antecedents != Null)
                      <?php 
                        $cptAnt = 0;
                      ?>
                        @foreach ($antecedents as $antecedent)
                          @if ($cptAnt < 3)
                            <?php
                              $cptAnt += 1;
                            ?>
                          <li class="mb-2 p-3" style="background-color: rgba(187, 187, 187, 0.199); border-radius:10px;">
                            <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent; ">
                              <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $antecedent->nom }}
                              </div>
                                <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent{{$antecedent->id}}'>
                                  <i class="bx bx-zoom-in"></i>
                                </button>
                            </div>
                          </li>
                          <div class="modal fade modalExam" id="modalAntecedent{{$antecedent->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCenterTitle">{{ $antecedent->nom }}</h5>
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
                                      <p>{{ $antecedent->description }}</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            
                            </div>
                          </div>
                          @endif
                        @endforeach
                        
                      @endif
                    </ul>
                    <div class="row test-end m-0 p-0 mt-4 pe-4 pb-3" style="width: auto; position:absolute; bottom:0; right:0;">
                      <button class="btn m-0 p-0" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalListeAntecedent'><i class="bx bx-bullseye"></i> Voir plus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modals --}}

{{-- Enregistrer Consultation --}}
{{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <input type="text" name="type" value="-1" class="d-none">
  <div class="modal fade modalExamDelete" id="modalSaveConsultation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Enregistrer</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row g-md-2">
          <div class="col mb-0 text-start">
            <h6>Voulez vous enregistrer les informations de la consultation ?</h6>
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
</form> --}}
{{-- / Enregistrer Consultation --}}

{{-- Informations personnelles --}}
{{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
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
</form> --}}
{{-- / Informations personnelles --}}

{{-- Parametres patient --}}
{{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  <input type="text" name="type" value="7" class="d-none">
  <div class="modal fade modalExam" id="modalParamsPatient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Parametres corporelles du patient</h5>
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
                class="form-control"
                id="basic-icon-default-fullname"
                placeholder="{{ $parametres->temperature }}"
                value="{{ $parametres->temperature }}"
                aria-label="Nom du personnel"
                aria-describedby="basic-icon-default-fullname2"
                name="temperaturePatient"
              />
            </div>
          </div>
          <div class="row g-md-2 mb-4">
            <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Tension</label>
              <input
                type="text"
                class="form-control"
                id="basic-icon-default-fullname"
                placeholder="{{ $parametres->tension }}"
                value="{{ $parametres->tension }}"
                aria-label="Prenom du patient"
                aria-describedby="basic-icon-default-fullname2"
                name="tensionPatient"
              />
            </div>
          </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Poids</label>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    placeholder="{{ $parametres->poids }}"
                    value="{{ $parametres->poids }}"
                    aria-label="Numero"
                    aria-describedby="basic-icon-default-fullname2"
                    name="poidsPatient"
                  />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
              <label for="nameWithTitle" class="form-label">Taille</label>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    placeholder="{{ $parametres->taille }}"
                    value="{{ $parametres->taille }}"
                    aria-label="Numero"
                    aria-describedby="basic-icon-default-fullname2"
                    name="taillePatient"
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
</form> --}}
{{-- / Parametres patient --}}

{{-- showAntecedent --}}
  {{-- <div class="modal fade modalExam" id="modalAntecedent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
  </div> --}}
{{-- / showAntecedent --}}

{{-- nouvelAntecedent --}}
  {{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
    <input type="text" name="type" value="2" class="d-none">
    <div class="modal fade modalExam" id="modalNewAntecedent" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        
          @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Antecedent</h5>
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
              <label for="nameWithTitle" class="form-label">Theme</label>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    placeholder="Theme"
                    aria-label="Theme"
                    aria-describedby="basic-icon-default-fullname2"
                    name="themeAntecedent"
                  />
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <textarea class="form-control" name="descriptionAntecedent" id="symptomes" cols="30" rows="10"></textarea>
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
  </form> --}}
{{-- / nouvelAntecedent --}}

{{-- Modifier hospitalisation --}}

{{-- @if ($prescription != Null)
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <input type="text" name="type" value="12" class="d-none">
  <?php
    $hospi = Hospitalisation::where('prescription_id', $prescription->id)->first();
  ?>
  @if ($hospi != Null)
    <?php
      $lit = Lit::where('id', $hospi->lit_id)->first();
      $salleHospi = Salle::where('id', $lit->salle_id)->first();
    ?>
  <div class="modal fade modalExam" id="modalModifHospi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Hospitalisation</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="row g-md-2">
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Salle d'hospitalisation</label>
                <select class="form-select" id="selectSalles" aria-label="Default select example" name="salleHospi" onchange="loadLit()">
                    <?php
                      $salles = Salle::orderBy('created_at', 'desc')->get();  
                    ?>
                    @foreach ($salles as $salle)
                      <option value="{{ $salle->id }}" {{ $salle->id == $salleHospi->id ? 'selected' : '' }}>{{ $salle->nom }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start" id="toi">
                
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Duree</label>
                <input
                  type="number"
                  class="form-control"
                  id="basic-icon-default-fullname"
                  placeholder="Nombre de jour"
                  aria-label="Nombre de jour"
                  aria-describedby="basic-icon-default-fullname2"
                  name="dureeHospi"
                  value="{{ $hospi->dureePrevue }}"
                  required
                />
              </div>
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
  @endif
</form>
@endif --}}

{{-- / Modifier hospitalisation --}}

{{-- showListeAntecedent --}}
<div class="modal fade modalExam" id="modalListeAntecedent" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Liste des antecedents</h5>
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
            <ul class="p-0 m-0 pt-1 pb-4" style="list-style: none">
              @if ($antecedents == Null)
              <li class="mb-2">
                <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                  <div class="text-start">
                    <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      Aucun antecedent
                    </p>
                  </div>
                </div>
              </li>
              @else
              <?php $cpt = 0;?>
                @foreach ($antecedents as $antecedent)
                  <?php
                    $cpt = $cpt + 1;
                  ?>
                  <li class="mb-3" style="border-bottom: solid 0.5px rgba(187, 187, 187, 0.418)">
                    <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent; ">
                      <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $antecedent->nom }}
                      </div>
                        <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent{{$antecedent->id}}'>
                          <i class="bx bx-zoom-in"></i>
                        </button>
                    </div>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</div>
{{-- / showListeAntecedent --}}

{{-- libererHospitalisation --}}
{{-- @if ($prescription != Null)
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <?php
    $libererHospiId = Hospitalisation::where('prescription_id', $prescription->id)->first();
  ?>
  @if ($libererHospiId != Null)
  <input type="text" name="type" value="10" class="d-none">
  <input type="text" name="libererHospiId" value="{{ $libererHospiId->id }}" class="d-none">
  <div class="modal fade modalExamDelete" id="modalLibererHospi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Liberer</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row g-md-2">
          <div class="col mb-0 text-start">
            <h6>Voulez vous vraiment liberer le patient ?</h6>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Annuler
        </button>
        <button type="submit" class="btn btn-primary">Supprimer</button>
      </div>
    </div>
  
  </div>
</div>
@endif
</form>
@endif --}}
{{-- / libererHospitalisation --}}

<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script>
  let f1 = $('div.newExamen');
  let f2 = $('div.newHospi');
  showField();
  loadLit();

  function showField(){
    if($('#selectPresType').val() == '1'){
      f1.removeClass('d-none');
      f2.addClass('d-none');
    }else{
      f1.addClass('d-none');
      f2.removeClass('d-none');
    }
  }

  function showOrdonnance(){
    $('div.presExamenListe').addClass('d-none');
    $('.examenTitle').addClass('d-none');
    $('div.presHospi').addClass('d-none');
    $('.hospitalisationTitle').addClass('d-none');
    $('div.presOrdonnanceListe').removeClass('d-none');
    $('.ordonnanceTitle').removeClass('d-none');
  }

  function showExamens(){
    $('div.presExamenListe').removeClass('d-none');
    $('.examenTitle').removeClass('d-none');
    $('div.presOrdonnanceListe').addClass('d-none');
    $('.ordonnanceTitle').addClass('d-none');
    $('div.presHospi').addClass('d-none');
    $('.hospitalisationTitle').addClass('d-none');
  }

  function showHospi(){
    $('div.presExamenListe').addClass('d-none');
    $('.examenTitle').addClass('d-none');
    $('div.presHospi').removeClass('d-none');
    $('.hospitalisationTitle').removeClass('d-none');
    $('div.presOrdonnanceListe').addClass('d-none');
    $('.ordonnanceTitle').addClass('d-none');
  }

  function loadLit(){
    $('#moi').load("/medecin/listLit/"+ $('#selectSalle').val() + "", function(){});
    $('#toi').load("/medecin/listLit/"+ $('#selectSalles').val() + "", function(){});
  }
</script>

@endsection
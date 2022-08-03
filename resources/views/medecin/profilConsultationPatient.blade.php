@extends('medecin.layouts.app')

@section('patient')
  active
@endsection

<?php

use App\Models\Prescription;
use App\Models\Examen_prescrit;
use App\Models\Examen;
use App\Models\Service;
use App\Models\Hospitalisation;
use App\Models\Salle;
use App\Models\Lit;
use App\Models\Rdv;
use App\Models\Maladie;
?>


<?php

$prescription = Prescription::where('consultation_id', $consultation->id)->first();
$rdv = Rdv::where('consultation_id', $consultation->id)->first();
$examensPrescrit = Null;
if($prescription != Null){
  $examensPrescrit = Examen_prescrit::where('prescription_id', $prescription->id)->get();
}

$prescriptionPrec = Null;
if($consultationPrec != Null){
  $prescriptionPrec = Prescription::where('consultation_id', $consultationPrec->id)->first();
}
$examenPrecritPrec = Null;
if($prescriptionPrec != Null){
  $examenPrecritPrec = Examen_prescrit::where('prescription_id', $prescriptionPrec->id)->get();
}

$maladies = Maladie::orderBy('created_at')->get();

if($rdv != Null){
  $date=date_create("$rdv->date");
  $rdvDate = date_format($date,"d/m/Y H:i");
}

?>

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
                    <div class="image rounded-pill align-items-center d-flex flex-column justify-content-center" style="height: 80px; width: 80px; background-color:#696cff">
                      <span class="bx bx-user my-auto" style="font-size: 2rem; color:white"></span>
                    </div>
                    <div class="name pt-4">
                        <h5 class="mb-1 pb-0" style="font-weight: 600">{{ $patient->nom }} {{ $patient->prenom }}</h5>
                        {{-- <a href="{{ route('global.sendSmsOne', ['idPatient' => $patient->id]) }}" class="bn m-0 " style="color: rgba(128, 128, 128, 0.39); width:auto; height:auto;">Envoyer un message</a> --}}
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
            <div class="col-md-5 p-2">
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
            <div class="col-md-4 p-2">
                <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="text-start ps-3" style="font-weight: 600">Parametres corporelles</h5>
                    <ul class="m-0 p-0 mx-4 pt-3" style="list-style: none">
                        <li class="d-flex justify-content-between">
                            <p>Temperature</p>
                            <h6 style="font-size: 1.05rem">{{ $parametres->temperature }}</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Tension</p>
                            <h6 style="font-size: 1.05rem">{{ $parametres->tension }}</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Poids</p>
                            <h6 style="font-size: 1.05rem">{{ $parametres->poids }}</h6>
                        </li>
                        <li class="d-flex justify-content-between">
                            <p>Taille</p>
                            <h6 style="font-size: 1.05rem">{{ $parametres->taille }}</h6>
                        </li>
                    </ul>
                    <div class="row test-end m-0 p-0 pe-4 pb-3" style="width: auto; position:absolute; bottom:0; right:0;">
                      <button class="btn m-0 p-0 mt-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalParamsPatient'><i class="bx bx-edit"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-0 ms-3 p-0" style="height: 350px;">
            <div class="col-md-4 p-2">
                <div class="card space-profile text-center d-flex flex-column align-items-center pt-4 pb-3" style="border-radius: 20px; height: 350px; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
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
                            <div class="text-start rounded-2" id="test-scroll" style="height: 140px; overflow-y: hidden;">
                              {{ $consultation->symptomes == Null ? 'Aucun symptomes' :  $consultation->symptomes}}
                            </div>
                            <div class="row test-end m-0 p-0 pe-4 pb-3" style="width: auto; position:absolute; bottom:0; right:0;">
                              <button class="btn m-0 p-0 mt-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalSymptomes'><i class="bx bx-edit"></i> Editer</button>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                            <ul class="p-0 m-0" style="list-style: none">
                              @if ($antecedents->count() == 0)
                                <li class="mb-3">
                                  <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent;">
                                    <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                      Aucun antecedent
                                    </div>
                                  </div>
                                </li>
                              @else
                              <?php $cpt = 0;?>
                                @foreach ($antecedents as $antecedent)
                                  @if ($cpt < 3)
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
                                  <div class="modal fade modalExam" id="modalAntecedent{{$antecedent->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="modalCenterTitle">{{ $antecedent->theme }}</h5>
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
                            <div class="row test-start m-0 p-0 d-flex justify-content-end pe-3 pb-3" style="width: 100%; position: absolute; bottom:0; right:0;">
                              <button class="btn m-0 p-0" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalListeAntecedent'><i class="bx bx-bullseye"></i> Voir plus</button>
                              <button class="btn m-0 p-0 ms-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalNewAntecedent'><i class="bx bx-edit"></i> Nouveau</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="card space-profile p-4" style="border-radius: 20px; height: 350px; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 p-0" style="font-weight: 600">Prescription</h5>
                    <div class="dropdown btn m-0 p-0 text-end">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu py-3">
                        <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalPrescription'
                          ></i><i class='bx bx-edit-alt me-1'></i>Nouveau</button
                        >
                        <button class="dropdown-item my-1 btn" onclick="showExamens()" style="text-decoration: none; cursor: pointer;"
                          ><i class="bx bi-file-ruled me-1"></i> Examen</button
                        >
                        <button class="dropdown-item my-1 btn" onclick="showOrdonnance()" style="text-decoration: none; cursor: pointer;" href=""
                          ><i class="bx bi-journal-text me-1"></i> Ordonnance</button
                        >
                        <button class="dropdown-item my-1 btn" onclick="showHospi()" style="text-decoration: none; cursor: pointer;"
                          ><i class="bx bi-heart-pulse me-1"></i> Hospitalisation</button
                        >
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="m-0 p-0 examenTitle" style="font-weight:600;">Examens</h6>
                    <h6 class="m-0 p-0 d-none ordonnanceTitle" style="font-weight:600;">Ordonnance</h6>
                    <h6 class="m-0 p-0 d-none hospitalisationTitle" style="font-weight:600;">Hospitalisation</h6>
                  </div>
                  <div class="presExamenListe">
                    <ul class="p-0 m-0 pt-1 pb-4" style="list-style: none">
                      @if ($examensPrescrit == Null)
                      <li class="mb-2">
                        <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                          <div class="text-start">
                            <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                              Aucun examen n'a ete prescrit
                            </p>
                          </div>
                        </div>
                      </li>
                      @else
                      <?php $cpt = 0;?>
                        @foreach ($examensPrescrit as $exam)
                         @if ($cpt < 3)
                         <?php
                            $examen = Examen::where('id', $exam->examen_id)->first();
                            $service = Service::where('id', $examen->service_id)->first();
                            $cpt = $cpt + 1;
                          ?>
                          <li class="mb-2">
                            <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0;{{$exam->dateRealisation == Null ? 'background-color:rgba(201, 201, 201, 0.103);' : 'background-color:#696cffcf; color:white;'}}">
                              <div class="text-start">
                                <p class="p-0 m-0" style="font-size: 0.85rem">{{ $service->nom }}</p>
                                <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 700;">
                                  {{ $examen->nom }}
                                </p>
                              </div>
                              <div class="dropdown btn m-0 p-0 text-end">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded" style="{{$exam->dateRealisation != Null ? 'color:white;' : ''}}"></i>
                                </button>
                                <div class="dropdown-menu py-1">
                                  <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalResultExam{{ $exam->id }}'
                                    ></i><i class='bx bi-file-earmark-text me-1'></i>Resultat</button
                                  >
                                  <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalEditExam{{ $exam->id }}'
                                    ></i><i class='bx bx-edit me-1'></i>Editer</button
                                  >
                                  <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalSupExam{{ $exam->id }}'
                                    ></i><i class='bx bx-trash me-1'></i>Supprimer</button
                                  >
                                </div>
                              </div>
                            </div>
                          </li>
                          <div class="modal fade" id="modalResultExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
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
                                      <h6>Resultat de l'examen</h6>
                                    </div>
                                  </div>
                                  <div class="row g-md-2 mb-4">
                                    <div class="col mb-0 text-start">
                                      <textarea class="form-control" name="resultatsExam" id="resultatsExam" cols="30" rows="10" disabled>{{ $exam->resultat != Null ? $exam->resultat : '' }}</textarea>
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
                          <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
                            @csrf
                            <input type="text" name="type" value="6" class="d-none">
                            <input type="text" name="examen_prescrit" value="{{ $exam->id }}" class="d-none">
                            <div class="modal fade modalExamDelete" id="modalSupExam{{ $exam->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCenterTitle">Supprimer</h5>
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
                                      <h6>Voulez vous supprimer cette examen ?</h6>
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
                        </form>
                          <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
                            @csrf
                            <input type="text" name="type" value="12" class="d-none">
                            <input type="text" name="examen_prescrit" value="{{ $exam->id }}" class="d-none">
                            <div class="modal fade modalExamDelete" id="modalEditExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Editer</h5>
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
                                        <h6>Entrer les resultats de l'examen (Optionnel)</h6>
                                      </div>
                                    </div>
                                    <div class="row g-md-2 mb-4">
                                      <div class="col mb-0 text-start">
                                        <textarea class="form-control" name="resultatsExam" id="resultatsExam" cols="30" rows="10">{{ $exam->resultat != Null ? $exam->resultat : '' }}</textarea>
                                      </div>
                                    </div>
                                    <p style="color: rgb(187, 187, 187)">L'examen sera considerer comme effetué si vous enregistré</p>
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
                         @endif
                        @endforeach
                      @endif
                    </ul>
                    <div class="row test-end m-0 p-0 py-2 pe-3 d-flex justify-content-end" style="width: 100%; position: absolute; bottom: 0;">
                      <button class="btn m-0 p-0 mb-2 me-4" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalShowExamenPrecedent'><i class="bx bx-bullseye"></i> precedent</button>
                      <button class="btn m-0 p-0 mb-2 me-4" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalShowExamen'><i class="bx bx-bullseye"></i> voir plus</button>
                    </div>
                  </div>
                  <div class="presOrdonnanceListe d-none" style="width: 100%">
                    @if ($prescription != Null)
                      <div class="text-start" id="test-scroll" style="height: 200px; overflow-y: hidden;">
                        {{ $prescription->ordonnance == Null ? 'Aucune ordonnance' :  $prescription->ordonnance}}
                      </div>
                    @else
                      <div class="text-start" id="test-scroll" style="height: 115px; overflow-y: hidden;">
                        Aucune Ordonnance
                      </div>
                    @endif
                      <button class="btn m-0 p-0 mb-2 me-4" style="width:auto; position: absolute; bottom 0; right: 0;" data-bs-toggle='modal' data-bs-target='#modalOrdonnance'><i class="bx bx-edit"></i> Editer</button>
                  </div>
                  <div class="presHospi d-none p-2" style="height: 60%; border-radius: 10px">
                    @if ($prescription != Null)
                      <?php
                        $hospi = Hospitalisation::where('prescription_id', $prescription->id)->first();
                      ?>
                      @if ($hospi != Null)
                       @if ($hospi->dureeRealisee < 0)
                        <?php
                          $lit = Lit::where('id', $hospi->lit_id)->first();
                          $salle = Salle::where('id', $lit->salle_id)->first();
                        ?>
                        <div class="text-start" id="test-scroll" style="height: 115px;">
                          <div class="card d-flex flex-row justify-content-between align-items-center py-1 mb-1 px-3" style="box-shadow: 0 0 0; background-color:#696cffcf; color:white;">
                            <div class="text-start">
                              <p class="p-0 m-0" style="font-size: 0.85rem">Salle :</p>
                              <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 700;">
                                {{ $salle->nom }}
                              </p>
                            </div>
                          </div>
                          <div class="card d-flex flex-row justify-content-between align-items-center py-1 mb-1 px-3" style="box-shadow: 0 0 0; background-color:#696cffcf; color:white;">
                            <div class="text-start">
                              <p class="p-0 m-0" style="font-size: 0.85rem">Lit :</p>
                              <p class="p-0 m-0 ms-auto" style="font-weight: 700;">
                                Lit {{ $lit->numero }}
                              </p>
                            </div>
                          </div>
                          <div class="card d-flex flex-row justify-content-between align-items-center py-1 mb-1 px-3" style="box-shadow: 0 0 0; background-color:#696cffcf; color:white;">
                            <div class="text-start">
                              <p class="p-0 m-0" style="font-size: 0.85rem">Duree :</p>
                              <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 700;">
                                {{ $hospi->dureePrevue }}
                              </p>
                            </div>
                          </div>
                          {{-- <div class="row m-0 p-0 mb-2 d-flex flex-row align-items-center">
                            <p class="m-0 p-0" style="font-size: 0.85rem">Salle : </p>
                            <p class="m-0 p-0" style="font-size: 1.05rem; font-weight:600;">{{ $salle->nom }}</p>
                          </div>
                          <div class="row m-0 p-0 mb-2">
                            <p class="m-0 p-0" style="font-size: 0.85rem">Lit : </p>
                            <p class="m-0 p-0" style="font-size: 1.05rem; font-weight:600;">Lit {{ $lit->numero }}</p>
                          </div>
                          <div class="row m-0 p-0 mb-2">
                            <p class="m-0 p-0" style="font-size: 0.85rem">Duree : </p>
                            <p class="m-0 p-0" style="font-size: 1.05rem; font-weight:600;">{{ $hospi->dureePrevue }} jours</p>
                          </div> --}}
                        </div>
                        <div class="row test-start m-0 p-0 mb-3" style="width: 100%; position: absolute; bottom: 0;">
                          <button class="btn m-0 p-0" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalModifHospi'><i class="bx bx-edit"></i> Modifier</button>
                          <button class="btn m-0 p-0 ms-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalDeleteHospi'><i class="bx bx-edit"></i> Supprimer</button>
                          <button class="btn m-0 p-0 ms-2" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalLibererHospi'><i class="bx bx-edit"></i> Liberer</button>
                        </div>
                        @else
                          <div class="text-start" id="test-scroll" style="height: 115px; overflow-y: hidden;">
                            Le patient a ete liberé
                          </div>
                        @endif
                      @else
                        <div class="text-start" id="test-scroll" style="height: 115px; overflow-y: hidden;">
                          Aucune Hospitalisation
                        </div>
                      @endif
                    @else
                      <div class="text-start" id="test-scroll" style="height: 115px; overflow-y: hidden;">
                        Aucune Hospitalisation
                      </div>
                    @endif
                  </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="row m-0 p-0 pb-3" style="height: auto">
                  <div class="card space-profile py-3 d-flex flex-row justify-content-start" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <button class="btn btn-icon btn-primary btn-xl m-0" style="cursor:default"><span class="bx bx-user" style="font-size: 2rem"></span></button>
                    <div class="m-0 ms-3">
                      <p class="m-0">Etat du patient</p>
                      <?php
                        $etatPatient = 'Aucun';
                        if($consultation->etat == 0){
                          $etatPatient = 'Aucun';
                        }else if($consultation->etat == 1){
                          $etatPatient = 'Suivit';
                        }else{
                          $etatPatient = 'Hospitalisee';
                        }
                      ?>
                      <p class="m-0" style="font-size: 1.15rem; font-weight: bold">{{ $etatPatient }}</p>
                    </div>
                    <button class="btn m-0 p-0 mt-2 ms-auto" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalSetEtat'><i class="bx bx-edit"></i></button>
                  </div>
                </div>
                <div class="row m-0 p-0" style="height: 50%">
                  <div class="card space-profile pt-4" style="border-radius: 20px; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.87);">
                    <h5 class="text-start" style="font-weight: 600">Notes</h5>
                    <div class="row m-0 p-0">
                      <div class="text-start m-0 p-0 btn" style="height: 50px; overflow-y: hidden; font-size: 0.9rem">
                        {{ $consultation->notes == Null ? 'Aucune note' : $consultation->notes }}
                      </div>
                      <div class="row test-start m-0 p-0 mt-2" style="width: 100%">
                        <button class="btn m-0 p-0" style="width:auto;" data-bs-toggle='modal' data-bs-target='#modalNotes'><i class="bx bx-edit"></i> Editer</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row m-0 p-0 pt-3 px-2 d-flex flex-row justify-content-between" style="height: auto">
                  <div class="m-0 p-0 pe-1" style="width: 60%">
                    <a href="{{ route('global.dossierPatient.show', ['idPatient' => $patient->id]) }}" class="btn btn-primary m-0" style="width: 100%">Dossier patient</a>
                  </div>
                  <div class="m-0 p-0 ps-1" style="width: 40%">
                    <a href="" class="btn btn-primary m-0" style="width: 100%" data-bs-toggle='modal' data-bs-target='#modalSaveConsultation'>Resultat</a>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Modals --}}

{{-- Enregistrer Consultation --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <input type="text" name="type" value="-1" class="d-none">
  <div class="modal fade modalExamDelete" id="modalSaveConsultation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
              <h6>Avez vous diagnostique une maladie ?</h6>
              <div class="row g-md-2 mb-4">
                <div class="col mb-0 text-start">
                <div class="form-check form-check-inline my-auto">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sexePatient"
                      id="result"
                      value="1"
                      onclick="setResult()"
                    />
                    <label class="form-check-label" for="inlineRadio1">Oui</label>
                  </div>
                  <div class="form-check form-check-inline my-auto">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="sexePatient"
                      id="notResult"
                      value="0"
                      onclick="removeResult()"
                      checked
                    />
                    <label class="form-check-label" for="inlineRadio2">Non</label>
                  </div>
                </div>
              </div>
              <div class="row g-md-2 mb-4 mt-3 d-none" id="resultatConsul">
                <label for="" class="form-label">Maladie :</label>
                {{-- <button type="button" class="btn" onclick="addField()">plus</button> --}}
                <div class="resultField">
                  <div class="col mb-0 text-start">
                    <input
                    type="text"
                    class="form-control"
                    id="resultatConsultation"
                    name="resultatConsultation"
                    value=""
                    oninput="loadMaladies()"
                    />
                  </div>
                </div>
              </div>
              <div class="d-none" id="listeMaladies"></div>
              <h6 class="mt-3">Voulez vous enregistrer les informations de la consultation ?</h6>
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
{{-- / Enregistrer Consultation --}}

{{-- Informations personnelles --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
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

{{-- Parametres patient --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
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
</form>
{{-- / Parametres patient --}}


{{-- Symptomes --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
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
              <textarea class="form-control" name="symptomes" id="symptomes" cols="30" rows="10">{{ $consultation->symptomes != Null ? $consultation->symptomes : '' }}</textarea>
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

{{-- showAntecedent --}}
  <div class="modal fade modalExam" id="modalAntecedent" tabindex="-1" aria-hidden="true">
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
  </div>
{{-- / showAntecedent --}}

{{-- nouvelAntecedent --}}
  <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
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
  </form>
{{-- / nouvelAntecedent --}}

{{-- Prescription --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <input type="text" name="type" value="3" class="d-none">
  <div class="modal fade" id="modalPrescription" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
              <select class="form-select" id="selectPresType" onchange="showField()" name="prescriptionType">
                  <option value="1" selected>Examen</option>
                  <option value="2">Hospitalisation</option>
              </select>
            </div>
          </div>
          <div class="row g-md-2 mb-4 newExamen">
            <div class="nav-item d-flex align-items-center w-100">
              <i class="bx bx-search fs-4 lh-0"></i>
              <input
                type="text"
                class="form-control border-0 shadow-none w-100"
                placeholder="Search..."
                aria-label="Search..."
                id="searchExamPrescription"
                oninput="refreshListExam()"
              />
            </div>
            <div class="col mb-0 text-start" id="listExamPrescription">
              <?php
                $examens = Examen::orderBy('nom')->get();  
              ?>
              @if ($examens != Null)
                @foreach ($examens as $examen)
                <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start">
                  <input
                    name="examenVal[]"
                    class="form-check-input check"
                    type="checkbox"
                    value="{{ $examen->id }}"
                  />
                  <span class="ms-3">{{ $examen->nom }}</span></td>
                </div>
                @endforeach
              @endif
            </div>
          </div>
          <div class="row g-md-2 newHospi d-none">
            {{-- <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start">
                <label for="emailWithTitle" class="form-label">Salle d'hospitalisation</label>
                <select class="form-select" id="selectSalle" aria-label="Default select example" name="salleHospi" onchange="loadLit()">
                    <?php
                      // $salles = Salle::orderBy('created_at', 'desc')->get();  
                    ?>
                    @foreach ($salles as $salle)
                      <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="row g-md-2 mb-4">
              <div class="col mb-0 text-start" id="moi">
                
              </div>
            </div> --}}
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
                  value="10"
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
</form>
{{-- / Prescription --}}

{{-- Modifier hospitalisation --}}

@if ($prescription != Null)
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
@endif

{{-- / Modifier hospitalisation --}}

{{-- Notes --}}

<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  <input type="text" name="type" value="4" class="d-none">
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
              <textarea class="form-control" name="notes" id="notes" cols="30" rows="10">{{ $consultation->notes == Null ? '' : $consultation->notes }}</textarea>
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

{{-- Ordonnance --}}
@if ($prescription != Null)
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  <input type="text" name="type" value="5" class="d-none">
  <div class="modal fade modalExam" id="modalOrdonnance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Ordonnance</h5>
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
              <textarea class="form-control" name="ordonnance" id="ordonnance" cols="30" rows="10">{{ $prescription->ordonnance == Null ? '' : $prescription->ordonnance }}</textarea>
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
@endif
{{-- / Ordonnance --}}

{{-- showExamen --}}
<div class="modal fade modalExam" id="modalShowExamen" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Examens prescrits</h5>
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
              @if ($examensPrescrit == Null)
              <li class="mb-2">
                <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                  <div class="text-start">
                    <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      Aucun examen n'a ete prescrit
                    </p>
                  </div>
                </div>
              </li>
              @else
              <?php $cpt = 0;?>
                @foreach ($examensPrescrit as $exam)
                  <?php
                    $examen = Examen::where('id', $exam->examen_id)->first();
                    $service = Service::where('id', $examen->service_id)->first();
                    $cpt = $cpt + 1;
                  ?>
                  <li class="mb-2">
                    <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                      <div class="text-start">
                        <p class="p-0 m-0" style="font-size: 0.85rem">{{ $service->nom }}</p>
                        <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                          {{ $examen->nom }}
                        </p>
                      </div>
                      <div class="dropdown btn m-0 p-0 text-end">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded" style="{{$examen->dateRealisation != Null ? 'color:white;' : ''}}"></i>
                        </button>
                        <div class="dropdown-menu py-1">
                          <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalResultExam{{ $examen->id }}'
                            ></i><i class='bx bi-file-earmark-text me-1'></i>Resultat</button
                          >
                          <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalEditExam{{ $examen->id }}'
                            ></i><i class='bx bx-edit me-1'></i>Editer</button
                          >
                          <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalDeleteExam{{ $examen->id }}'
                            ></i><i class='bx bx-trash me-1'></i>Supprimer</button
                          >
                        </div>
                      </div>
                    </div>
                  </li>
                  <div class="modal fade" id="modalResultExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
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
                              <h6>Resultat de l'examen</h6>
                            </div>
                          </div>
                          <div class="row g-md-2 mb-4">
                            <div class="col mb-0 text-start">
                              <textarea class="form-control" name="resultatsExam" id="resultatsExam" cols="30" rows="10" disabled>{{ $exam->resultat != Null ? $exam->resultat : '' }}</textarea>
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
                  {{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
                    @csrf
                    <input type="text" name="type" value="6" class="d-none">
                    <input type="text" name="examen_prescrit" value="{{ $exam->id }}" class="d-none">
                    <div class="modal fade modalExamDelete" id="modalDeleteExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalCenterTitle">Supprimer</h5>
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
                              <h6>Voulez vous supprimer cette examen ?</h6>
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
                  </div> --}}
                  <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
                    @csrf
                    <input type="text" name="type" value="12" class="d-none">
                    <input type="text" name="examen_prescrit" value="{{ $exam->id }}" class="d-none">
                    <div class="modal fade modalExamDelete" id="modalEditExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Editer</h5>
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
                                <h6>Entrer les resultats de l'examen (Optionnel)</h6>
                              </div>
                            </div>
                            <div class="row g-md-2 mb-4">
                              <div class="col mb-0 text-start">
                                <textarea class="form-control" name="resultatsExam" id="resultatsExam" cols="30" rows="10">{{ $exam->resultat != Null ? $exam->resultat : '' }}</textarea>
                              </div>
                            </div>
                            <p style="color: rgb(187, 187, 187)">L'examen sera considerer comme effectué si vous enregistré</p>
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
                @endforeach
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</div>
{{-- / showExamen --}}

{{-- showExamenPrec --}}
<div class="modal fade modalExam" id="modalShowExamenPrecedent" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Examens prescrits</h5>
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
              @if ($examenPrecritPrec == Null)
              <li class="mb-2">
                <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; background-color:rgba(201, 201, 201, 0.103);">
                  <div class="text-start">
                    <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      Aucun examen n'a ete prescrit auparavant
                    </p>
                  </div>
                </div>
              </li>
              @else
              <?php $cpt = 0;?>
                @foreach ($examenPrecritPrec as $exam)
                  <?php
                    $examen = Examen::where('id', $exam->examen_id)->first();
                    $service = Service::where('id', $examen->service_id)->first();
                    $cpt = $cpt + 1;
                  ?>
                  <li class="mb-2">
                    <div class="card d-flex flex-row justify-content-between align-items-center py-2 px-3" style="box-shadow: 0 0 0; {{$exam->dateRealisation == Null ? 'background-color:rgba(201, 201, 201, 0.103);' : 'background-color:#696cffcf; color:white;'}}">
                      <div class="text-start">
                        <p class="p-0 m-0" style="font-size: 0.85rem">{{ $service->nom }}</p>
                        <p class="text-start p-0 m-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                          {{ $examen->nom }}
                        </p>
                      </div>
                      <div class="dropdown btn m-0 p-0 text-end">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded" style="{{$examen->dateRealisation != Null ? 'color:white;' : ''}}"></i>
                        </button>
                        <div class="dropdown-menu py-1">
                          <button class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalDeleteExam{{ $examen->id }}'
                            ></i><i class='bx bx-trash me-1'></i>Resultat</button
                          >
                        </div>
                      </div>
                    </div>
                  </li>
                  {{-- <form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
                    @csrf
                    <input type="text" name="type" value="6" class="d-none">
                    <input type="text" name="examen_prescrit" value="{{ $exam->id }}" class="d-none">
                    <div class="modal fade modalExamDelete" id="modalDeleteExam{{ $examen->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalCenterTitle">Supprimer</h5>
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
                              <h6>Voulez vous supprimer cette examen ?</h6>
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
                  </form> --}}
                @endforeach
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  
  </div>
</div>
{{-- / showExamenPrec --}}

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
                        {{ $antecedent->theme }}
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

{{-- setEtatPatient --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  <input type="text" name="type" value="8" class="d-none">
  <div class="modal fade modalExam" id="modalSetEtat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Etat du patient</h5>
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
              @if ($consultation->etat == 0 || $consultation->etat == 1)
                <div class="card p-3 mb-2 d-flex flex-row align-items-center justify-content-start">
                  <input
                    name="etatPatient"
                    class="form-check-input check"
                    type="Radio"
                    value="0"
                    {{ $consultation->etat == 0 ? 'checked' : '' }}
                  />
                  <span class="ms-3">Ancun</span></td>
                </div>
                <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start">
                  <input
                    name="etatPatient"
                    class="form-check-input check"
                    type="Radio"
                    value="1"
                    {{ $consultation->etat == 1 ? 'checked' : '' }}
                  />
                  <span class="ms-3">Suivit</span></td>
                </div>
              @else
                <p>Supprimer l'hospitalisation pour changer l'etat du patient</p>
              @endif
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
{{-- / setEtatPatient --}}

{{-- supprimerHospitalisation --}}
@if ($prescription != Null)
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  @csrf
  <?php
    $deleteHospiId = Hospitalisation::where('prescription_id', $prescription->id)->first();
  ?>
  @if ($deleteHospiId != Null)
  <input type="text" name="type" value="9" class="d-none">
  <input type="text" name="deleteHospiId" value="{{ $deleteHospiId->id }}" class="d-none">
  <div class="modal fade modalExamDelete" id="modalDeleteHospi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Supprimer</h5>
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
            <h6>Voulez vous supprimer l'hospitalisation ?</h6>
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
@endif
{{-- / supprimerHospitalisation --}}

{{-- libererHospitalisation --}}
@if ($prescription != Null)
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
@endif
{{-- / libererHospitalisation --}}

{{-- Rendez vous --}}
<form action="{{ route('medecin.saveConsultation', ['idConsultation' => $consultation->id]) }}" method="post">
  <input type="text" name="type" value="11" class="d-none">
  <div class="modal fade modalExam" id="modalRdv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Rendez vous</h5>
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
              <input
                    type="datetime-local"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    value="{{ $rdv == Null ? '' : $rdv->date }}"
                    aria-label="Nom du personnel"
                    aria-describedby="basic-icon-default-fullname2"
                    name="dateRdv"
                  />  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Annuler
          </button>
          <button type="submit" name="deleteRdv" class="btn btn-outline-secondary">Supprimer</button>
          <button type="submit" name="saveRdv" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    
    </div>
  </div>
</form>
{{-- / Rendez vous --}}
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script>
  let f1 = $('div.newExamen');
  let f2 = $('div.newHospi');
  let state = 0;
  let state2 = 0;
  let maladies = [];
  let tx = [];
  let result = document.getElementById('resultatConsultation');
  let etatRes = 0;
  showField();
  loadLit();

  function setResult(){
    $('#resultatConsul').removeClass('d-none')
  }

  function removeResult(){
    $('#resultatConsul').addClass('d-none')
  }

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

  function addField(){
    const element = document.getElementById("resultField");
    const elt = document.createElement("p");
    element.appendChild(elt);
    elt.innerHTML = "salut";
    // elt.innerHTML = "<input type='text' class='form-control' id='resultatConsultation' name='resultatConsultation' oninput='loadMaladies()'/>";
  }

  function loadLit(){
    $('#moi').load("/medecin/listLit/"+ $('#selectSalle').val() + "", function(){});
    $('#toi').load("/medecin/listLit/"+ $('#selectSalles').val() + "", function(){});
  }
  refreshListExam();
  setInterval(() => {
    if($('#searchExamPrescription').val() == ''){
      if(state == 0){
        $('#listExamPrescription').load("/medecin/listExamensPrescriptions/10", function(){});
        state = 1;
      }
    }
    if($('#resultatConsultation').val() == ''){
      if(state2 == 0){
        $('#listeMaladies').addClass('d-none');
        state2 = 1;
      }
    }
  }, 100);

  @foreach ($maladies as $maladie)
    maladies.push("{{$maladie->nom}}");
  @endforeach

  function setMaladie(id){
    let text = $('#resultatConsultation').val();
    let res = $('#resultatConsultation').val();
    if(res.search(maladies[id-1]) == -1){
      if(etatRes != 0){
        let valTmp = res.substr(0, res.lastIndexOf(',')+1);
        $('#resultatConsultation').val(valTmp + maladies[id-1]+', ');
      }else{
        $('#resultatConsultation').val(maladies[id-1]+', ');
      }
      $('#listeMaladies').addClass('d-none');
    }
  }

  function loadMaladies(){
    // resultatConsultation
    let value = "";
    let res = $('#resultatConsultation').val();
    if(res.lastIndexOf(',') != -1){
      let fin = res.replace(' ', '');
      value = fin.substr(res.lastIndexOf(',')+1);
      etatRes = 1;
    }else{
      value = $('#resultatConsultation').val();
      etatRes = 0;
    }
    state2 = 0;
    // $('#listeMaladies').removeClass('d-none');
    // $('#listeMaladies').load("/medecin/listeMaladies/" + $('#resultatConsultation').val(), function(){});
    $('#listeMaladies').removeClass('d-none');
    $('#listeMaladies').load("/medecin/listeMaladies/" + value, function(){});
  }

  function refreshListExam(){
    state = 0;
    $('#listExamPrescription').load("/medecin/listExamensPrescriptions/" + $('#searchExamPrescription').val(), function(){});
  }

  setInterval(() => {
        // refresh();
        verify();
      }, 100);

    function verify(){
        let table = document.querySelectorAll('input[name="examenVal[]"]');
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
        let elmt = document.querySelectorAll('input[name="examenVal[]"]');
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
        let elmt = document.querySelectorAll('input[name="examenVal[]"]');
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
</script>

@endsection
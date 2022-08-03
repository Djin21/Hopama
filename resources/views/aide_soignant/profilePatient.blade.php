@extends('aide_soignant.layouts.app')

@section('content')

<?php 

use App\Models\Examen;
use App\Models\Service;
use App\Models\Personnel;
use App\Models\Consultation;
use App\Models\Type_consultation;
use App\Models\Session;

$sexe = $patient->sexe == 1 ? 'Feminin' : 'Masculin';
$session = Session::where('patient_id', $patient->id)->latest()->first();
$consultations = Consultation::where('session_id', $session->id)->get();
// dd($consultations);
// dd($consultations);
// $medecins = Personnel::where('service_id', Type_consultation::where('id', $session->type_consultation_id)->first()->service_id)->get();
$medecins = Personnel::all();
// $examensId = Paiement::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get();
// $medecins = Personnel::where('service_id', Service::where('nom', 'LIKE', '%medecine%')->firstOrFail()->id)->get();
// $medecins = Personnel::all();
// $services = Service::where("nom", "LIKE", "%medecine%")->get();
// dd($medecins);

?>

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Profile du patient</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl row">
            <div class="col-md-9 ps-2">
                <div class="card mb-2">
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../../assets/img/avatars/1.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <!-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> -->
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstName"
                              value="{{ $patient->nom }}"
                              placeholder="{{ $patient->nom }}"
                              disabled
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Prenom</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="{{ $patient->prenom }}" placeholder="{{ $patient->prenom }}" disabled/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value=""
                              placeholder=""
                              disabled
                            />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Sexe</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="organization"
                              value="{{ $sexe }}"
                              placeholder="{{ $sexe }}"
                              disabled
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Telephone</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                                placeholder="{{ $patient->telephone }}"
                                disabled
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="{{ $patient->habitation }}" disabled />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Modifier</button>
                          <button type="reset" class="btn btn-outline-secondary d-none">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
            <div class="col-md-3 ps-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title" style="font-size: 1.15rem;">Dernieres donnees</div>
                        <div class="mt-4 text-center">
                            <ul class="params-list p-0">
                                <li class="params-item d-flex justify-content-between align-items-center">
                                    <p class="params-item-type" style="font-weight: 600;">Temperature:</p>
                                    <p class="params-item-value">{{ $parametres->temperature == 0 ? '--' : $parametres->temperature }}°C</p>
                                </li>
                                <li class="params-item d-flex justify-content-between align-items-center">
                                    <p class="params-item-type" style="font-weight: 600;">Tension:</p>
                                    <p class="params-item-value">{{ $parametres->tension == 0 ? '--' : $parametres->tension }}°C</p>
                                </li>
                                <li class="params-item d-flex justify-content-between align-items-center">
                                    <p class="params-item-type" style="font-weight: 600;">Poids:</p>
                                    <p class="params-item-value">{{ $parametres->poids == 0 ? '--' : $parametres->poids }}Kg</p>
                                </li>
                                <li class="params-item d-flex justify-content-between align-items-center">
                                    <p class="params-item-type" style="font-weight: 600;">Taille:</p>
                                    <p class="params-item-value">{{ $parametres->taille == 0 ? '--' : $parametres->taille }}cm</p>
                                </li>
                            </ul>
                            <p>Date : {{ $parametres->created_at->format('d/m/Y') }}</p>
                            <button type="submit" class="btn mb-2" style="width: auto; background-color: white; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.089);">Voir plus</button>
                            <button type="submit" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#modalCenter">Mises a jour</button>
                            <form action="{{ route('aide_soignant.profile_patient', ['idPatient' => $patient->id]) }}" method="post">
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
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="card-title" style="font-size: 1.15rem;">Etat</div> -->
                        <div class="text-center py-0 my-0 d-flex justify-content-between align-items-center">
                          <p class="params-item-type my-auto" style="font-weight: 600;">Etat</p>
                          <p class="badge bg-warning params-item-type my-auto">Suivit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl row">
            <h5 class="card-header">Consultations</h5>
            <div class="card mb-2">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                      <tr class="d-flex justify-content-between">
                        <td>Nom du medecin</td>
                        <td class="text-center">Date de realisation</td>
                        <td class="">Statut</td>
                      </tr>
                  </table>
                </div>
            </div>
            <div class="card mb-2">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  @if($consultations != Null)
                  @foreach ($consultations as $consultation)
                    <?php
                      $personnel = Personnel::where('id', $consultation->personnel_id)->first();
                    ?>
                    <tr class="d-flex justify-content-between">
                      <td>{{ $personnel->nom }}</td>
                      <td class="text-center">{{ $consultation->dateRealisation == Null ? 'En attente' :  $consultation->dateRealisation->format("Y/m/d | H:i:s")}}</td>
                      <td class="">{{ $consultation->etat == Null ? 'En attente' :  $consultation->etat}}</td>
                    </tr>
                  @endforeach
                  @endif
                </table>
              </div>
          </div>
            <button type="submit" class="btn btn-primary ms-auto mt-2" data-bs-toggle="modal" data-bs-target="#defineConsulationModal" style="width: auto;">Nouvelle consultation</button>
            <button type="submit" class="btn ms-2 mt-2" style="width: auto; background-color: white; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.089);" data-bs-toggle="modal" data-bs-target="#listConsulationModal">Voir plus</button>
            <form action="{{ route('aide_soignant.profile_patient', ['idPatient' => $patient->id]) }}" method="post">
              <div class="modal fade" id="defineConsulationModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      @csrf
                      <input type="text" name="type" value="2" class="d-none">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="defineConsulationModalTitle">Nouvelle consultation</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <div class="row g-md-2 mb-4">
                          @foreach ($medecins as $medecin)
                          <?php
                            $consultationsEnCours = Consultation::where('personnel_id', $medecin->id)->where('dateRealisation', Null)->get()->count();
                            // $consultationsEnCours = Proceder::where('etat', 2)->where('personnel_id', $medecin->id)->get()->count();
                            // $t = Proceder::->where('etat', 2)->where('personnel_id', $medecin->id)->where('paiement_id', Paiement::where('patient_id', $patient->id)->where('examen_id', Examen::where('nom', 'Consultation')->firstOrFail()->id)->firstOrFail()->id)->get()->count();
                          ?>
                          <div class="card mb-2">
                            <div class="table-responsive text-nowrap">
                              <table class="table">
                                  <tr class="d-flex justify-content-between">
                                    <td>
                                      <input
                                        name="medecin"
                                        class="form-check-input check"
                                        type="radio"
                                        value="{{ $medecin->id }}"
                                      />
                                      <span class="ms-3">{{ $medecin->nom }} {{ $medecin->prenom }}</span>
                                    </td>
                                    <td><span class="badge bg-info rounded-pill">{{ $consultationsEnCours }}</span></td>
                                  </tr>
                              </table>
                            </div>
                          </div>
                          <input type="text" name="session" value="{{ $session->id }}" class="d-none">
                          @endforeach
                          
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
              <div class="modal fade" id="listConsulationModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    @csrf
                    <input type="text" name="type" value="2" class="d-none">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="listConsulationModalTitle">Consultations</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-md-2 mb-4">
                        <div class="mb-2">
                            <div class="table-responsive text-nowrap">
                              <table class="table">
                                  <tr class="d-flex justify-content-start">
                                    <td>Nom du medecin</td>
                                    <td class="mx-auto">Date de passage</td>
                                    <td class="ms-auto">Statut</td>
                                  </tr>
                              </table>
                            </div>
                        </div>
                        @if ($consultations != Null)
                        @foreach ($consultations as $consultation)
                        <?php
                          $etat = 'Aucun';
                           if($consultation->etat == 1){
                            $etat = 'Suivit';
                           }elseif ($consultation->etat == 2) {
                              $etat = 'Hospitalisee';
                           }
                          // $examen = Examen::where('id', $id->examen_id)->firstOrFail();
                        ?>
                        <div class="card mb-2">
                          <div class="table-responsive text-nowrap">
                            <table class="table">
                                <tr class="d-flex justify-content-start">
                                  <td>{{ $consultation->personnel_id }}</td>
                                  <td class="mx-auto">{{ $consultation->dateRealisation }}</td>
                                  <td class="ms-auto">{{ $etat }}</td>
                                </tr>
                            </table>
                          </div>
                        </div>
                      @endforeach
                      @endif
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
          </div>
        {{-- <div class="col-xxl row">
          <h5 class="card-header">Examens</h5>
          <div class="card mb-2">
              <div class="table-responsive text-nowrap">
                <table class="table">
                    <tr class="d-flex justify-content-between">
                      <td>Nom de l'examen</td>
                      <td>Date</td>
                      <td>Nom du personnel</td>
                    </tr>
                </table>
              </div>
          </div>
          <div class="card mb-2">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  @foreach ($examensId as $id)
                    <?php
                      // $examen = Examen::where('id', $id->examen_id)->firstOrFail();
                    ?>
                    @if ($examen->nom != 'Consultation')
                    <tr class="d-flex justify-content-between">
                      <td>{{ $examen->nom }}</td>
                      <td>{{ $id->created_at }}</td>
                      <td>Nom du personnel</td>
                    </tr>
                    @endif
                  @endforeach
                </table>
              </div>
          </div>
          <button type="submit" class="btn ms-auto mt-2" style="width: auto; background-color: white; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.089);" data-bs-toggle="modal" data-bs-target="#listExamenModal">Voir plus</button>
          <div class="modal fade" id="listExamenModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              
                @csrf
                <input type="text" name="type" value="2" class="d-none">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="listExamenModalTitle">Consultations</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="row g-md-2 mb-4">
                    <div class="mb-2">
                        <div class="table-responsive text-nowrap">
                          <table class="table">
                              <tr class="d-flex justify-content-start">
                                <td>Nom de l'examen</td>
                                <td class="mx-auto">Date</td>
                                <td class="ms-auto">Nom du personnel</td>
                              </tr>
                          </table>
                        </div>
                    </div>
                    @foreach ($examensId as $id)
                    <?php
                      // $examen = Examen::where('id', $id->examen_id)->firstOrFail();
                    ?>
                    @if ($examen->nom != 'Consultation')
                    <div class="card mb-2">
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tr class="d-flex justify-content-start">
                              <td>{{ $examen->nom }}</td>
                              <td class="mx-auto">{{ $id->created_at }}</td>
                              <td class="ms-auto">Nom du personnel</td>
                            </tr>
                        </table>
                      </div>
                    </div>
                    @endif
                  @endforeach
                    
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
        </div> --}}
      </div>
    </div>

  </div>

  <!-- / Main content -->

@endsection
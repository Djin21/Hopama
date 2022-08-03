@extends('administrateur.layouts.app')

@section('consultation')
  active
@endsection

@section('content')

<?php 
  use App\Models\Type_consultation; 
  use App\Models\Service; 
  use App\Models\Validite; 

  // $type_consultations = Type_consultation::orderBy('nom')->get();
  // $consultationCpt = Type_consultation::all()->count();

  $type_consultations = Type_consultation::orderBy('nom')->get();
  // $type_consultations = Service::where('consultable', 1)->get();
  $consultationCpt = Service::where('consultable', 1)->get()->count();

  $validite = Validite::latest()->first();
  $duree = $validite == Null ? '--' : $validite->validite;

  $services = Service::orderBy('nom')->get();

?>



    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">Consultation</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
          <div class="row">
            <h5>Validite</h4>
          </div>
          <div class="row">
            <div class="col-4 px-3">
              <div class="card p-3">
                <h5>Duree de la session</h5>
                <h5>{{ $duree }} jours</h5>
              </div>
            </div>
            <div class="col-4 px-3">
              <div class="card p-3">
                <h5>Derniere mise a jour</h5>
                <h5>{{ $validite == Null ? '--' :  $validite->created_at->format('d-m-Y')}}</h5>
              </div>
            </div>
            <div class="col-4 d-flex flex-column justify-content-between">
              <button class="btn btn-primary m-2">Historique</button>
              <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#modalNewValidite">Modifier</button>
            </div>
          </div>
          <div class="row d-flex flex-row align-items-center pt-5 mb-2">
            <h5 class="w-auto">Type de consultations</h4>
            <div class="text-start w-auto ms-auto">
              <button class="btn btn-primary me-3 w-auto" data-bs-toggle="modal" data-bs-target="#modalNewConsultation">Nouveau</button>
              <button class="btn btn-primary me-3 w-auto">Restaurer</button>
            </div>
            {{-- <div class="col-md-2 mb-3 mb-md-0 text-end align-items-center">
              <button class="btn py-0" data-bs-toggle='modal' data-bs-target='#modalNewValidite'>Modifier</button>
            </div> --}}
          </div>
          <div class="card">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-header">Liste des consultations</h5>
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                    id="searchexam"
                    oninput="voila()"
                  />
                </div>
              </div>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <caption class="ms-4">
                  Nombre de salle : {{ $consultationCpt }}
                </caption>
                <thead>
                  <tr>
                    <th>Consultation</th>
                    {{-- <th class="text-center">Service</th> --}}
                    <th class="text-end">Prix</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="moi">
                  @foreach ($type_consultations as $type_consultation)
                    <tr class="py-2">
                      <td><strong>{{ $type_consultation->nom }} </strong></td>
                      <?php
                        // $service = Service::where('id', $type_consultation->service_id)->firstOrFail();
                        // $prix = Type_consultation::orderBy('created_at', 'desc')->first();
                      ?>
                      {{-- <td class="text-center">{{ $service->nom }}</td> --}}
                      {{-- <td class="text-center">{{ $service->code }}</td> --}}
                      <td class="text-end">{{ $type_consultation->prix }}</td>
                      <td class="text-end">
                        <button class="btn btn-primary w-auto py-2 px-3"><i class="bx bx-edit p-0 m-0" style="color: white;" data-bs-toggle="modal" data-bs-target="#modalModifConsultation{{$type_consultation->id}}"></i></button>
                        <button class="btn btn-danger ms-2 w-auto py-2 px-3"><i class="bx bx-trash p-0 m-0" style="color: white;" data-bs-toggle="modal" data-bs-target="#modalDeleteConsultation{{$type_consultation->id}}"></i></button>
                      </td>
                    </tr>
                    <form action="{{ route('admin.consultation.modifier', ['idConsultation' => $type_consultation->id]) }}" method="post">
                      <input type="text" name="type" value="2" class="d-none">
                      {{-- <input type="text" name="side" value="3" class="d-none"> --}}
                      <div class="modal fade modalExam" id="modalModifConsultation{{$type_consultation->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          
                            @csrf
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalCenterTitle">Modifier</h5>
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
                                <div class="row d-flex align-items-center">
                                  <p class="col-3 my-auto">Consultation  </p>
                                  <div class="col-9 my-auto">
                                    <input
                                      type="text"
                                      class="form-control my-auto"
                                      id="basic-icon-default-fullname"
                                      placeholder="Nom de la consultation"
                                      aria-label="Nom de la consultation"
                                      aria-describedby="basic-icon-default-fullname2"
                                      name="nomConsultation"
                                      value="{{str_replace("Consultation ", "", "$type_consultation->nom")}}"
                                    />
                                  </div>
                                </div>
                                </div>
                              </div>
                              <div class="row g-md-2 mb-4">
                                <div class="col mb-0 text-start">
                                <label for="emailWithTitle" class="form-label">Service</label>
                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                                        @foreach ($services as $service)
                                          <option value="{{$service->id}}" {{$service->id == $type_consultation->service_id ? 'selected' : ''}}>{{$service->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                              <div class="row g-md-2 mb-4">
                                <div class="col mb-0 text-start">
                                  <label for="emailWithTitle" class="form-label">Prix</label>
                                    <input
                                      type="number"
                                      id="basic-icon-default-phone"
                                      class="form-control phone-mask"
                                      placeholder="2000"
                                      aria-label="2000"
                                      aria-describedby="basic-icon-default-phone2"
                                      name="prixConsultation"
                                      value="{{ $type_consultation->prix }}"
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
                    <form action="{{ route('admin.consultation.modifier', ['idConsultation' => $type_consultation->id]) }}" method="post">
                      <input type="text" name="type" value="3" class="d-none">
                      <div class="modal fade" id="modalDeleteConsultation{{$type_consultation->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          
                            @csrf
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
                              <div class="row g-md-2 mb-4">
                                <p>Voulez vous vraiment supprimer ce type de consultation ?</p>
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
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="{{ route('admin.validite') }}" method="post">
        <input type="text" name="type" value="1" class="d-none">
            <div class="modal fade modalExam" id="modalNewValidite" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                
                  @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Nouvelle validite</h5>
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
                      <label for="nameWithTitle" class="form-label">Validite ('en jours')</label>
                          <input
                            type="text"
                            class="form-control"
                            id="basic-icon-default-fullname"
                            placeholder="Nom du personnel"
                            aria-label="Nom du personnel"
                            aria-describedby="basic-icon-default-fullname2"
                            name="validite"
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
      <form action="{{ route('admin.consultation.modifier', ['idConsultation' => 0]) }}" method="post">
        <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modalNewConsultation" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nouveau</h5>
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
                  <div class="row d-flex align-items-center">
                    <p class="col-3 my-auto">Consultation  </p>
                    <div class="col-9 my-auto">
                      <input
                        type="text"
                        class="form-control my-auto"
                        id="basic-icon-default-fullname"
                        placeholder="Nom de la consultation"
                        aria-label="Nom de la consultation"
                        aria-describedby="basic-icon-default-fullname2"
                        name="nomConsultation"
                      />
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                  <label for="emailWithTitle" class="form-label">Service</label>
                      <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                          @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->nom}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                    <label for="emailWithTitle" class="form-label">Prix</label>
                      <input
                        type="number"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="2000"
                        aria-label="2000"
                        aria-describedby="basic-icon-default-phone2"
                        name="prixConsultation"
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
    <div
      id="toast"
      class="bs-toast toast toast-placement-ex m-2 top-0 end-0 bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-delay="5000"
    >
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Mise a jour</div>
        <small>A l'instant</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">La validite a ete mise a jour</div>
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



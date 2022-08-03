<?php
    use App\Models\Lit;

    function test()
    {

    }
?>

@foreach ($salles as $salle)
  <tr class="py-2">
    <td><strong>{{ $salle->nom }} </strong></td>
    <?php
    //   $examenCpt = Examen::where('service_id', $service->id)->get()->count();
      // $cpt = 0;
      // if($examens == null){
      //   $cpt = 0;
      // }else{
      //   $cpt = $examens->count();
      // }
    ?>
    <td class="text-center">{{ $salle->nombreLit }}</td>
    {{-- <td class="text-center">{{ $service->code }}</td> --}}
    <td class="text-end">
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$salle->id}}'
            ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.salle.supprimer', ['idSalle' => $salle->id]) }}"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
      <form action="{{ route('admin.salle.modifier', ['idSalle' => $salle->id]) }}" method="post">
        <div class="modal fade modalExam" id="modal{{$salle->id}}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
              <input type="text" name="type" id="typeSubmit" value="1" class="d-none">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modifier salle</h5>
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
                        placeholder="Nom du service"
                        aria-label="Nom du service"
                        aria-describedby="basic-icon-default-fullname2"
                        value="{{$salle->nom}}"
                        name="nomSalle"
                      />
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Description</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Nom du service"
                          aria-label="Nom du service"
                          aria-describedby="basic-icon-default-fullname2"
                          value="{{$salle->description}}"
                          name="descriptionSalle"
                        />
                    </div>
                </div>
                <?php
                    // $litCpt = Lit::all()->count();
                    $lits = Lit::where('salle_id', $salle->id)->get();
                    $litCpt = $lits->count();
                ?>
                <div class="card">
                    <div class="d-flex align-items-center">
                      <h5 class="card-header">Liste des lits</h5>
                    </div>
                    <div class="table-responsive text-nowrap">
                    <table class="table">
                        <caption class="ms-4">
                          Nombre de lit : {{ $litCpt }}
                        </caption>
                        <thead>
                          <tr>
                            <th class="text-start">Lit</th>
                            <th class="text-center">Etat</th>
                            <th class="text-end">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($lits as $lit)
                            <tr class="py-2">
                                <td class="text-start"><strong>Lit {{ $lit->numero }} </strong></td>
                                <td class="text-center">{{ $lit->etat }}</td>
                                <td class="text-end">
                                  <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu py-3">
                                      {{-- <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$salle->id}}'
                                        ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
                                      > --}}
                                      <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.lit.supprimer', ['idLit' => $lit->id]) }}"
                                        ><i class="bx bx-trash me-1"></i> Supprimer</a
                                      >
                                    </div>
                                  </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Annuler
                </button>
                <button type="submit" name="ajouter_lit" class="btn btn-primary">Ajouter lit</button>
                <button type="submit" name="modifier_salle" class="btn btn-primary">Enregistrer</button>
              </div>
            </div>
          
          </div>
        </div>
      </form>
      {{-- <div class="modal fade modalExam" id="modal{{$salle->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Informations sur la salle</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="row mb-2 text-start">
                <div class="col-4 justify-content-center">
                    <div class="rectangle" style="height: 50%; width: 80%; border-radius: 20px; background-color: grey;">

                    </div>
                </div>
                <div class="col-8">
                    <div class="row mb-1 text-start">
                    <div class="row text-start m-0 p-0">
                        <h6 style="color: rgba(128, 128, 128, 0.5)">Nom</h6>
                    </div>
                    <div class="row text-start mb-0 pb-0">
                        <h5>{{ $salle->nom }}</h5>
                    </div>
                  </div>
                  <div class="row mb-2 text-start">
                    <div class="row text-start m-0 p-0">
                        <h6 style="color: rgba(128, 128, 128, 0.5)">Description</h6>
                    </div>
                    <div class="row text-start mb-0 pb-0">
                        <h5>{{ $salle->description }}</h5>
                    </div>
                </div>
              </div>
              <?php
                $litCpt = Lit::all()->count();
                $lits = Lit::where('salle_id', $salle->id)->get();
              ?>
              <div class="card my-3">
                <table class="table">
                    <caption class="ms-4">
                      Nombre de lit : {{ $litCpt }}
                    </caption>
                    <thead>
                      <tr>
                        <th>Lit</th>
                        <th class="text-center">Etat</th>
                        <th class="text-end">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($lits as $lit)
                        <tr class="py-2">
                            <td><strong>{{ $lit->numero }} </strong></td>
                            <td class="text-center">{{ $lit->etat }}</td>
                            <td class="text-end">
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu py-3">
                                  <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$salle->id}}'
                                    ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
                                  >
                                  <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.salle.supprimer', ['idSalle' => $salle->id]) }}"
                                    ><i class="bx bx-trash me-1"></i> Supprimer</a
                                  >
                                </div>
                              </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
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
      </div> --}}
      
      {{-- <form action="{{ route('admin.service.modifier', ['idService' => $service->id]) }}" method="post">
        <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modal{{$service->id}}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modifier service</h5>
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
                        placeholder="Nom du service"
                        aria-label="Nom du service"
                        aria-describedby="basic-icon-default-fullname2"
                        value="{{$service->nom}}"
                        name="nomService"
                      />
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                  <label for="nameWithTitle" class="form-label">Peut on y faire des consultation ?</label>
                  <div class="form-check form-check-inline my-auto">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="consultable"
                        id="inlineRadio1"
                        value="1"
                        {{ $service->consultable == 1 ? 'checked' : '' }}
                      />
                      <label class="form-check-label" for="inlineRadio1">Oui</label>
                    </div>
                    <div class="form-check form-check-inline my-auto">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="consultable"
                        id="inlineRadio2"
                        value="0"
                        {{ $service->consultable != 1 ? 'checked' : '' }}
                      />
                      <label class="form-check-label" for="inlineRadio2">Non</label>
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
      </form> --}}
    </td>
  </tr>
@endforeach

<script>
  let type = 1;
  $('#typeSubmit').val('1');
    function setType(){
        $('#typeSubmit').val('2');
        alert($('#typeSubmit').val())
    }
    
</script>
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
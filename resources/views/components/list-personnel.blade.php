<?php

use App\Models\Service;

$services = Service::orderBy('nom')->get();

?>

@foreach ($personnels as $personnel)
<?php
  $service = Service::where('id', $personnel->service_id)->firstOrFail();
  // $serviceCpt = Service::where('id', $personnel->service_id)->get()->count();
?>
{{-- @if($serviceCpt != 0) --}}
<tr class="py-2">
    <td><strong>{{ $personnel->nom }} </strong></td>
    <td class="text-center">{{ $service->nom }}</td>
    <td class="text-end">
      {{-- <button
        type="button"
        class="btn text-nowrap"
        data-bs-toggle="popover"
        data-bs-offset="0,14"
        data-bs-placement="bottom"
        data-bs-html="true"
        data-bs-content="<a href='javascript:void(0);'><button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modal{{$personnel->id}}'><i class='bx bx-edit-alt me-1'></i>Modifier</button></a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Supprimer</a>" 
        title=""
      >
        <i class="bx bx-dots-vertical-rounded"></i>
      </button> --}}
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$personnel->id}}'
            ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.personnel.supprimer', ['idPersonnel' => $personnel->id]) }}"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
      <form action="{{ route('admin.personnel.modifier', ['idPersonnel' => $personnel->id]) }}" method="post">
        <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modal{{$personnel->id}}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modifier personnel</h5>
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
                        placeholder="Nom du personnel"
                        aria-label="Nom du personnel"
                        aria-describedby="basic-icon-default-fullname2"
                        value="{{$personnel->nom}}"
                        name="nomPersonnel"
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
                          placeholder="Prenom du personnel"
                          aria-label="Prenom du personnel"
                          aria-describedby="basic-icon-default-fullname2"
                          value="{{$personnel->prenom}}"
                          name="prenomPersonnel"
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
                          name="sexePersonnel"
                          id="inlineRadio1"
                          value="masculin"
                          {{$personnel->sexe == 0 ? 'checked' : ''}}
                        />
                        <label class="form-check-label" for="inlineRadio1">Masculin</label>
                      </div>
                      <div class="form-check form-check-inline my-auto">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="sexePersonnel"
                          id="inlineRadio2"
                          value="feminin"
                          {{$personnel->sexe == 1 ? 'checked' : ''}}
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
                          placeholder="Nom du personnel"
                          aria-label="Nom du personnel"
                          aria-describedby="basic-icon-default-fullname2"
                          value="{{$personnel->dateNaiss}}"
                          name="dateNaissPersonnel"
                        />
                    </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                    <div class="col mb-0 text-start">
                    <label for="nameWithTitle" class="form-label">Lieu de naissance</label>
                        <input
                          type="date"
                          class="form-control"
                          id="basic-icon-default-fullname"
                          placeholder="Nom du personnel"
                          aria-label="Nom du personnel"
                          aria-describedby="basic-icon-default-fullname2"
                          value="{{$personnel->lieuNaiss}}"
                          name="lieuNaissPersonnel"
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
                          placeholder="Numero"
                          aria-label="Numero"
                          aria-describedby="basic-icon-default-fullname2"
                          value="{{$personnel->telephone}}"
                          name="telPersonnel"
                        />
                    </div>
                  </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                  <label for="emailWithTitle" class="form-label">Service</label>
                      <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                          @foreach ($services as $service)
                            <option value="{{$service->id}}" {{$personnel->service_id == $service->id ? 'selected' : ''}}>{{$service->nom}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                  <label for="nameWithTitle" class="form-label">Code d'access</label>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="code"
                        aria-label="code"
                        aria-describedby="basic-icon-default-fullname2"
                        name="codePersonnel"
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
    </td>
  </tr>
{{-- @endif --}}
@endforeach

<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
<?php

use App\Models\Examen;

?>

@foreach ($services as $service)
  <tr class="py-2">
    <td><strong>{{ $service->nom }} </strong></td>
    <?php
      $examenCpt = Examen::where('service_id', $service->id)->get()->count();
      // $cpt = 0;
      // if($examens == null){
      //   $cpt = 0;
      // }else{
      //   $cpt = $examens->count();
      // }
    ?>
    <td class="text-center">{{ $examenCpt }}</td>
    {{-- <td class="text-center">{{ $service->code }}</td> --}}
    <td class="text-end">
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$service->id}}'
            ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.service.supprimer', ['idService' => $service->id]) }}"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
      <form action="{{ route('admin.service.modifier', ['idService' => $service->id]) }}" method="post">
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
                {{-- <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                    <label for="emailWithTitle" class="form-label">Code</label>
                      <input
                        type="test"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="12bb2v3"
                        aria-label="12bb2v3"
                        aria-describedby="basic-icon-default-phone2"
                        value={{$service->code}}
                        name="codeService"
                      />
                  </div>
                </div> --}}
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
      </form>
    </td>
  </tr>
@endforeach

<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
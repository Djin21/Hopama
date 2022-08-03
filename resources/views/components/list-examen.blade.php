<?php

use App\Models\Service;

$services = Service::orderBy('nom')->get();

?>

@foreach ($examens as $examen)
<?php
  $service = Service::where('id', $examen->service_id)->firstOrFail();
  // $serviceCpt = Service::where('id', $examen->service_id)->get()->count();
?>
{{-- @if($serviceCpt != 0) --}}
<tr class="py-2">
    <td><strong>{{ $examen->nom }} </strong></td>
    <td class="text-center">{{ $service->nom }}</td>
    <td class="text-center">{{ $examen->prix }}</td>
    <td class="text-end">
      {{-- <button
        type="button"
        class="btn text-nowrap"
        data-bs-toggle="popover"
        data-bs-offset="0,14"
        data-bs-placement="bottom"
        data-bs-html="true"
        data-bs-content="<a href='javascript:void(0);'><button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modal{{$examen->id}}'><i class='bx bx-edit-alt me-1'></i>Modifier</button></a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Supprimer</a>" 
        title=""
      >
        <i class="bx bx-dots-vertical-rounded"></i>
      </button> --}}
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modal{{$examen->id}}'
            ></i><i class='bx bx-edit-alt me-1'></i>Modifier</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('admin.examen.supprimer', ['idExamen' => $examen->id]) }}"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
      <form action="{{ route('admin.examen.modifier', ['idExamen' => $examen->id]) }}" method="post">
        <input type="text" name="type" value="1" class="d-none">
        <div class="modal fade modalExam" id="modal{{$examen->id}}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            
              @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modifier examen</h5>
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
                        placeholder="Nom de l'examen"
                        aria-label="Nom de l'examen"
                        aria-describedby="basic-icon-default-fullname2"
                        value="{{$examen->nom}}"
                        name="nomExamen"
                      />
                  </div>
                </div>
                <div class="row g-md-2 mb-4">
                  <div class="col mb-0 text-start">
                  <label for="emailWithTitle" class="form-label">Service</label>
                      <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="service">
                          @foreach ($services as $service)
                            <option value="{{$service->id}}" {{$examen->service_id == $service->id ? 'selected' : ''}}>{{$service->nom}}</option>
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
                        value={{$examen->prix}}
                        name="prixExamen"
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
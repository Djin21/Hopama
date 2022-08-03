<?php

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Session;
use App\Models\Rdv;

?>
@foreach ($consultations as $consultation)
<?php
    $patient = Patient::where('id', Session::where('id', $consultation->session_id)->first()->patient_id)->first();
    $rdv = Rdv::where('consultation_id', $consultation->id)->first();
?>
@if ($rdv != Null)
<tr>
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    <?php
        // $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[$dates->count()-1]->created_at;
        $date=date_create("$rdv->date");
    ?>
    <td>{{ $consultation->created_at->format('d/m/Y | h:i') }}</td>
    <td>{{ date_format($date,"d/m/Y H:i") }}</td>
    <td class="">
        <div class="dropdown ms-3">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu py-3">
              <a class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalRdv{{$rdv->id}}'
                ></i><i class='bx bx-edit-alt me-1'></i>Editer</a
              >
              <a class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalDeleteRdv{{$rdv->id}}'
                ><i class="bx bx-trash me-1"></i> Supprimer</a
              >
            </div>
        </div>
        <form action="{{ route('medecin.modifierRdv') }}" method="post">
          <input type="text" name="rdv" value="{{ $rdv->id }}" class="d-none">
          <div class="modal fade modalExam" id="modalRdv{{$rdv->id}}" tabindex="-1" aria-hidden="true">
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
        <form action="{{ route('medecin.deleteRdv') }}" method="post">
          @csrf
          <input type="text" name="rdv" value="{{ $rdv->id }}" class="d-none">
          <div class="modal fade modalExamDelete" id="modalDeleteRdv{{ $rdv->id }}" tabindex="-1" aria-hidden="true">
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
                      <h6>Voulez vous supprimer le rendez vous ?</h6>
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
    </td>
    </tr>
@endif
@endforeach
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
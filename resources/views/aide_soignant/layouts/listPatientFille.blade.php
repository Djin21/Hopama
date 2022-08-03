<?php
    use App\Models\Consultation;
    use App\Models\Session;
    use App\Models\Patient;

    $patients = Patient::where('sexe', 1)->get();
?>

@foreach ($patients as $patient)
<?php
    $session = Session::where('patient_id', $patient->id)->latest()->first();
?>
@if ($session != Null)
<?php
    $date = $session->created_at;
    $consultation = Consultation::where('session_id', $session->id)->latest()->first();
    $etat = 'Aucun';
    if($consultation != Null){
        if($consultation->etat == 0){
            $etat = 'Aucun';
        }else if($consultation->etat == 1){
            $etat = 'Suivit';
        }else{
            $etat = 'Hospitalisee';
        }
        $date = $consultation->created_at;
    }
?>
<tr>
  <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
  <td>{{ $date->format('d/m/Y | h:i') }}</td>
  <td>{{ $etat }}</td>
  <td class="">
    <div class="dropdown ms-3">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a data-bs-toggle='modal' data-bs-target='#modalAccouchement{{$patient->id}}' class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
            ></i><i class='bx bx-edit-alt me-1'></i>Accouchement</a
          >
        </div>
      </div>
      <form action="{{ route('aide_soignant.saveAccouchement') }}" method="post">
        @csrf
        <input type="text" name="patient_id" value="{{ $patient->id }}" class="d-none">
        <div class="modal fade" id="modalAccouchement{{ $patient->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nouvel accouchement</h5>
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
                      <label for="nameWithTitle" class="form-label me-3">Le patient est-il decedé ?</label>
                      <div class="form-check form-check-inline my-auto">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="decesPatient"
                            id="inlineRadio1"
                            value="1"
                          />
                          <label class="form-check-label" for="inlineRadio1">Oui</label>
                        </div>
                        <div class="form-check form-check-inline my-auto">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="decesPatient"
                            id="inlineRadio2"
                            value="0"
                            checked
                          />
                          <label class="form-check-label" for="inlineRadio2">Non</label>
                        </div>
                      </div>
                    </div>
                  <div class="row g-md-2 mb-4">
                      <div class="col mb-0 text-start">
                      <label for="nameWithTitle" class="form-label">Nombre naissance</label>
                          <input
                            type="text"
                            class="form-control"
                            id="basic-icon-default-fullname"
                            placeholder="1"
                            aria-label="1"
                            aria-describedby="basic-icon-default-fullname2"
                            name="nbrNaiss"
                            value="1"
                          />
                      </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                      <div class="col mb-0 text-start">
                      <label for="nameWithTitle" class="form-label">Nombre de deces</label>
                          <input
                            type="text"
                            class="form-control"
                            id="basic-icon-default-fullname"
                            placeholder="0"
                            aria-label="0"
                            aria-describedby="basic-icon-default-fullname2"
                            name="nbrDeces"
                            value="0"
                          />
                      </div>
                  </div>
                  <div class="row g-md-2 mb-4">
                      <div class="col mb-0 text-start">
                      <label for="nameWithTitle" class="form-label  row ms-1">Date de l'accouchement</label>
                      <div class="form-check form-check-inline my-auto">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="dateAccouch"
                            id="inlineRadio1"
                            value="1"
                            onclick="hideDate()"
                            checked
                          />
                          <label class="form-check-label" for="inlineRadio1">Aujourd'hui</label>
                        </div>
                        <div class="form-check form-check-inline my-auto">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="dateAccouch"
                            id="inlineRadio2"
                            value="0"
                            onclick="showDate()"
                          />
                          <label class="form-check-label" for="inlineRadio2">Autre</label>
                        </div>
                      </div>
                  </div>
                  <div class="row g-md-2 mb-4 d-none" id="dateAccouchement">
                      <div class="col mb-0 text-start">
                      <label for="nameWithTitle" class="form-label">Date</label>
                          <input
                            type="date"
                            class="form-control"
                            id="basic-icon-default-fullname"
                            placeholder="0"
                            aria-label="0"
                            aria-describedby="basic-icon-default-fullname2"
                            name="dateAccouchementPatient"
                            value="0"
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
@endif
@endforeach

<script>
    function showDate(){
        $('#dateAccouchement').removeClass('d-none');
    }
    function hideDate(){
        $('#dateAccouchement').addClass('d-none');
    }
</script>
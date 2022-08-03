<?php
    use App\Models\Patient;
    use App\Models\Session;
    use App\Models\Consultation;

    $patients = Null;
?>


@if($nom == 'all')
    <?php $patients = Patient::orderBy('nom')->get(); ?>
@else
    <?php $patients = Patient::where("nom", "LIKE" , "%".$nom."%")->get(); ?>
@endif

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
@if ($consultation != Null && $consultation->etat == 1)
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
            <a href="{{ route('global.dossierPatient.show', ['idPatient' => $patient->id]) }}" class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
                ></i><i class='bx bi-file-earmark-plus me-1'></i>Nouvelle consultation</a
            >
            <a href="{{ route('global.dossierPatient.show', ['idPatient' => $patient->id]) }}" class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
                ></i><i class='bx bi-folder me-1'></i>Dossier</a
            >
          </div>
      </div>
      {{-- <form action="{{ route('medecin.deletePatient') }}" method="post">
        @csrf
        <input type="text" name="patient" value="{{ $patient->id }}" class="d-none">
        <div class="modal fade" id="modalDeletePatient{{ $patient->id }}" tabindex="-1" aria-hidden="true">
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
      </form> --}}
  </td>
  </tr>
@endif

@endif
@endforeach
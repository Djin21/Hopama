<?php

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Session;

?>

@foreach ($consultations as $consultation)
<?php
    $patient = Patient::where('id', Session::where('id', $consultation->session_id)->first()->patient_id)->first();
?>
<tr>
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    
    <td>{{ $consultation->created_at->format('d/m/Y | h:i') }}</td>
    
    <?php
        $etat = 'Aucun';
        if ($consultation->etat == 1) {
            $etat = 'Suivit';
        }elseif ($consultation->etat == 2) {
            $etat = 'Hospitalisee';
        }
    ?>
    <td><span class="badge bg-label-primary">{{ $etat}}</span></td>
    <td>
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu py-3">
              <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href="{{ route('medecin.profile_patient', ['idConsultation' => $consultation->id]) }}"
                ></i><i class='bx bx-edit-alt me-1'></i>Consulter</a
              >
              <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href=""
                ><i class="bx bx-trash me-1"></i> Supprimer</a
              >
            </div>
          </div>
    </td>
    </tr>
@endforeach
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
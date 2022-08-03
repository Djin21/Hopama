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
<tr class="">
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    <td>{{ $date->format('d/m/Y | h:i') }}</td>
    <td>{{ $etat }}</td>
    <td class="">
        <div class="dropdown ms-3">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu py-3">
            @if ($consultation == Null || ($consultation != Null && $consultation->etat != 2))
                <a href="{{ route('aide_soignant.patientParametre', ['idPatient' => $patient->id]) }}" class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
                  ></i><i class='bx bi-file-earmark-plus me-1'></i>Nouvelle consultation</a
                >
            @endif
              <a href="{{ route('global.dossierPatient.show', ['idPatient' => $patient->id]) }}" class="dropdown-item my-1 btn" style="text-decoration: none; cursor: pointer;"
                ></i><i class='bx bi-folder me-1'></i>Dossier</a
              >
            </div>
        </div>
    </td>
    </tr>
</div>
@endif
@endforeach
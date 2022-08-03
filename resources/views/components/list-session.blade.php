<?php

use App\Models\Patient;
use App\Models\Session;
use App\Models\Validite;

?>

@foreach ($sessions as $session)
@if ($session->nbrConsultation == 0)
<?php
  $patient = Patient::where('id', $session->patient_id)->firstOrFail();
  // $sess = Session::latest()->firstOrFail();
  date_default_timezone_set("Africa/Douala");
  $date = date('Y/m/d');
  $x1 = date_create("$date");
  $d2 = $session->created_at;
  $validite = Validite::where('id', $session->validite_id)->firstOrFAil()->validite;
  date_add($d2, date_interval_create_from_date_string("$validite days"));
  $y = date_format($d2, "Y/m/d");
  $x2 = date_create("$d2");
  $z = date_diff($x1, $x2);
  $diff = (int)$z->format("%a");
  $valid = 0;
  if($diff > 0){
    $valid = 1;
  }else{
    $valid = 0;
  }
?>
<tr class="patient-row">
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    <?php

        // $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[0];
        //  
        // $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[$dates->count()-1]->created_at;
    ?>
    <td>{{ $session->created_at->format('d/m/Y | h:i') }}</td>
    {{-- <td>23/23/2333</td> --}}
    <td><span class="badge bg-label-primary">{{ $valid == 1 ? 'Valide' : 'Invalide' }}</span></td>
    <td>
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href='{{ route('aide_soignant.patientParametre', ['idPatient' => $patient->id]) }}'
            ></i><i class='bx bx-edit-alt me-1'></i>Consulter</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
      {{-- <button
        type="button"
        class="btn text-nowrap"
        data-bs-toggle="popover"
        data-bs-offset="0,14"
        data-bs-placement="bottom"
        data-bs-html="true"
        data-bs-content="<a class='dropdown-item' href='{{ route('aide_soignant.profile_patient', ['idPatient' => $patient->id]) }}'><i class='bx bx-edit-alt me-1'></i> Consulter</a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Supprimer</a>" 
        title=""
      >
        <i class="bx bx-dots-vertical-rounded"></i>
      </button> --}}
    </td>
  </tr>

  @endif
@endforeach
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
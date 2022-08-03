<?php

use App\Models\Patient;
use App\Models\Examen;
use App\Models\Paiement;

?>

@foreach ($paiements as $paiement)

<?php
    $patient = Patient::where('id', $paiement->patient_id)->first();
    $examen = Examen::where('id', $paiement->examen_id)->first();

    $datePaiement = $paiement->created_at;
?>
    <tr>
        <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
        <?php
    
            // $dates = Paiement::where('patient_id', $patient->id)->get();
            // $datePass = $dates[0];
            //  
            // $dates = Paiement::where('patient_id', $patient->id)->get();
            // $datePass = $dates[$dates->count()-1]->created_at;
        ?>
        <td>{{ $examen->nom }}</td>
        <td class="text-end me-4">{{ $datePaiement->format('d/m/Y | h:i') }}</td>
        {{-- <td>23/23/2333</td> --}}
        {{-- <td><span class="badge bg-label-primary">{{ $valid == 1 ? 'Valide' : 'Invalide' }}</span></td>
        <td></td> --}}
    </tr>

{{-- @foreach ($examenEffectues as $examenEffectue)
@if ($examenEffectue->type == 0)
    <?php
        // $examenPrescrit = Examen_prescrit::where('id', $examenEffectue->type_id)->first();
        // $examen = Examen::where('id', $examenPrescrit->examen_id)->first();
        // $prescription = Prescription::where('id', $examenPrescrit->prescription_id)->first();
        // $consultation = Consultation::where('id', $prescription->consultation_id)->first();
        // $session = Session::where('id', $consultation->session_id)->first();
        // $patient = Patient::where('id', $session->patient_id)->first();
        
    ?>
    <?php
        // $pat[$i] = $patient->id;
        // $i = $i + 1;
        // date_default_timezone_set("Africa/Douala");
        // $date = date('Y/m/d');
        // $x1 = date_create("$date");
        // $d2 = $session->created_at;
        // $validite = Validite::where('id', $session->validite_id)->firstOrFAil()->validite;
        // date_add($d2, date_interval_create_from_date_string("$validite days"));
        // $y = date_format($d2, "Y/m/d");
        // $x2 = date_create("$d2");
        // $z = date_diff($x1, $x2);
        // $diff = (int)$z->format("%a");
        // $valid = 0;
        // if($diff > 0){
        //     $valid = 1;
        // }else{
        //     $valid = 0;
        // }
        // $datePaiement = $examenPrescrit->created_at;
        // $type = 'Prescrit';
    ?>
@elseif ($examenEffectue->type == 1)
<?php
    // $paiement = Paiement::where('id', $examenEffectue->type_id)->first();
    // $patient = Patient::where('id', $paiement->patient_id)->first();
    // $examen = Examen::where('id', $paiement->examen_id)->first();

    // $datePaiement = $paiement->created_at;
    // $type = 'Nouveau';
?>
@endif
    <tr>
        <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
        <?php
    
            // $dates = Paiement::where('patient_id', $patient->id)->get();
            // $datePass = $dates[0];
            //  
            // $dates = Paiement::where('patient_id', $patient->id)->get();
            // $datePass = $dates[$dates->count()-1]->created_at;
        ?>
        <td>{{ $examen->nom }}</td>
        <td>{{ $type }}</td>
        <td class="text-end me-4">{{ $datePaiement->format('d/m/Y | h:i') }}</td>
        {{-- <td>23/23/2333</td> --}}
        {{-- <td><span class="badge bg-label-primary">{{ $valid == 1 ? 'Valide' : 'Invalide' }}</span></td>
        <td></td> --}}
    {{-- </tr> --}}
@endforeach 


<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
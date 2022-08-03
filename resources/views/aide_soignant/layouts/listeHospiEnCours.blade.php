<?php
    use App\Models\Hospitalisation;

    $hospitalisations = Hospitalisation::orderBy('created_at')->get();
    
?>

@foreach ($hospitalisations as $hospi)
<?php
    $prescription = Prescription::where('id', $hospi->prescription_id)->first();
    $consultation = Consultation::where('id', $prescription->consultation_id)->first();
    $session = Session::where('id', $consultation->session_id)->first();
    $patient = Patient::where('id', $session->patient_id)->first();

    $lit = Lit::where('id', $hospi->lit_id)->first();
    $salle = Salle::where('id', $lit->salle_id)->first();
?>
    <td>{{ $patient->nom }} {{ $patient->prenom }}</td>
    <td>Lit {{ $lit->numero }}</td>
    <td>{{ $salle->nom }}</td>
    <td>...</td>
@endforeach
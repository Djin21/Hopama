<?php
    use App\Models\Patient;

    $patients = Patient::where('nom', 'LIKE', '%'.$nom.'%')->get();
?>

@foreach ($patients as $patient)
    <a href="">
        <div>{{ $patient->nom }}</div>
    </a>
@endforeach
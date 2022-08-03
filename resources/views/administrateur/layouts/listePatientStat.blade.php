<?php
    use App\Models\Patient;

    if($nom == '10'){
        $patients = Patient::orderBy('nom')->get();
    }else{
        $patients = Patient::where('nom', "LIKE", "%".$nom."%")->orderBy('nom')->get();
    }
?>

@foreach ($patients as $patient)

<div class="m-0 p-0 text-start px-3 pt-2 pb-3 rounded-3 patient-msg-diff" onclick="refresh({{$patient->id}})" style="border-bottom: 0.2px solid rgba(0, 0, 0, 0.048);cursor: pointer;">
    <input
        class="form-check-input"
        type="checkbox"
        name="patient[]"
        id="inlineRadio2"
        value="{{$patient->id}}"
        onclick="refresh()"
    />
    <span class="ms-2">{{ $patient->nom }}</span>
</div>

@endforeach
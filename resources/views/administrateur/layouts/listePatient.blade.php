<?php
    use App\Models\Patient;

    $patients = Patient::where('nom', "LIKE", "%".$nom."%")->orderBy('nom')->get();
?>

@foreach ($patients as $patient)

<div class="m-0 p-0 text-start px-3 py-2 rounded-3 patient-msg-diff" style="border-bottom: 0.2px solid rgba(0, 0, 0, 0.048);cursor: pointer;">
    <input
        class="form-check-input"
        type="radio"
        name="patient"
        id="inlineRadio2"
        value="{{$patient->id}}"
        onclick="refresh()"
    />
    <span class="ms-2">{{ $patient->nom }}</span>
</div>

@endforeach

<script>
    function setPatient(nom){
          alert('salut');
      }
</script>
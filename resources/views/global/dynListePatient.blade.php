@foreach ($patients as $patient)
    <a class="d-flex flex-row justify-content-start border-bottom pt-3 patient-card fw-bold" style="color: rgb(134, 134, 134);" href="{{ route('global.dossierPatient.show', ['idPatient' => $patient->id]) }}">
        <p class="ps-3">{{ $patient->nom }}</p>
        <p class="ps-2">{{ $patient->prenom }}</p>
        <p class="ps-5">P{{ $patient->id }}CMNB</p>
    </a>  
@endforeach
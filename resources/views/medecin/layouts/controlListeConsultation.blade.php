@if (isset($nom))
    @if($nom == 'all')
        <x-listConsultation name="{{ $idMedecin }}" :nom="1"/>
    @else
        <x-listConsultation name="{{ $idMedecin }}" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
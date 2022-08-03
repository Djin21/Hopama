@if (isset($nom))
    @if($nom == 'all')
        <x-histConsultation name="{{ $idMedecin }}" :nom="1"/>
    @else
        <x-histConsultation name="{{ $idMedecin }}" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
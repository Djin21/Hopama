@if (isset($nom))
    @if($nom == 'all')
        <x-listRdvEffectue name="{{ $idMedecin }}" :nom="1"/>
    @else
        <x-listRdvEffectue name="{{ $idMedecin }}" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
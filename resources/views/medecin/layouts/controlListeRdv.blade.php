@if (isset($nom))
    @if($nom == 'all')
        <x-listRdv name="{{ $idMedecin }}" :nom="1"/>
    @else
        <x-listRdv name="{{ $idMedecin }}" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
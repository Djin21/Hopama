@if (isset($nom))
    @if($nom == 'all')
        <x-listRdvManque name="{{ $idMedecin }}" :nom="1"/>
    @else
        <x-listRdvManque name="{{ $idMedecin }}" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
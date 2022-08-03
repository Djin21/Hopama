@if (isset($nom))
    @if($nom == 'all')
        <x-listPersonnel name="2" :nom="1"/>
    @else
        <x-listPersonnel name="2" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
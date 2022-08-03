@if (isset($nom))
    @if($nom == 'all')
        <x-listPatient name="3" :nom="1"/>
    @else
        <x-listPatient name="3" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
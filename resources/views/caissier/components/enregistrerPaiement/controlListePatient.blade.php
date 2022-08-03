@if (isset($nom))
    @if($nom == 'all')
        <x-listPatient name="1" :nom="1"/>
    @else
        <x-listPatient name="1" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
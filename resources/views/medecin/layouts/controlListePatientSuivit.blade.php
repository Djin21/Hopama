@if (isset($nom))
    @if($nom == 'all')
        <x-listPatientDef name="2" :nom="1"/>
    @else
        <x-listPatientDef name="2" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
{{-- @if (isset($nom))
    @if($nom == 'all')
        <x-listPatient name="2" :nom="1"/>
    @else
        <x-listPatient name="2" :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif --}}

@if (isset($nom))
    @if($nom == 'all')
        <x-histSession/>
    @else
        <x-histSession/>
    @endif
@else
    Nous rencontrons un probleme
@endif
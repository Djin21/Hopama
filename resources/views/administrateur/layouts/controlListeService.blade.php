@if (isset($nom))
    @if($nom == 'all')
        <x-listService :nom="1"/>
    @else
        <x-listService :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
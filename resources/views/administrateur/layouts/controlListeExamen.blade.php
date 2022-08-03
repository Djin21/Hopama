@if (isset($nom))
    @if($nom == 'all')
        <x-listExamen :nom="1"/>
    @else
        <x-listExamen :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
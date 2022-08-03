@if (isset($nom))
    @if($nom == 'all')
        <x-listLits :nom="1"/>
    @else
        <x-listLits :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
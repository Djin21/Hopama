@if (isset($nom))
    @if($nom == 'all')
        <x-listComponent :examen="1"/>
    @else
        <x-listComponent :examen="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
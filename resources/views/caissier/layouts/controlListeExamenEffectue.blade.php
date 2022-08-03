@if (isset($nom))
    @if($nom == 'all')
        <x-listExamenEffectuer/>
    @else
        <x-listExamenEffectuer/>
    @endif
@else
    Nous rencontrons un probleme
@endif
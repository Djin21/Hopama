@if (isset($nom))
    @if($nom == 'all')
        <x-listExamenPrescrit/>
    @else
        <x-listExamenPrescrit/>
    @endif
@else
    Nous rencontrons un probleme
@endif
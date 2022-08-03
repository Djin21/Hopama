@if (isset($nom))
    @if($nom == 'all')
        <x-listRdvExamens :nom="1"/>
    @else
        <x-listRdvExamens :nom="$nom"/>
    @endif
@else
    Nous rencontrons un probleme
@endif
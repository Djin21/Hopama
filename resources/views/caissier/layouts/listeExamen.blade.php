<?php
    use App\Models\Examen;
    use App\Models\Service;
?>

<div class="mt-4">
@if ($nom == 'all')
    <?php
        $services = Service::where('consultable', 0)->get();
    ?>
    @foreach ($services as $service)
    
    <h5 class="ms-1 mt-4" style="font-weight: 600; color:rgb(119, 119, 119);">{{ $service->nom }}</h5>
    <?php
        $examens = Examen::where('service_id', $service->id)->get();
    ?>
    @foreach ($examens as $examen)
        
    <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start">
        <input
            name="examenVal[]"
            class="form-check-input check"
            type="checkbox"
            value="{{ $examen->id }}"
        />
        <span class="ms-3">{{ $examen->nom }}</span></td>
    </div>

    @endforeach

    @endforeach
@else

    <?php
        $services = Service::where('consultable', 0)->get();
    ?>
    @foreach ($services as $service)

    <?php
        $examens = Examen::where('service_id', $service->id)->where("nom", "LIKE", "%".$nom."%")->get();
    ?>
    @if ($examens->count() != 0)
        
    <h5 class="ms-1 mt-4" style="font-weight: 600; color:rgb(119, 119, 119);">{{ $service->nom }}</h5>
    
    @foreach ($examens as $examen)
        
    <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start">
        <input
            name="examenVal[]"
            class="form-check-input check"
            type="checkbox"
            value="{{ $examen->id }}"
        />
        <span class="ms-3">{{ $examen->nom }}</span></td>
    </div>

    @endforeach

    @endif

    @endforeach

@endif
</div>
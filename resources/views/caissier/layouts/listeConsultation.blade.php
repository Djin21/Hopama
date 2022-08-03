<?php

    use App\Models\Type_consultation;
    use App\Models\Service;

    // $type_consultations = Type_consultation::orderBy('nom')->get();

?>

<div class="mt-4">
    @if ($nom == 'all')
        <?php
            $services = Service::where('consultable', 1)->get();
        ?>
        @foreach ($services as $service)
        
        <h5 class="ms-1 mt-4" style="font-weight: 600; color:rgb(119, 119, 119);">{{ $service->nom }}</h5>
        <?php
            $type_consultations = Type_consultation::where('service_id', $service->id)->get();
        ?>
        @foreach ($type_consultations as $type_consultation)
            
        <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start medecinParam" onclick="refresh({{ $type_consultation->id }})">
            <input
                name="consultation"
                class="form-check-input check"
                type="radio"
                value="{{ $type_consultation->id }}"
            />
            <span class="ms-3">{{ $type_consultation->nom }}</span></td>
        </div>
    
        @endforeach
    
        @endforeach
    @else
    
        <?php
            $services = Service::where('consultable', 1)->get();
        ?>
        @foreach ($services as $service)
    
        <?php
            $type_consultations = Type_consultation::where('service_id', $service->id)->where("nom", "LIKE", "%".$nom."%")->get();
        ?>
        @if ($type_consultations->count() != 0)
            
        <h5 class="ms-1 mt-4" style="font-weight: 600; color:rgb(119, 119, 119);">{{ $service->nom }}</h5>
        
        @foreach ($type_consultations as $type_consultation)
            
        <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start medecinParam" onclick="refresh({{ $type_consultation->id }})">
            <input
                name="consultation"
                class="form-check-input check"
                type="radio"
                value="{{ $type_consultation->id }}"
            />
            <span class="ms-3">{{ $type_consultation->nom }}</span></td>
        </div>
    
        @endforeach
    
        @endif
    
        @endforeach
    
    @endif
    </div>
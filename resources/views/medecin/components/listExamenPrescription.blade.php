<?php
    use App\Models\Examen;

    $examens = Examen::orderBy('nom')->get();  
    if($nom != '10'){
        $examens = Examen::where('nom', "LIKE", "%".$nom."%")->orderBy('nom')->get();  
    }
    
?>
@if ($examens != Null)
    @foreach ($examens as $examen)
        <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start" style="cursor:pointer;" onclick="refresh({{ $examen->id }})">
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
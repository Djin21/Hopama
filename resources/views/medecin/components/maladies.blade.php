<?php
    use App\Models\Maladie;

    // $maladies = Maladie::orderBy('nom')->get();
    $maladiesss = Maladie::where('nom', "LIKE", "%".$nom."%")->orderBy('nom')->get();
    
?>

@if ($maladiesss != Null)
    @foreach ($maladiesss as $maladie)
        <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start medecinParam" onclick="setMaladie({{$maladie->id}})">
            
            <span class="ms-3">{{ $maladie->nom }}</span></td>
        </div>
    @endforeach
@endif
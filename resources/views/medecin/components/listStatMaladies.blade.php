<?php
    use App\Models\Maladie;
    // use App\Models\Consultations;
    if($nom == '10'){
        $maladiess = Maladie::orderBy('nom')->get();
    }else{
        $maladiess = Maladie::where('nom', 'LIKE', '%'.$nom.'%')->orderBy('nom')->get();
    }
    
?>

@foreach ($maladiess as $maladie)
    <?php
        // $cptConsultations = Consultation::where('resultat', 'LIKE', $maladie->nom)->get()->count();
    ?>
    <tr class="">
        <td>{{ $maladie->nom }}</td>
        <td class="text-end me-4">{{ $maladie->nombre }}</td>
    </tr>
@endforeach
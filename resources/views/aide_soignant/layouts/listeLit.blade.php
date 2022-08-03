<?php
    use App\Models\Lit;

    $lits = Lit::where('salle_id', $idSalle)->where('etat', 0)->get();
?>

<label for="emailWithTitle" class="form-label">Lit</label>
<select class="form-select" id="litSelect" aria-label="Default select example" name="selectLit" onchange="setLit()">
    @foreach ($lits as $lit)
        <option value="{{ $lit->id }}">Lit {{ $lit->numero }}</option>
    @endforeach
</select>
<label for="emailWithTitle" class="form-label">Lit</label>
<select class="form-select" id="" aria-label="Default select example" name="selectLit">
    @foreach ($lits as $lit)
        <option value="{{ $lit->id }}">Lit {{ $lit->numero }}</option>
    @endforeach
</select>
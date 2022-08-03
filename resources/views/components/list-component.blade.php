{{-- <div class=" py-4">
    <table class="table table-paiement">
        <h5>Liste des consultations</h5>
            @foreach ($type_consultations as $type_consultation)
            <tr onclick="save({{ $type_consultation->id }})" class="table-paiement-item">
                <td><input
                    name="exam"
                    class="form-check-input check"
                    type="radio"
                    value="{{ $type_consultation->id }}"
                    onclick="fresh({{ $type_consultation->id }})"
                  />
                  <span class="ms-3">{{ $type_consultation->nom }}</span></td>
                <td>{{ $type_consultation->prix }}</td>
            </tr>
            @endforeach
    </table>
</div> --}}
<div class=" py-4">
    <div class="table-paiement">
        <h5>Liste des consultations</h5>
            @foreach ($type_consultations as $type_consultation)
            <div onclick="save({{ $type_consultation->id }})" class="table-paiement-item">
                <div class="table-paiement-contenu d-flex flex-row px-3 py-3">
                    <div>
                <input
                    name="exam"
                    class="form-check-input check"
                    type="radio"
                    value="{{ $type_consultation->id }}"
                    onclick="fresh({{ $type_consultation->id }})"
                  />
                  <span class="ms-3" style="font-weight: 600; font-size: 1rem">{{ $type_consultation->nom }}</span></div>
                <div class="ms-auto me-5">{{ $type_consultation->prix }}</div>
            </div>
            </div>
            @endforeach
        </div>
</div>

{{-- <div class=" py-4">
    <div class="table-paiement">
        <h5>Liste des consultations</h5>
            @foreach ($type_consultations as $type_consultation)
            <div onclick="save({{ $type_consultation->id }})" class="table-paiement-item">
                <div class="table-paiement-contenu d-flex flex-row px-3 py-3">
                    <div>
                <input
                    name="exam"
                    class="form-check-input check"
                    type="radio"
                    value="{{ $type_consultation->id }}"
                    onclick="fresh({{ $type_consultation->id }})"
                  />
                  <span class="ms-3" style="font-weight: 600; font-size: 1rem">{{ $type_consultation->nom }}</span></div>
                <div class="ms-auto me-5">{{ $type_consultation->prix }}</div>
            </div>
            </div>
            @endforeach
        </div>
</div> --}}

<script>
    // alert(exams[0]);
</script>

{{-- <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script> --}}
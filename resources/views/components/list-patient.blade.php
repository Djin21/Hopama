<?php

use App\Models\Patient;
use App\Models\Session;

?>

@if ($name =='1' )
{{-- <div class=" py-4">
    <table class="table table-hover table-paiement" id="table_patient">
        <h5>Liste des patients</h5>
            @foreach ($patients as $patient)
            <tr onclick="save({{ $patient->id }})" class="pt-5 pb-3 table-paiement-item t2">
                <td id=""><input
                    name="patient"
                    class="form-check-input check"
                    type="radio"
                    value="{{ $patient->id }}"
                    onclick="refresh({{ $patient->id }})"
                  />
                  <span class="ms-3">{{ $patient->nom }} {{ $patient->prenom }}</span></td>
            </tr>
            @endforeach
    </table>
</div> --}}
<div class=" py-4">
  <div class="table-paiement" id="table_patient">
    <h5>Liste des patients</h5>
    @foreach ($patients as $patient)
      <?php
        $sessionCpt = Session::where('patient_id', $patient->id)->where('etat', 1)->get()->count();
        // $sessionCpt = 0;
      ?>
      <div onclick="save({{ $patient->id }})" class="table-paiement-item t2">
        <div class="table-paiement-contenu d-flex flex-row px-3 py-3">
          <div>
            <input
              name="patient"
              class="form-check-input check"
              type="radio"
              value="{{ $patient->id }}"
              onclick="refresh({{ $patient->id }})"
            />
              <span class="ms-3" style="font-weight: 600; font-size: 1rem">{{ $patient->nom }} {{ $patient->prenom }}</span>
          </div>
          <div class="ms-auto me-5">{{ $sessionCpt > 0 ? 'En cours' : 'Terminer' }}</div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endif

@if ($name == '2')
<?php echo 'tetst';?>
  @if (isset($nom))
    <?php
      $sessions = array();
      $cpt = $patients->count();
      for($i = 0; $i < $cpt; $i++){
        $sessions[$i] = Session::where('patient_id', $patients[$i]->id)->firstOrFail();
      }
      // $sessions = Session::where();
      dd($session);
    ?>
  @else
    <?php
      $sessions = Session::orderBy('created_at')->get();
    ?>
  @endif

@foreach ($sessions as $session)
<?php
  $patient = Patient::where('id', $session->patient_id)->firstOrFail();
?>
<tr>
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    <?php

        // $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[0];
        //  
        // $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[$dates->count()-1]->created_at;
    ?>
    <td>{{ $session->created_at->format('d/m/Y | h:i') }}</td>
    {{-- <td>23/23/2333</td> --}}
    <td><span class="badge bg-label-primary">Suivit</span></td>
    <td>
      <button
        type="button"
        class="btn text-nowrap"
        data-bs-toggle="popover"
        data-bs-offset="0,14"
        data-bs-placement="bottom"
        data-bs-html="true"
        data-bs-content="<a class='dropdown-item' href='{{ route('aide_soignant.profile_patient', ['idPatient' => $patient->id]) }}'><i class='bx bx-edit-alt me-1'></i> Modifier</a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Supprimer</a>" 
        title=""
      >
        <i class="bx bx-dots-vertical-rounded"></i>
      </button>
    </td>
  </tr>
@endforeach
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>

@endif

@if ($name == '3')
@foreach ($patients as $patient)
<tr>
    <td><strong>{{ $patient->nom }} {{ $patient->prenom }} </strong></td>
    <?php

        $dates = Paiement::where('patient_id', $patient->id)->get();
        // $datePass = $dates[0];
        //  
        $dates = Paiement::where('patient_id', $patient->id)->get();
        $datePass = $dates[$dates->count()-1]->created_at;
    ?>
    <td>{{ $datePass->format('d/m/Y | h:i') }}</td>
    {{-- <td>23/23/2333</td> --}}
    <td><span class="badge bg-label-primary">Suivit</span></td>
    <td>
      <button
        type="button"
        class="btn text-nowrap"
        data-bs-toggle="popover"
        data-bs-offset="0,14"
        data-bs-placement="bottom"
        data-bs-html="true"
        data-bs-content="<a class='dropdown-item' href='{{ route('medecin.profile_patient', ['idPatient' => $patient->id]) }}'><i class='bx bx-edit-alt me-1'></i> Modifier</a><a class='dropdown-item' href='javascript:void(0);'><i class='bx bx-bar-chart me-1'></i> Supprimer</a>" 
        title=""
      >
        <i class="bx bx-dots-vertical-rounded"></i>
      </button>
    </td>
  </tr>
@endforeach
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>

@endif
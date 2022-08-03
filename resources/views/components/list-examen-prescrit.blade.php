<?php

use App\Models\Patient;
use App\Models\Session;
use App\Models\Validite;
use App\Models\Prescription;
use App\Models\Consultation;
use App\Models\Examen_prescrit;
use App\Models\Examen;

$pat = [0];
$i = 1;
?>


@foreach ($examenPrescrits as $examenPrescrit)
@if ($examenPrescrit->dateRealisation == Null)
    <?php
        $prescription = Prescription::where('id', $examenPrescrit->prescription_id)->first();
        $consultation = Consultation::where('id', $prescription->consultation_id)->first();
        $session = Session::where('id', $consultation->session_id)->first();
        $patient = Patient::where('id', $session->patient_id)->first();
        
    ?>
    @if (!array_search($patient->id, $pat, true))
        <?php
            $pat[$i] = $patient->id;
            $i = $i + 1;
            date_default_timezone_set("Africa/Douala");
            $date = date('Y/m/d');
            $x1 = date_create("$date");
            $d2 = $session->created_at;
            $validite = Validite::where('id', $session->validite_id)->firstOrFAil()->validite;
            date_add($d2, date_interval_create_from_date_string("$validite days"));
            $y = date_format($d2, "Y/m/d");
            $x2 = date_create("$d2");
            $z = date_diff($x1, $x2);
            $diff = (int)$z->format("%a");
            $valid = 0;
            if($diff > 0){
                $valid = 1;
            }else{
                $valid = 0;
            }
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
            <td><span class="badge bg-label-primary">{{ $valid == 1 ? 'Valide' : 'Invalide' }}</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu py-3">
                  <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" data-bs-toggle='modal' data-bs-target='#modalPayExam{{ $patient->id }}'
                    ></i><i class='bx bx-edit-alt me-1'></i>Consulter</a
                  >
                </div>
              </div>
              <form action="{{ route('caisse.savePaiementExamen', ['idPrescription' => $prescription->id]) }}" method="post">
                @csrf
                <input type="text" name="type" value="1" class="d-none">
                <input type="text" name="patient_id" value="{{ $patient->id }}" class="d-none">
                <div class="modal fade" id="modalPayExam{{ $patient->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalCenterTitle">Paiement</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-md-2">
                        <div class="col mb-0 text-start">
                          <h6>Choisissez l'examen </h6>
                        </div>
                      </div>
                      <div class="row g-md-2 mb-4 newExamen">
                        <div class="col mb-0 text-start">
                          <?php
                            $examPres = Examen_prescrit::where('prescription_id', $prescription->id)->where('etatPaiement', 0)->get();
                            
                          ?>
                          @foreach ($examPres as $exam)
                              <?php
                                  $examen = Examen::where('id', $exam->examen_id)->first();
                              ?>
                              <div class="card p-3 mb-1 d-flex flex-row align-items-center justify-content-start">
                                <input
                                    name="examenVal[]"
                                    class="form-check-input check"
                                    type="checkbox"
                                    value="{{ $exam->id }}"
                                />
                                <span class="ms-3">{{ $examen->nom }}</span>
                                <span class="ms-auto me-2">{{ $examen->prix }}</span>
                              </div>
                            @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Annuler
                      </button>
                      <button type="submit" class="btn btn-primary">Payer</button>
                    </div>
                  </div>
                </div>
              </form>
            </td>
        </tr>
    @endif
@endif
@endforeach

{{-- @foreach ($sessions as $session)
@if ($session->nbrConsultation == 0)
<?php
//   date_default_timezone_set("Africa/Douala");
//   $date = date('Y/m/d');
//   $x1 = date_create("$date");
//   $d2 = $session->created_at;
//   $validite = Validite::where('id', $session->validite_id)->firstOrFAil()->validite;
//   date_add($d2, date_interval_create_from_date_string("$validite days"));
//   $y = date_format($d2, "Y/m/d");
//   $x2 = date_create("$d2");
//   $z = date_diff($x1, $x2);
//   $diff = (int)$z->format("%a");
//   $valid = 0;
//   if($diff > 0){
//     $valid = 1;
//   }else{
//     $valid = 0;
//   }
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
    <td><span class="badge bg-label-primary">{{ $valid == 1 ? 'Valide' : 'Invalide' }}</span></td>
    <td>
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu py-3">
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;" href='{{ route('aide_soignant.profile_patient', ['idPatient' => $patient->id]) }}'
            ></i><i class='bx bx-edit-alt me-1'></i>Consulter</a
          >
          <a class="dropdown-item my-1" style="text-decoration: none; cursor: pointer;"
            ><i class="bx bx-trash me-1"></i> Supprimer</a
          >
        </div>
      </div>
    </td>
</tr>

  @endif
@endforeach --}}
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>
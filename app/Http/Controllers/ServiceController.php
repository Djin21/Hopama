<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Personnel;
use App\Models\Service;
use App\Models\Paiement;
use App\Models\Examen_effectue;
use App\Models\Examen_prescrit;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Session;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function dashboard(Request $request){
        $consultations = Session::where("created_at", "LIKE", date("Y-m-d")."%")->get();
        $examens = Paiement::where("created_at", "LIKE", date("Y-m-d")."%")->get();
        $total = $consultations->count() + $examens->count();
        $consulPercent = 0;
        $examPercent = 0;
        $prixExamen = 0;
        $totalRevAnneeExam = [];
        $i = 0;
        for($i = 0; $i < 12; $i++){
            $j = $i + 1;
            $exam = Paiement::where("created_at", "LIKE", date("Y-0$j")."%")->get();
            $tmp = 0;
            if($exam !=  Null){
                foreach ($exam as $key => $value) {
                    $exa = Examen::where('id', $value->examen_id)->first();
                    $tmp = $tmp + $exa->prix;
                }
            }
            $totalRevAnneeExam[$i] = $tmp;
        }
        foreach ($examens as $key => $value) {
            $exam = Examen::where('id', $value->examen_id)->first();
            $prixExamen = $prixExamen + $exam->prix;
        }
        if($total != 0){
            $consulPercent = ($consultations->count() / $total) * 100;
            $examPercent = ($examens->count() / $total) * 100;
        }
        return view('service.index', [
            'personnel' => Personnel::where('id', $request->session()->get('idPersonnel'))->first(),
            'consultations' => $consultations,
            'examens' => $examens,
            'total' => $total,
            'consultPercent' => $consulPercent,
            'examPercent' => $examPercent,
            'prixExamens' => $prixExamen,
            'totalRevAnneeExam' => $totalRevAnneeExam
        ]);
    }

    public function showNewRDV(){
        return view('service.nouveauRDV');
    }

    public function showHistorique(Request $request){
        $idPersonnel = $request->session()->get('idPersonnel');
        $personnel = Personnel::where('id', $idPersonnel)->first();
        $service = Service::where('id', $personnel->service_id)->first();
        $examens = Examen::where('service_id', $service->id)->get();
        $examens = [];
        $i = 0;
        $paiements = Paiement::orderBy('created_at')->get();
        if($paiements != Null)
        {
            foreach ($paiements as $key => $paiement) {
                if(Examen_effectue::where('paiement_id', $paiement->id)->first() != Null){
                    $exam = Examen::where('id', $paiement->examen_id)->first();
                    if($exam->service_id == $service->id){
                        $examens[$i] = $paiement;
                        $i = $i + 1;
                    }
                }
            }
            
            return view('service.historique', [
                'paiements' => $examens
            ]);
        }else{
            return view('service.historique');
        }
    }

    public function showHistoriqueGlobal(Request $request){
        $idPersonnel = $request->session()->get('idPersonnel');
        $personnel = Personnel::where('id', $idPersonnel)->first();
        $service = Service::where('id', $personnel->service_id)->first();
        $examens = Examen::where('service_id', $service->id)->get();
        $examens = [];
        $i = 0;
        $paiements = Paiement::orderBy('created_at')->get();
        if($paiements != Null)
        {
            foreach ($paiements as $key => $paiement) {
                if(Examen_effectue::where('paiement_id', $paiement->id)->first() != Null){
                    $exam = Examen::where('id', $paiement->examen_id)->first();
                    if($exam->service_id == $service->id){
                        $examens[$i] = $paiement;
                        $i = $i + 1;
                    }
                }
            }
            
            return view('service.historique', [
                'paiements' => $examens
            ]);
        }else{
            return view('service.historique');
        }
    }

    public function showListeExamen(Request $request){
        $idPersonnel = $request->session()->get('idPersonnel');
        $personnel = Personnel::where('id', $idPersonnel)->first();
        $service = Service::where('id', $personnel->service_id)->first();
        $examens = Examen::where('service_id', $service->id)->get();
        $examens = [];
        $i = 0;
        $paiements = Paiement::orderBy('created_at')->get();
        if($paiements != Null)
        {
            foreach ($paiements as $key => $paiement) {
                if(Examen_effectue::where('paiement_id', $paiement->id)->where('personnel_id', $idPersonnel)->first() == Null){
                    $exam = Examen::where('id', $paiement->examen_id)->first();
                    if($exam->service_id == $service->id){
                        $examens[$i] = $paiement;
                        $i = $i + 1;
                    }
                }
            }
            
            return view('service.examenList', [
                'paiements' => $examens
            ]);
        }else{
            return view('service.examenList');
        }
    }

    public function setResult(Request $request){
        Examen_effectue::create([
            'resultat' => $request->resultat,
            'paiement_id' => Paiement::where('id', $request->paiement)->first()->id,
            'personnel_id' => $request->session()->get('idPersonnel')
        ]);
        $paiement = Paiement::where('id', $request->paiement)->first();
        $patient = Patient::where('id', $paiement->patient_id)->first();
        $sessions = Session::where('patient_id', $patient->id)->get();
        $service = Null;
        foreach ($sessions as $key => $session) {
            if($session->service_id != $service)
            {
                $state = 0;
                $consultations = Consultation::where('session_id', $session->id)->get();
                foreach ($consultations as $key => $consultation) {
                    $prescription = Prescription::where('consultation_id', $consultation->id);
                    if($examensPres = Examen_prescrit::where('examen_id', $paiement->examen_id)->first() != Null){
                        $examensPres = Examen_prescrit::where('examen_id', $paiement->examen_id)->update([
                            'resultat' => $request->resultat,
                            'dateRealisation' => date('Y-m-d')
                        ]);
                        $state = 1;
                        break;
                    }
                }
                $service = $session->service_id;
            }
        }
        // $examen = Examen::where('id', Paiement::where('id', $request->paiement)->first()->examen_id)->first();
        // Examen_prescrit::where('examen_id', $examen->id)->get();
        return redirect()->route('service.examenListe');
    }
}

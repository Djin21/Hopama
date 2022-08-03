<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Examen_effectue;
use App\Models\Examen_prescrit;
use App\Models\Hospitalisation;
use App\Models\Paiement;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Personnel;
use App\Models\Prescription;
use App\Models\Rdv;
use App\Models\Session;
use App\Models\Parametre;
use App\Models\Antecedent;
use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    public function connexion(){
        return view('formulaire');
    }

    public function login(Request $request){
        // $routes = [
        //     'Laboratoire' => 'service.index',
        //     'Echographie' => 'service.index',
        //     'Accueil' => 'aide_soignant.index',
        //     'Medecin' => 'medecin.index',
        //     'caissier' => 'caissier.index'
        // ];
        
        // $service = Service::where('nom', $request->service)->firstOrFail();
        // if($service->code == $request->code){
        //     return view($routes[$service->nom]);
        // }
        if($request->service == 1 && $request->code == '12345'){
            return redirect()->route('admin.dashboard');
        }else{
            $personnel = Personnel::where('code', $request->code)->first();
            if($personnel != Null){
                $service = Service::where('id', $personnel->service_id)->first();
                $request->session()->put('idPersonnel', $personnel->id);
                $request->session()->put('service_id', $personnel->service_id);
                if($service->consultable == 1 && $request->service == 1){
                    return redirect()->route('medecin.dashboard');
                }elseif ($service->consultable == 0 && $request->service == 2) {
                    return redirect()->route('service.dashboard');
                }elseif ($service->consultable == 2 && $request->service == 0) {
                    return redirect()->route('aide_soignant.dashboard');
                }elseif ($service->consultable == 3 && $request->service == 3) {
                    return redirect()->route('caisse.dashboard');
                }else{
                    return view('formulaire', [
                        'erreur' => 1
                    ]);
                }
            }else{
                return view('formulaire', [
                    'erreur' => 1
                ]);
            }
        }
        
        // return view('aide_soignant.index');
    }

    public function showListePatient($name){
        $nom = $name;
        return view('global.controlListePatient', [
            'nom' => $nom
        ]);
    }

    public function showDossierPatient($idPatient){
        $patient = Patient::where('id', $idPatient)->first();
        $examensEff = [];
        $paiements = Paiement::where('patient_id', $patient->id)->get();
        foreach ($paiements as $key => $paiement) {
            $examensEff[$key] = Examen_effectue::where('paiement_id', $paiement->id)->first();
        }
        $sessions = Session::where('patient_id', $idPatient)->get();
        $consultations = [];
        $rdvs = [];
        foreach ($sessions as $key => $session) {
            $consultations[$session->id] = Consultation::where('session_id', $session->id)->get();
        }
        $prescriptions = [];
        foreach ($consultations as $key => $consultation) {
            foreach ($consultation as $key => $consult) {
                $prescriptions[$consult->id] = Prescription::where('consultation_id', $consult->id)->first();
                if(Rdv::where('consultation_id', $consult->id)->first() != Null){
                    $rdvs[$consult->id] = Rdv::where('consultation_id', $consult->id)->first();
                }   
            }
        }
        $examenPrescrits = [];
        $hospitalisations = [];
        foreach ($prescriptions as $key => $prescription) {
            if($prescription != Null){
                $examenPrescrits[$key] = Examen_prescrit::where('prescription_id', $prescription->id)->get();
                $hospitalisations[$key] = Hospitalisation::where('prescription_id', $prescription->id)->first();
            }
        }
        $examenPayer = Paiement::where('patient_id', $idPatient)->get();
        return view('global.dossierPatient',[
            'patient' => $patient,
            'consultations' => $consultations,
            'rdvs' => $rdvs,
            'examenPrescrits' => $examenPrescrits,
            'examenPayer' => $examenPayer,
            'hospitalisations' => $hospitalisations,
            'examensEff' => $examensEff
        ]);
    }

    public function showAgePatient(){
        return view('global.agePatient');
    }

    public function showProfil($idConsultation){
        $consultation = Consultation::where('id', $idConsultation)->first();
        $session = Session::where('id', $consultation->session_id)->first();
        $patient = Patient::where('id', $session->patient_id)->first();
        $parametres = Parametre::where('patient_id', $patient->id)->where('consultation_id', $consultation->id)->first();
        $antecedents = Antecedent::where('patient_id', $patient->id)->get();
        return view('global.profilConsultationPatient',[
            'consultation' => $consultation,
            'session' => $session,
            'patient' => $patient,
            'parametres' => $parametres,
            'antecedents' => $antecedents
        ]);
    }

    public function sendSmsOne($idPatient){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.avlytext.com/v1/sms?api_key=LQl8VULwNEdHR00Kemzs9OUphnhL5TeaIompKhDU7qT065b8wwzYCH5RC68cWlKcvDE1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "sender": "CMNB",
            "recipient": "+237693188905",
            "text": "Bonjour\nNous sommes le Centre Medical Nana Bouba, Meiganga.\nNous vous ecrivons pour vous rappeler que vous avez un rendez-vous demain."
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        // return redirect()->route('medecin.profile_patient', ['idConsultation' => $idConsultation]);
        dd($response);
    }

    public function showDynListePatient($nom){
        $patients = Patient::where('nom', 'LIKE', '%'.$nom.'%')->get();
        return view('global.dynListePatient', [
            'patients' => $patients
        ]);
    }

}

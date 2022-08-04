<?php

namespace App\Http\Controllers;

use App\Models\Accouchement;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Lit;
use App\Models\Maladie;
use App\Models\Personnel;
use App\Models\Salle;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Validite;
use App\Models\Rdv;
use App\Models\Session;
use App\Models\Type_consultation;

class AdminController extends Controller
{
    public function dashboard(){
        return view('administrateur.index');
    }

    public function showExamen(){
        return view('administrateur.examen');
    }

    public function showService(){
        return view('administrateur.service');
    }

    public function showPersonnel(){
        return view('administrateur.personnel');
    }

    public function showSalle(){
        return view('administrateur.salle');
    }

    public function showConsultation(){
        return view('administrateur.consultation');
    }

    public function showMsgDiffus(){
        return view('administrateur.msgDiffusion');
    }

    public function showNewMsgDiffus(){
        return view('administrateur.newMsgDiff');
    }

    public function showListePatientDyn($nom){
        return view('administrateur.layouts.listePatient', ['nom' => $nom]);
    }

    public function showListePatientStat($nom){
        return view('administrateur.layouts.listePatientStat', ['nom' => $nom]);
    }

    public function afficherListeExamen($name){
        $nom = $name;
        return view('administrateur.layouts.controlListeExamen', [
            'nom' => $nom
        ]);
    }

    public function afficherListeService($name){
        $nom = $name;
        return view('administrateur.layouts.controlListeService', [
            'nom' => $nom
        ]);
    }

    public function afficherListePersonnel($name){
        $nom = $name;
        return view('administrateur.layouts.controlListePersonnel', [
            'nom' => $nom
        ]);
    }

    public function afficherListeSalle($name){
        $nom = $name;
        return view('administrateur.layouts.controlListeSalle', [
            'nom' => $nom
        ]);
    }

    // public function showFormExamen(){
    //     return view('administrateur.ajouter_examen');
    // }

    // public function ajouterExamen(Request $request){
    //     $state = 1;
    //     Examen::create([
    //         'nom' => $request->nomExamen,
    //         'prix' => $request->prixExamen,
    //         'service_id' => $request->service,
    //     ]);
    //     return view('administrateur.ajouter_examen',[
    //         'state' => $state
    //     ]);
    // }
    // Oi32pRYjRFj66dHpZ3dcFeWmuHYHqrX1yolkdov3kO5nuan3dYV8bayTrgJyypEfqn44 : api key
    public function modifierExamen(Request $request, $idExamen){
        date_default_timezone_set("Africa/Douala");
        if($idExamen == 0){
            Examen::create([
                'nom' => $request->nomExamen,
                'prix' => $request->prixExamen,
                'service_id' => $request->service
            ]);
        }else{
            Examen::where('id', $idExamen)->update([
                'nom' => $request->nomExamen,
                'prix' => $request->prixExamen,
                'service_id' => $request->service
            ]);
        }
        
        return view('administrateur.examen');
    }

    public function modifierConsultation(Request $request, $idConsultation){
        date_default_timezone_set("Africa/Douala");
        if($request->type == 1){
            Type_consultation::create([
                'nom' => "Consultation ".$request->nomConsultation,
                'prix' => $request->prixConsultation,
                'service_id' => $request->service
            ]);
        }elseif($request->type == 2){
            Type_consultation::where('id', $idConsultation)->update([
                'nom' => "Consultation ".$request->nomConsultation,
                'prix' => $request->prixConsultation,
                'service_id' => $request->service
            ]);
        }else{
            Type_consultation::where('id', $idConsultation)->delete();
        }
        
        return redirect()->route('admin.consultation');
    }

    public function modifierService(Request $request, $idService){
        date_default_timezone_set("Africa/Douala");
        if($idService == 0){
            if(strcmp(strtolower($request->nomService), "caisse") == 0){
                Service::create([
                    'nom' => ucfirst(strtolower($request->nomService)),
                    // 'code' => $request->codeService,
                    'consultable' => 3
                    // 'service_id' => $request->service
                ]);
            }else if(strcmp(strtolower($request->nomService), "accueil") == 0){
                Service::create([
                    'nom' => ucfirst(strtolower($request->nomService)),
                    // 'code' => $request->codeService,
                    'consultable' => 2
                    // 'service_id' => $request->service
                ]);
            }else{

                Service::create([
                    'nom' => ucfirst(strtolower($request->nomService)),
                    // 'code' => $request->codeService,
                    'consultable' => $request->consultable
                    // 'service_id' => $request->service
                ]);
            }
            // dd($request->consultable);
        }else{
            Service::where('id', $idService)->update([
                'nom' => ucfirst(strtolower($request->nomService)),
                // 'code' => $request->codeService,
                'consultable' => $request->consultable
                // 'service_id' => $request->service
            ]);
        }
        
        return view('administrateur.service');
    }

    public function modifierPersonnel(Request $request, $idPersonnel){
        date_default_timezone_set("Africa/Douala");
        if($idPersonnel == 0){
            Personnel::create([
                'nom' => $request->nomPersonnel,
                'prenom' => $request->prenomPersonnel,
                'sexe' => $request->sexePersonnel == 'masculin' ? 0 : 1,
                'dateNaiss' => $request->dateNaissPersonnel,
                'lieuNaiss' => $request->lieuNaissPersonnel,
                'telephone' => $request->telPersonnel,
                'service_id' => $request->service,
                'code' => $request->codePersonnel
                // 'service_id' => $request->service
            ]);
            
        }else{
            Personnel::where('id', $idPersonnel)->update([
                'nom' => $request->nomPersonnel,
                'prenom' => $request->prenomPersonnel,
                'sexe' => $request->sexePersonnel == 'masculin' ? 0 : 1,
                'dateNaiss' => $request->dateNaissPersonnel,
                'lieuNaiss' => $request->lieuNaissPersonnel,
                'telephone' => $request->telPersonnel,
                'service_id' => $request->service,
                'code' => $request->codePersonnel,
                // 'service_id' => $request->service
            ]);
        }
        
        return view('administrateur.personnel');
    }

    public function modifierSalle(Request $request, $idSalle){
        date_default_timezone_set("Africa/Douala");

        if(isset($_POST['ajouter_lit'])){
            Lit::create([
                'numero' => Salle::where('id', $idSalle)->firstOrFail()->nombreLit + 1,
                'etat' => 0,
                'salle_id' => $idSalle
            ]);
            Salle::where('id', $idSalle)->update([
                'nombreLit' => Salle::where('id', $idSalle)->firstOrFail()->nombreLit + 1,
            ]);
            return view('administrateur.salle', [
                'etatLit' => Salle::where('id', $idSalle)->firstOrFail()->nom
            ]);
        }else{
            if($idSalle == 0){
                Salle::create([
                    'nom' => $request->nomSalle,
                    'description' => $request->descriptionSalle,
                    'nombreLit' => 0
                    // 'service_id' => $request->service
                ]);
                return view('administrateur.salle', [
                    'etatSalle' => 0
                ]);
            }else{
                Salle::where('id', $idSalle)->update([
                    'nom' => $request->nomSalle,
                    'description' => $request->descriptionSalle,
                    // 'service_id' => $request->service
                ]);
                return view('administrateur.salle', [
                    'etatUpdateSalle' => 0
                ]);
            }
        }
        
    }

    public function supprimerExamen($idExamen){
        Examen::where('id', $idExamen)->delete();
        return view('administrateur.examen');
    }

    public function restaurerExamen(){
        Examen::withTrashed()->restore();
        return view('administrateur.examen');
    }

    public function supprimerService($idService){
        Service::where('id', $idService)->delete();
        Examen::where('service_id', $idService)->delete();
        return view('administrateur.service');
    }

    public function restaurerService(){
        Service::withTrashed()->restore();
        return view('administrateur.service');
    }

    public function supprimerPersonnel($idPersonnel){
        Personnel::where('id', $idPersonnel)->delete();
        return view('administrateur.personnel');
    }

    public function restaurerPersonnel(){
        Personnel::withTrashed()->restore();
        return view('administrateur.personnel');
    }

    public function supprimerSalle($idSalle){
        Salle::where('id', $idSalle)->delete();
        return view('administrateur.salle');
    }

    public function restaurerSalle(){
        Salle::withTrashed()->restore();
        return view('administrateur.salle');
    }

    public function supprimerLit($idLit){
        $salle = Salle::where('id', Lit::where('id', $idLit)->firstOrFail()->salle_id)->firstOrFail();
        Salle::where('id', Lit::where('id', $idLit)->firstOrFail()->salle_id)->update([
            'nombreLit' => $salle->nombreLit - 1
        ]);
        Lit::where('id', $idLit)->delete();
        return view('administrateur.salle');
    }

    public function modifierValidite(Request $request){
        Validite::create([
            'validite' => $request->validite 
        ]);
        return view('administrateur.consultation');
    }

    public function sendMsgMultiple(Request $request){
        if($request->msgDiffus != Null && $request->patient != Null){
            // dd($request->patient );
            foreach ($request->patient as $key => $idPat) {
                $patient = Patient::where('id', (int)$idPat)->first();
                if($patient->telephone != Null){
                    $reponse = $this->sendSmsOne($patient->telephone, $request->msgDiffus);
                    if($reponse == false){
                        return redirect()->route('admin.newMsgDiffus', [
                            'state' => 1
                        ]);
                    }
                }
            }
        }else{
            dd('Mauvais');
        }
        return redirect()->route('admin.newMsgDiffus');
    }

    public function sendSmsOne($num, $msg){
        $numero = "+237$num";
        $curl = curl_init();
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://api.avlytext.com/v1/sms?api_key=LQl8VULwNEdHR00Kemzs9OUphnhL5TeaIompKhDU7qT065b8wwzYCH5RC68cWlKcvDE1',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'POST',
        // CURLOPT_POSTFIELDS =>"{
        //     \"sender\": 'CMNB',
        //     \"recipient\": \"$numero\",
        //     \"text\": \"$msg\"
        // }",
        // CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/json'
        // ),
        // ));

        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.avlytext.com/v1/sms?api_key=oqJjUKaJ4BjBrKA4B4jrF3WzuXrRt5X8YU4qOIW1jGsy7Wymalp68MH6qBAU0dYlvkg0&sender=CMNB&recipient=$numero&text=$msg.",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;

        // $response = curl_exec($curl);

        // return redirect()->route('medecin.profile_patient', ['idConsultation' => $idConsultation]);
        // dd($response);
    }

    public function showStatAccouchement(Request $request){
        $intervalles = [date("Y-m-01"), date("Y-m-d")];
        if($request->minAccouch != Null){
            $d = date_create("$request->minAccouch");
            $intervalles[0] = date_format($d, "Y-m-d");
        }
        if($request->maxAccouch != Null){
            $d = date_create("$request->maxAccouch");
            $intervalles[1] = date_format($d, "Y-m-d");
        }

        $intervallePatient = [date("2000-m-d"), date("Y-m-d")];
        $minAge = (int)date("Y") - (int)date("Y");
        $maxAge = (int)date("Y") - 2000;
        if($request->minPat != Null){
            $minAge = (int)$request->minPat;
            $min = (int)date("Y") - (int)$request->minPat;
            $d = date_create("01-12-$min");
            $intervallePatient[1] = date_format($d, "Y-m-d");
            // $intervallePatient[0] = $min;
        }
        if($request->maxPat != Null){
            $maxAge = (int)$request->maxPat;
            $max = (int)date("Y") - (int)$request->maxPat;
            $d = date_create("01-01-$max");
            $intervallePatient[0] = date_format($d, "Y-m-d");
            // $intervallePatient[0] = $max;
        }
        $nbrPatientsAgeAnnee = [];
        $nbrConsultAgeAnnee = [];
        for($i = 0; $i < 12; $i++){
            $nbrPatientsAgeAnnee[$i] = 0;
            $nbrConsultAgeAnnee[$i] = 0;
        }
        $pats = Patient::whereBetween('dateNaiss',  [$intervallePatient[0], $intervallePatient[1]])->get();
        $patsMois = Patient::all();
        $totalPatientsAgeMois = 0;
        foreach ($pats as $key => $value) {
            $ses = Session::where('patient_id', $value->id)->get();
            for($i = 0; $i < 12; $i++){
                $tmp = 0;
                $j = $i + 1;
                foreach ($ses as $key => $row) {
                    $cons = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->where('session_id', $row->id)->where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
                    $tmp += $cons;
                }
                $nbrConsultAgeAnnee[$i] += $tmp;
                $val = 1;
                if($tmp == 0){
                    $val = 0;
                }
                $nbrPatientsAgeAnnee[$i] += $val;
            }
        }
        foreach ($pats as $key => $value) {
            $sesTmp = Session::where('patient_id', $value->id)->get();
            $tmp = 0;
            $j = (int)date('m');
            foreach ($sesTmp as $key => $row) {
                $cons = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->where('session_id', $row->id)->where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
                $tmp += $cons;
            }
            if($tmp != 0){
                $totalPatientsAgeMois++;
            }
            // $totalPatientsAgeMois++;
        }
        $nbrPatientsAgeMois = $nbrPatientsAgeAnnee[(int)date('m')-1];
        // if(request(key: 'min')){
        //     dd(request(key: 'min'));
        //     $intervalles[0] = request(key: 'min');
        // }
        // if(request(key: 'max')){
        //     $intervalles[0] = request(key: 'max');
        // }
        // dd(Accouchement::where('created_at', ">=", $intervalles[1])->get()->count());
        $nbrAccouchements = Accouchement::whereBetween('created_at', [$intervalles[0], $intervalles[1]])->get();
        $totalAccouchements = [];
        $totalNaissances = [];
        $totalDeces = [];
        for($i=0; $i<12; $i++){
            $j = $i + 1;
            $totalNaissances[$i] = 0;
            $totalDeces[$i] = 0;
            $totalAccouchements[$i] = Accouchement::where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
            // $totalNaissances[$i] = Accouchement::where('nbrEnfant', "!=", 0)->where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
            // $totalDeces[$i] = Accouchement::where('nbrDeces', "!=", 0)->where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
            $naissances = Accouchement::where('nbrEnfant', "!=", 0)->where('created_at', "LIKE", date("Y-0$j")."%")->get();
            foreach ($naissances as $key => $value) {
                $totalNaissances[$i] += $value->nbrEnfant;
            }
            $deces = Accouchement::where('nbrDeces', "!=", 0)->where('created_at', "LIKE", date("Y-0$j")."%")->get();
            foreach ($deces as $key => $value) {
                $totalDeces[$i] += $value->nbrDeces;
            }
        }
        $naissances = Accouchement::where('nbrEnfant', "!=", 0)->whereBetween('created_at', [$intervalles[0], $intervalles[1]])->get();
        $nbrNaissances = 0;
        $deces = Accouchement::where('nbrDeces', "!=", 0)->whereBetween('created_at', [$intervalles[0], $intervalles[1]])->get();
        $nbrDeces = 0;
        foreach ($naissances as $key => $value) {
            $nbrNaissances += $value->nbrEnfant;
        }
        foreach ($deces as $key => $value) {
            $nbrDeces += $value->nbrDeces;
        }
        // dd($nbrAccouchements);
        $consults = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->get();
        $consultsMois = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->where('created_at', "LIKE", date("Y-m")."%")->get();
        // dd($consults);
        $rdvs = [];
        $rdvsToday = [];
        foreach ($consults as $key => $consult) {
            $rdvs[$key] = Rdv::where('consultation_id', $consult->id)->first();
            if(Rdv::where('consultation_id', $consult->id)->where('date', "LIKE", date("Y-m-d")."%")->first() != Null){
                $rdvsToday[$key] = Rdv::where('consultation_id', $consult->id)->where('date', "LIKE", date("Y-m-d")."%")->first();
            }
            // dd(Rdv::where('consultation_id', 2)->first()->date);
        }
        $i = 0;

        // Nombre de consultations par mois
        $totalConsultAnnee = [];
        for($i = 0; $i < 12; $i++){
            $j = $i + 1;
            $totalConsultAnnee[$i] = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->where('created_at', "LIKE", date("Y-0$j")."%")->get()->count();
        }
        $totalConsultMois = $totalConsultAnnee[(int)date('m')-1];
        $consultations = Consultation::where('created_at', "LIKE", date("Y")."%")->get();
        $consultHommes = [];
        $consultFemmes = [];
        for($i = 0; $i < 12; $i++){
            $j = $i + 1;
            $tmpHommes = 0;
            $tmpFemmes = 0;
            $consultTmp = Consultation::where('personnel_id', $request->session()->get('idPersonnel'))->where('created_at', "LIKE", date("Y-0$j")."%")->get();
            foreach ($consultTmp as $key => $value) {
                $session = Session::where('id', $value->session_id)->first();
                $patient = Patient::where('id', $session->patient_id)->first();
                if($patient->sexe == 0){
                    $tmpHommes++;
                }else{
                    $tmpFemmes++;
                }
            }
            $consultHommes[$i] = $tmpHommes;
            $consultFemmes[$i] = $tmpFemmes;
        }

        return view('administrateur.statAccouchement', [
            'personnel' => Personnel::where('id', $request->session()->get('idPersonnel'))->first(),
            'rdvs' => $rdvs,
            'rdvsToday' => $rdvsToday,
            'consultsMois' => $consultsMois,
            'totalConsultAnnee' => $totalConsultAnnee,
            'nbrAccouchements' => $nbrAccouchements,
            'nbrNaissances' => $nbrNaissances,
            'nbrDeces' => $nbrDeces,
            'consultHommes' => $consultHommes,
            'consultFemmes' => $consultFemmes,
            'nbrPatientsAgeAnnee' => $nbrPatientsAgeAnnee,
            'nbrPatientsAgeMois' => $nbrPatientsAgeMois,
            'totalPatientsAgeMois' => $totalPatientsAgeMois,
            'minAge' => $minAge,
            'maxAge' => $maxAge,
            'totalConsultMois' => $totalConsultMois,
            'totalAccouchements' => $totalAccouchements,
            'totalNaissances' => $totalNaissances,
            'totalDeces' => $totalDeces
        ]);
    }

    public function showStatDiagnostique(Request $request){
        $intervallePatient = [date("2000-m-d"), date("Y-m-d")];
        $minAge = (int)date("Y") - (int)date("Y");
        $maxAge = (int)date("Y") - 2000;
        if($request->minPat != Null){
            $minAge = (int)$request->minPat;
            $min = (int)date("Y") - (int)$request->minPat;
            $d = date_create("01-12-$min");
            $intervallePatient[1] = date_format($d, "Y-m-d");
            // $intervallePatient[0] = $min;
        }
        if($request->maxPat != Null){
            $maxAge = (int)$request->maxPat;
            $max = (int)date("Y") - (int)$request->maxPat;
            $d = date_create("01-01-$max");
            $intervallePatient[0] = date_format($d, "Y-m-d");
            // $intervallePatient[0] = $max;
        }

        // $pats = Patient::whereBetween('dateNaiss',  [$intervallePatient[0], $intervallePatient[1]])->get();
        $maladie = Maladie::where('nom', 'LIKE', 'tuberculose')->first();
        if($request->maladie != Null){
            $tmpMaladie = Maladie::where('nom', 'LIKE', $request->maladie)->first();
            if($tmpMaladie != Null){
                $maladie = $tmpMaladie;
            }
        }
        $patients = [];
        $patientsComplet = [];
        $patientsFemme = [];
        $patientsHomme = [];
        $totalPatients = [];
        $totalCompletPatients = [];
        $totalFemme = [];
        $totalHomme = [];
        $totalActuCompletPatients = 0;
        $totalActuPatients = 0;
        $totalActuFemme = 0;
        $totalActuHomme = 0;
        $consultations = Null;
        $i = 0;
        $k = 0;
        for($i=0; $i < 12; $i++){
            $j = $i+1;
            if($maladie != Null){
                $consultations = Consultation::where('resultat', 'LIKE', '%'.$maladie->nom.'%')->where('created_at', "LIKE", date("Y-0$j")."%")->get();
                foreach ($consultations as $key => $row) {
                    $session = Session::where('id', $row->session_id)->first();
                    $patient = Patient::whereBetween('dateNaiss',  [$intervallePatient[0], $intervallePatient[1]])->where('id', $session->patient_id)->first();
                    $patientComplet = Patient::where('id', $session->patient_id)->first();
                    if($patient != Null){
                        $patients[$patient->id] = $patient;
                        if($patient->sexe == 1){
                            $patientsFemme[$patient->id] = $patient;
                        }else{
                            $patientsHomme[$patient->id] = $patient;
                        }
                    }
                    if($patientComplet != Null){
                        $patientsComplet[$patientComplet->id] = $patient;
                    }
                }
                $totalCompletPatients[$i] = count($patientsComplet);
                $totalPatients[$i] = count($patients);
                $totalFemme[$i] = count($patientsFemme);
                $totalHomme[$i] = count($patientsHomme);
                if($j == (int)date('m')){
                    $totalActuCompletPatients = count($patientsComplet);
                    $totalActuPatients = count($patients);
                    $totalActuFemme = count($patientsFemme);
                    $totalActuHomme = count($patientsHomme);
                }
                $patientsComplet = [];
                $patients = [];
                $patientsFemme = [];
                $patientsHomme = [];
            }
        }

        


        return view('administrateur.statDiagnostiques', [
            'maladie' => $maladie == Null ? 'Aucun' : $maladie->nom,
            'minAge' => $minAge,
            'maxAge' => $maxAge,
            'totalCompletPatients' => $totalCompletPatients,
            'totalPatients' => $totalPatients,
            'totalFemme' => $totalFemme,
            'totalHomme' => $totalHomme,
            'totalActuCompletPatients' => $totalActuCompletPatients,
            'totalActuPatients' => $totalActuPatients,
            'totalActuFemme' => $totalActuFemme,
            'totalActuHomme' => $totalActuHomme,
        ]);
    }

    public function impressionStatDiagnostique(){
        $maladies = Maladie::orderBy('nom')->get();
        return view('administrateur.layouts.impressionStatDiagnostique', [
            'maladies' => $maladies
        ]);
    }

}

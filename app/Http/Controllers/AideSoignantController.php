<?php

namespace App\Http\Controllers;

use App\Notifications\newConsultation;

use App\Models\Accouchement;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Hospitalisation;
use App\Models\Hospitalisation_tmp;
use App\Models\Parametre;
use App\Models\Paiement;
use App\Models\Parametre_tmp;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Personnel;
use App\Models\Rdv;
use App\Models\Service;
use App\Models\Session;
use App\Models\Type_consultation;

class AideSoignantController extends Controller
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
        return view('aide_soignant.index', [
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

    
    public function afficherListeAll($nom){
        return view('aide_soignant.components.controlListePatientAll', ['nom' => $nom]);
    }

    public function afficherListeSuivit($nom){
        return view('aide_soignant.components.controlListePatientSuivit', ['nom' => $nom]);
    }

    public function afficherListeHospitalisee($nom){
        return view('aide_soignant.components.controlListePatientHospitalisee', ['nom' => $nom]);
    }

    public function showPatientsListe(){
        return view('aide_soignant.patient');
    }
    
    public function showAddPatient(){
        return view('aide_soignant.ajouterPatient');
    }
    
    public function showEnregParams(){
        return view('aide_soignant.enregistrerParams');
    }
    
    public function showAccouchement(){
        return view('aide_soignant.accouchement');
    }
    
    public function saveAccouchement(Request $request){
        if($request->dateAccouch == 1){
            Accouchement::create([
                'patient_id' => $request->patient_id,
                'decesPatient' => $request->decesPatient,
                'nbrEnfant' => $request->nbrNaiss,
                'nbrDeces' => $request->nbrDeces
            ]);
        }else{
            $d = date_create("$request->dateAccouchementPatient");
            // dd(date_format($d, "Y-m-d"));
            $date = mktime(00, 00, 00, date_format($d, "m"), date_format($d, "d"), date_format($d, "Y"));
            Accouchement::create([
                'patient_id' => $request->patient_id,
                'decesPatient' => $request->decesPatient,
                'nbrEnfant' => $request->nbrNaiss,
                'nbrDeces' => $request->nbrDeces,
                'created_at' => $date
            ]);
        }
        
        return redirect()->route('aide_soignant.accouchement');
    }
    
    public function showListPatientFille(){
        return view('aide_soignant.layouts.listPatientFille');
    }
    
    public function showPatientParametre($idPatient){
        $patient = Patient::where('id', $idPatient)->first();
        $parametres = Parametre::where('patient_id', $idPatient)->orderBy('created_at', 'desc')->first();
        $session = Session::where('patient_id', $idPatient)->orderBy('created_at', 'desc')->first();
        $type_consultation = Type_consultation::where('id', $session->type_consultation_id)->first();
        $service_perso = Service::where('id', $type_consultation->service_id)->first();
        $consultation = Consultation::where('session_id', $session->id)->orderBy('created_at', 'desc')->first();
        $rdv = Null;
        if($consultation != Null){
            $rdv = Rdv::where('consultation_id', $consultation->id)->first();
        }
        $medecins = [];
        $medecinsTmp = [];
        $services = [];
        $servis = Service::where('consultable', 1)->get();
        $serviss = Service::where('id', $service_perso->id)->get();
        $i = 0;
        $personnels = Personnel::where('service_id', $service_perso->id)->get();
        foreach ($personnels as $keys => $value) {
            $medecins[$i] = $value;
            $medecinsTmp[$medecins[$i]->id] = $medecins[$i];
            $services[$medecins[$i]->id] = $service_perso;
            $i += 1;
        }
        // if($servis != Null){
        //     foreach ($servis as $key => $service) {
        //         $cpt = Personnel::where('service_id', $service->id)->get()->count();
        //         $personnels = Personnel::where('service_id', $service->id)->get();
        //         foreach ($personnels as $keys => $value) {
        //             $medecins[$i] = $value;
        //             $medecinsTmp[$medecins[$i]->id] = $medecins[$i];
        //             $services[$medecins[$i]->id] = $service;
        //             $i += 1;
        //         }
        //     }
        // }
        // dd($parametres);
        if($parametres == null){
            $parametres = Parametre_tmp::where('patient_id', $idPatient)->where('created_at', 'LIKE', date('Y-m-d')."%")->orderBy('created_at', 'desc')->first();
            if($parametres == null){
                $parametres = new Parametre();
                $parametres->temperature = 0;
                $parametres->tension = 0;
                $parametres->poids = 0;
                $parametres->taille = 0;
                $d=mktime(00, 00, 00, 00, 00, 0000);
                $parametres->created_at = date("Y-m-d h:i:sa", $d);
            }
        }

        return view('aide_soignant.patientParametres',[
            'patient' => $patient,
            'parametres' => $parametres,
            'rdv' => $rdv,
            'medecins' => $medecins,
            'services' => $serviss,
            'medecinsTmp' => $medecinsTmp
        ]);
    }

    public function saveInfosPatient(Request $request, $idPatient){
        $patient = Patient::where('id', $idPatient)->first();
        if($request->type == 0){
            Patient::where('id', $patient->id)->update([
                'nom' => $request->nomPatient,
                'prenom' => $request->prenomPatient,
                'sexe' => $request->sexePatient,
                'dateNaiss' => $request->dateNaissPatient,
                'telephone' => $request->telPatient,
                'statutMatrimonial' => $request->statutMatrimonialePatient
            ]);
        }
        return redirect()->route('aide_soignant.patientParametre', ['idPatient' => $patient->id]);
    }

    public function showProfilePatient($idPatient){
        $patient = Patient::where('id', $idPatient)->first();
        $parametres = Parametre::where('patient_id', $idPatient)->where('created_at', 'LIKE', date('Y-m-d')."%")->orderBy('created_at', 'desc')->first();
        dd($parametres);
        if($parametres == null){
            $parametres = new Parametre();
            $parametres->temperature = 0;
            $parametres->tension = 0;
            $parametres->poids = 0;
            $parametres->taille = 0;
            $d=mktime(00, 00, 00, 00, 00, 0000);
            $parametres->created_at = date("Y-m-d h:i:sa", $d);
        }

        return view('aide_soignant.profilePatient',[
            'patient' => $patient,
            'parametres' => $parametres
        ]);
    }

    public function showHistorique(){
        return view('aide_soignant.historique');
    }

    public function addPatient(Request $request){
        $state = 1;
        Patient::create([
            'nom' => $request->nomPatient,
            'prenom' => $request->prenomPatient,
            'sexe' => $request->sexePatient == 'masculin'? 0 : 1,
        ]);
        return view('aide_soignant.ajouterPatient', [
            'state' => $state
        ]);
    }

    public function afficherListePatient($name){
        $nom = $name;
        // return view('caissier.components.enregistrerPaiement.controlListePatient', [
        //         'nom' => $nom
        // ]);
        return view('aide_soignant.layouts.controlListePatient', [
            'nom' => $nom
        ]);
    }

    public function afficherHistSession($name){
        $nom = $name;
        return view('aide_soignant.layouts.controlHistSession', [
            'nom' => $nom
        ]);
    }

    public function afficherListe(){
        dd('Salut');
    }

    public function saveParamsPatient(Request $request, $idPatient){
        $patient = Patient::where('id', $idPatient)->first();
        
        if($request->type == 1){
            Parametre_tmp::create([
                'temperature' => $request->temperature == null ? 0 : $request->temperature,
                'tension' => $request->tension == null ? 0 : $request->tension,
                'poids' => $request->poids == null ? 0 : $request->poids,
                'taille' => $request->taille == null ? 0 : $request->taille,
                'patient_id' => $patient->id
            ]);
            $parametres = Parametre_tmp::where('patient_id', $idPatient)->orderBy('created_at', 'desc')->first();
            return redirect()->route('aide_soignant.patientParametre',[
                'idPatient' => $patient->id,
                // 'parametres' => $parametres
            ]);
        }else{
            $parametres = Parametre_tmp::where('patient_id', $idPatient)->where('created_at', 'LIKE', date('Y-m-d')."%")->orderBy('created_at', 'desc')->first();
            if($parametres == Null){
                $parametres = new Parametre();
                $parametres->temperature = 0;
                $parametres->tension = 0;
                $parametres->poids = 0;
                $parametres->taille = 0;
                $d=mktime(00, 00, 00, 00, 00, 0000);
                $parametres->created_at = date("Y-m-d h:i:sa", $d);
                return redirect()->route('aide_soignant.patientParametre',[
                    'idPatient' => $patient->id,
                    // 'parametres' => $parametres,
                    // 'erreur' => 1
                ]);
            }else{
                // $medecins = [];
                // $servis = Service::where('consultable', 1)->get();
                // if($servis != Null){
                //     foreach ($servis as $key => $service) {
                //         $medecins[$key] = Personnel::where('service_id', $service->id)->first();
                //     }
                // }

                $medecins = [];
                $servis = Service::where('consultable', 1)->get();
                $i = 0;
                if($servis != Null){
                    foreach ($servis as $key => $service) {
                        $personnels = Personnel::where('service_id', $service->id)->get();
                        foreach ($personnels as $keys => $value) {
                            $medecins[$i] = $value;
                            $i += 1;
                        }
                    }
                }
                // $service = Service::where('id', $medecins[$request->medecin]->service_id)->first();
                $service = Service::where('id', Personnel::where('id', $medecins[$request->medecin]->id)->first()->service_id)->first();
                $sessions = Session::where('etat', 1)->where('patient_id', $patient->id)->get();
                $session_id = 0;
                if($sessions != Null){
                    foreach ($sessions as $key => $row) {
                        if($row->service_id == $service->id){
                            $session_id = $row->id;
                        }
                    }
                    if($session_id == 0){
                        $session_id = Session::where('patient_id', $patient->id)->latest()->first()->id;
                    }
                }
                Consultation::create([
                    'session_id' => $session_id,
                    'personnel_id' => $medecins[$request->medecin]->id
                ]);
                
                $session = Session::where('id', $session_id)->first();
                Session::where('id', $session_id)->update([
                    'nbrConsultation' => $session->nbrConsultation + 1,
                ]);
    
                // dd($idPatient);
                Parametre::create([
                    'temperature' => $parametres->temperature == Null ? 0 : $parametres->temperature,
                    'tension' => $parametres->tension == Null ? 0 : $parametres->tension,
                    'poids' => $parametres->poids == Null ? 0 : $parametres->poids,
                    'taille' => $parametres->taille == Null ? 0 : $parametres->taille,
                    'patient_id' => $patient->id,
                    'consultation_id' => Consultation::where('session_id', $session_id)->latest()->first()->id
                ]);

                $user = $medecins[$request->medecin];
                $user->notify(new newConsultation($patient, $medecins[$request->medecin]));

                return redirect()->route('aide_soignant.enreg_params',[
                    'success' => 1,
                    // 'parametres' => $parametres,
                    // 'erreur' => 1
                ]);
            }
        }
    }

    public function showHistAccouchement(){
        $accouchements = Accouchement::orderBy('created_at', 'desc')->get();
        return view('aide_soignant.histAccouchement', [
            'accouchements' => $accouchements
        ]);
    }

    public function showStatAccouchement(Request $request){
        $min = date_create(date("Y")."-".date("m")."-01");
        $max = date_create(date("Y")."-".date("m")."-".date("d"));
        $intervalles = [date_format($min, "Y-m-d"), date_format($max, "Y-m-d")];
        if($request->minAccouch != Null){
            $d = date_create("$request->minAccouch");
            $intervalles[0] = date_format($d, "Y-m-d");
        }
        if($request->maxAccouch != Null){
            $d = date_create("$request->maxAccouch");
            $intervalles[1] = date_format($d, "Y-m-d");
        }

        // if(request(key: 'min')){
        //     dd(request(key: 'min'));
        //     $intervalles[0] = request(key: 'min');
        // }
        // if(request(key: 'max')){
        //     $intervalles[0] = request(key: 'max');
        // }
        // dd(Accouchement::where('created_at', ">=", $intervalles[1])->get()->count());
        $nbrAccouchements = Accouchement::whereBetween('created_at', [$intervalles[0], $intervalles[1]])->get();
        // dd(Accouchement::orderBy('created_at')->first()->created_at);
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

        return view('aide_soignant.statAccouchement', [
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
            'totalConsultMois' => $totalConsultMois,
            'totalAccouchements' => $totalAccouchements,
            'totalNaissances' => $totalNaissances,
            'totalDeces' => $totalDeces
        ]);
    }

    public function showListeLit($idSalle){
        return view('aide_soignant.layouts.listeLit', [
            'idSalle' => $idSalle
        ]);
    }

    public function newHospi(){
        $hospi = Hospitalisation_tmp::all();
        return view('aide_soignant.nouveauHospitalisation', [
            'hospitalisations' => $hospi
        ]);
    }

    public function setNewHospi(Request $request){
        $hospi = Hospitalisation_tmp::where('id', $request->hospi)->first();
        Hospitalisation::create([
            'dureePrevue' => $hospi->dureePrevue,
            'prescription_id' => $hospi->prescription_id,
            'lit_id' => $request->idLit
        ]);
        $hospi = Hospitalisation_tmp::where('id', $request->hospi)->delete();
        return redirect()->route('aide_soignant.newHospi');
    }

    public function showHistHospi(){
        $hospiEnCours = Hospitalisation::where('dureeRealisee', -1)->get();
        $hospiTermines = Hospitalisation::where('dureeRealisee', '!=', -1)->get();
        return view('aide_soignant.historiqueHospi', [
            'hospiEnCours' => $hospiEnCours,
            'hospiTermines' => $hospiTermines
        ]);
    }

}

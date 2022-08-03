<?php

namespace App\Http\Controllers;

use App\Models\Accouchement;
use App\Models\Antecedent;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Session;
use App\Models\Parametre;
use App\Models\Consultation;
use App\Models\Rdv;
use App\Models\Examen_prescrit;
use App\Models\ExamenEffectue;
use App\Models\Personnel;
use App\Models\Examen;
use App\Models\Paiement;
use App\Models\Hospitalisation;
use App\Models\Hospitalisation_tmp;
use App\Models\Lit;
use App\Models\Maladie;
use App\Models\Prescription;

class MedecinController extends Controller
{
    
    public function dashboard(Request $request){
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
            if(Rdv::where('consultation_id', $consult->id)->first() != Null){
                $rdvs[$key] = Rdv::where('consultation_id', $consult->id)->first();
            }
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

        return view('medecin.index', [
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
            'totalConsultMois' => $totalConsultMois
        ]);
    }

    public function statistiques(Request $request){
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

        return view('medecin.statistiques', [
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

    public function showPatient(){
        return view('medecin.patient');
    }

    public function showConsultation($consulter = 0){
        return view('medecin.listeConsultation',[
            'consulter' => $consulter
        ]);
    }

    public function showDossierPatient(){
        return view('medecin.dossierPatient');
    }

    public function saveParamsPatient(Request $request, $idPatient){
        $patient = Patient::where('id', $idPatient)->firstOrFail();
        
        if($request->type == 1){
            Parametre::create([
                'temperature' => $request->temperature == null ? 0 : $request->temperature,
                'tension' => $request->tension == null ? 0 : $request->tension,
                'poids' => $request->poids == null ? 0 : $request->poids,
                'taille' => $request->taille == null ? 0 : $request->taille,
                'patient_id' => $patient->id
            ]);
            $parametres = Parametre::where('patient_id', $idPatient)->orderBy('created_at', 'desc')->firstOrFail();
            return view('aide_soignant.profilePatient',[
                'patient' => $patient,
                'parametres' => $parametres
            ]);
        }else{
            // $paiement = Paiement::where('patient_id', $idPatient)->where('examen_id', Examen::where('nom', 'Consultation')->firstOrFail()->id)->orderBy('created_at', 'desc')->firstOrFail()->id;
            // Proceder::create([
            //     'etat' => 2,
            //     'effectuer' => date("Y-m-d H:i:s"),
            //     'paiement_id' => $paiement,
            //     'personnel_id' => $request->medecin
            // ]);
            $parametres = Parametre::where('patient_id', $idPatient)->orderBy('created_at', 'desc')->first();
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
    }

    public function showNewConsultation($idProceder){
        $infos = $this->showProfilePatient($idProceder);
        return view('medecin.consultation',[
            'patient' => $infos['patient'],
            'parametres' => $infos['parametres']
        ]);
    }

    public function afficherListePatient($name){
        $nom = $name;
        return view('medecin.layouts.controlListePatient', [
            'nom' => $nom
        ]);
    }

    public function afficherListeLit($name){
        $nom = $name;
        return view('medecin.layouts.controlListeLit', [
            'nom' => $nom
        ]);
    }

    public function afficherProfilConsultationPatient(){
        return view('medecin.profilConsultationPatient');
    }

    public function showProfil($idConsultation){
        $consultation = Consultation::where('id', $idConsultation)->first();
        $session = Session::where('id', $consultation->session_id)->first();
        $patient = Patient::where('id', $session->patient_id)->first();
        $parametres = Parametre::where('patient_id', $patient->id)->where('consultation_id', $consultation->id)->first();
        $antecedents = Antecedent::where('patient_id', $patient->id)->get();
        $sessionsPat = Session::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get();
        $consultationPrec = Null;
        foreach ($sessionsPat as $keys => $ses) {
            $state = 0;
            $rows = Consultation::where('session_id', $ses->id)->get();
            foreach ($rows as $key => $row) {
                if($row->id != $idConsultation){
                    $consultationPrec = $row;
                    $state = 1;
                    break;
                }
            }
            if($state == 1){
                break;
            }
        }
        return view('medecin.profilConsultationPatient',[
            'consultation' => $consultation,
            'session' => $session,
            'patient' => $patient,
            'parametres' => $parametres,
            'antecedents' => $antecedents,
            'consultationPrec' => $consultationPrec,
        ]);
    }

    public function saveConsultationPatient(Request $request, $idConsultation){
        date_default_timezone_set("Africa/Douala");
        $consultation = Consultation::where('id', $idConsultation)->first();
        $session = Session::where('id', $consultation->session_id)->first();
        $patient = Patient::where('id', $session->patient_id)->first();

        // $id = Session()->get('idPersonnel');
        $user = Personnel::find($request->session()->get('idPersonnel'));

        // $cptNotif = 0;
        if($user->unreadNotifications != Null){
            foreach ($user->unreadNotifications as $key => $value) {
                if($value->data['patient_id'] == $patient->id);
            }
            $cptNotif = count($user->unreadNotifications);
        }
        if($request->type == -1){
            if($request->resultatConsultation != ''){
                $result = 0;
                $k = 0;
                $mal = [];
                // $resultat = str_replace(",", "", "$request->resultatConsultation");
                $resultat = $request->resultatConsultation;
                $pos = strrpos("$resultat",",");
                // $resultat[$pos] = "";
                // $resultat = substr_replace($resultat, "", $pos);
                if($pos){
                    while($pos != false){
                        $resultat = substr_replace($resultat, "", $pos);
                        $pos = strrpos("$resultat",",");
                        if($pos == false){
                            $result = substr($resultat, 0);
                        }else{
                            $result = substr($resultat, $pos+1);
                        }
                        $maladies = Maladie::where('nom', "LIKE", $result)->first();
                        if($maladies == Null){
                            Maladie::create([
                                'nom' => $result,
                                'nombre' => 1
                            ]);
                        }else{
                            Maladie::where('id', $maladies->id)->update([
                                'nombre' => $maladies->nombre + 1
                            ]);
                        }
                        $mal[$k] = $result;
                        $k = $k + 1;
                        if($pos == false){
                            break;
                        }
                    }
                }else{
                    $maladies = Maladie::where('nom', "LIKE", $$request->resultatConsultation)->first();
                    if($maladies == Null){
                        Maladie::create([
                            'nom' => $request->resultatConsultation,
                            'nombre' => 1
                        ]);
                    }else{
                        Maladie::where('id', $maladies->id)->update([
                            'nombre' => $maladies->nombre + 1
                        ]);
                    }
                    $mal[$k] = $request->resultatConsultation;
                    $k = $k + 1;
                }

                $consultation = Consultation::where('id', $idConsultation)->update([
                    'resultat' => $request->resultatConsultation
                ]);
                // $maladies = Maladie::where('nom', "LIKE", $request->resultatConsultation)->first();
                // if($maladies == Null){
                //     Maladie::create([
                //         'nom' => $request->resultatConsultation,
                //         'nombre' => 1
                //     ]);
                // }else{
                //     Maladie::where('id', $maladies->id)->update([
                //         'nombre' => $maladies->nombre + 1
                //     ]);
                // }
                foreach ($mal as $key => $value) {
                    if(count(Antecedent::where('nom', 'LIKE', $value)->first()) != 0){
                        Antecedent::create([
                            'nom' => $value,
                            'patient_id' => $patient->id
                        ]);
                    }
                }
            }
            // $d=mktime(00, 00, 00, 00, 00, 0000);
            $consultation = Consultation::where('id', $idConsultation)->update([
                'dateRealisation' => date('Y-m-d')
            ]);
            if($consultation = Consultation::where('id', $idConsultation)->first()->dateRealisation == Null){
                $id = Session()->get('idPersonnel');
                $user = Personnel::find(Session()->get('idPersonnel'));
                if(count($user->unreadNotifications) != 0){
                    $user->unreadNotifications[0]->markAsRead();
                }
            }
            return redirect()->route('medecin.consultation.liste', ['consulter' => 1]);
        }else if($request->type == 0){
            Patient::where('id', $patient->id)->update([
                'nom' => $request->nomPatient,
                'prenom' => $request->prenomPatient,
                'sexe' => $request->sexePatient,
                'dateNaiss' => $request->dateNaissPatient,
                'telephone' => $request->telPatient,
                'statutMatrimonial' => $request->statutMatrimonialePatient
            ]);
        }else if($request->type == 1){
            Consultation::where('id', $idConsultation)->update([
                'symptomes' => $request->symptomes
            ]);
        }else if($request->type == 2){
            Antecedent::create([
                'nom' => $request->themeAntecedent,
                'description' => $request->descriptionAntecedent,
                'patient_id' => $patient->id,
            ]);
        }else if($request->type == 3){
            $pres = Prescription::where('consultation_id', $consultation->id)->first();
            if($pres == Null){
                Prescription::create([
                    'consultation_id' => $consultation->id
                ]);
                $pres = Prescription::where('consultation_id', $consultation->id)->first();
            }
            if($request->prescriptionType == 1){
                if($request->examenVal != Null){
                    foreach ($request->examenVal as $val => $exam) {
                        Examen_prescrit::create([
                            'etatPaiement' => 0,
                            'prescription_id' => $pres->id,
                            'examen_id' => $exam,
                            'personnel_id' => 1
                        ]);
                    }
                }
            }else{
                Hospitalisation_tmp::create([
                    'dureePrevue' => $request->dureeHospi,
                    'prescription_id' => $pres->id,
                ]);
                Consultation::where('id', $idConsultation)->update([
                    'etat' => 2
                ]);
            }
        }else if($request->type == 4){
            Consultation::where('id', $idConsultation)->update([
                'notes' => $request->notes
            ]);
        }else if($request->type == 5){
            Prescription::where('consultation_id', $idConsultation)->update([
                'ordonnance' => $request->ordonnance
            ]);
        }else if($request->type == 6){
            Examen_prescrit::where('id', $request->examen_prescrit)->delete();
        }else if($request->type == 7){
            Parametre::where('patient_id', $patient->id)->where('consultation_id', $idConsultation)->update([
                'temperature' => $request->temperaturePatient,
                'tension' => $request->tensionPatient,
                'poids' => $request->poidsPatient,
                'taille' => $request->taillePatient
            ]);
        }else if($request->type == 8){
            Consultation::where('id', $idConsultation)->update([
                'etat' => $request->etatPatient
            ]);
        }else if($request->type == 9){
            Lit::where('id', Hospitalisation::where('id', $request->deleteHospiId)->first()->lit_id)->update([
                'etat' => 0
            ]);
            Hospitalisation::where('id', $request->deleteHospiId)->delete();
            Consultation::where('id', $idConsultation)->update([
                'etat' => 0
            ]);
        }else if($request->type == 10){
            $hospi = Hospitalisation::where('id', $request->libererHospiId)->first();
            $date = date('Y/m/d');
            $x1 = date_create("$date");
            $d2 = $hospi->created_at;
            $x2 = date_create("$d2");
            $z = date_diff($x1, $x2);
            $diff = (int)$z->format("%a");
            Hospitalisation::where('id', $request->libererHospiId)->update([
                'dureeRealisee' => $diff
            ]);
            Consultation::where('id', $idConsultation)->update([
                'etat' => 0
            ]);
        }else if($request->type == 11){
            $rdv = Rdv::where('consultation_id', $consultation->id)->first();
            if(isset($_POST['deleteRdv'])){
                Rdv::where('consultation_id', $consultation->id)->delete();
            }else{
                if($rdv == Null){
                    Rdv::create([
                        'etat' => 0,
                        'date' => $request->dateRdv,
                        'consultation_id' => $consultation->id
                    ]);
                    Consultation::where('id', $idConsultation)->update([
                        'etat' => 1
                    ]);
                }else{
                    Rdv::where('consultation_id', $consultation->id)->update([
                        'etat' => 0,
                        'date' => $request->dateRdv
                    ]);
                }
            }
        }else if($request->type == 12){
            Examen_prescrit::where('id', $request->examen_prescrit)->update([
                'resultat' => $request->resultatsExam,
                'dateRealisation' => date('Y-m-d')
            ]);
        }
        $parametres = Parametre::where('patient_id', $patient->id)->where('consultation_id', $consultation->id)->first();
        $antecedents = Antecedent::where('patient_id', $patient->id)->get();
        // return view('medecin.profilConsultationPatient',[
        //     'consultation' => $consultation,
        //     'session' => $session,
        //     'patient' => $patient,
        //     'parametres' => $parametres,
        //     'antecedents' => $antecedents
        // ]);
        return redirect()->route('medecin.profile_patient', ['idConsultation' => $idConsultation]);
    }

    public function supprimerExamenPrescrit($idConsultation){
        // Examen_prescrit::
        return redirect()->route('medecin.profile_patient', ['idConsultation' => $idConsultation]);
    }

    public function showHistorique(){
        $id = 2;
        return view('medecin.historiqueConsultation',[
            'id' => $id
        ]);
    }

    public function afficherListeConsultation(Request $request, $name){
        $nom = $name;
        // $idMedecin = 1;
        $idMedecin = $request->session()->get('idPersonnel');
        return view('medecin.layouts.controlListeConsultation',[
            'nom' => $nom,
            'idMedecin' => $idMedecin
        ]);
    }

    public function afficherListeRdv(Request $request, $name){
        $nom = $name;
        // $idMedecin = 1;
        $idMedecin = $request->session()->get('idPersonnel');
        return view('medecin.layouts.controlListeRdv',[
            'nom' => $nom,
            'idMedecin' => $idMedecin
        ]);
    }
    
    public function afficherListeRdvEffectue(Request $request, $name){
        $nom = $name;
        // $idMedecin = 1;
        $idMedecin = $request->session()->get('idPersonnel');
        return view('medecin.layouts.controlListeRdvEffectue',[
            'nom' => $nom,
            'idMedecin' => $idMedecin
        ]);
    }

    public function afficherListeRdvManque(Request $request, $name){
        $nom = $name;
        // $idMedecin = 1;
        $idMedecin = $request->session()->get('idPersonnel');
        return view('medecin.layouts.controlListeRdvManque',[
            'nom' => $nom,
            'idMedecin' => $idMedecin
        ]);
    }

    public function afficherListeAll($name){
        return view('medecin.layouts.controlListePatientAll', [
            'nom' => $name
        ]);
    }

    public function afficherListeSuivit($name){
        return view('medecin.layouts.controlListePatientSuivit', [
            'nom' => $name
        ]);
    }

    public function afficherListeHospitalisee($name){
        return view('medecin.layouts.controlListePatientHospitalisee', [
            'nom' => $name
        ]);
    }

    public function afficherHistoriqueConsultation(Request $request, $name){
        $nom = $name;
        // $idMedecin = 1;
        $idMedecin = $request->session()->get('idPersonnel');
        return view('medecin.layouts.controlHistoriqueConsultation',[
            'nom' => $nom,
            'idMedecin' => $idMedecin
        ]);
    }

    public function showRdv(){
        return view('medecin.rdv');
    }

    public function modifierRdv(Request $request){
        Rdv::where('id', $request->rdv)->update([
            'date' => $request->dateRdv
        ]);
        return redirect()->route('medecin.rdv');
    }

    public function deleteRdv(Request $request){
        $id = Rdv::where('id', $request->rdv)->first()->consultation_id;
        Consultation::where('id', $id)->update([
            'etat' => 0
        ]);
        Rdv::where('id', $request->rdv)->delete();
        return redirect()->route('medecin.rdv');
    }

    public function showListExamensPrescriptions($nom){
        return view('medecin.components.listExamenPrescription', ['nom' => $nom]);
    }

    public function showListeMaladies($nom){
        return view('medecin.components.maladies', ['nom' => $nom]);
    }

    public function showListStatMaladie($nom){
        return view('medecin.components.listStatMaladies', [
            'nom' => $nom
        ]);
    }

    public function showStatMaladie(Request $request){
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
        $maladie = Maladie::orderBy('nom')->first();
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

        


        return view('medecin.statsMaladies', [
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

    public function imprimer(){
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        // $maladies = Maladie::orderBy('nom')->get();
        // view()->share('medecin.testImpression',$maladies);
        // $pdf = PDF::loadView('medecin.testImpression', compact('maladies'));
        // return $pdf->download('pdf_file.pdf');
        redirect()->route('medecin.testImpression');
    }

    public function testImpression(){
        $maladies = Maladie::orderBy('nom')->get();
        return view('medecin.testImpression', [
            'maladies' => $maladies
        ]);
    }

    public function impressionStatMaladies(){
        $maladies = Maladie::orderBy('nom')->get();
        return view('medecin.components.impressionStatMaladie', [
            'maladies' => $maladies
        ]);
    }

    public function nbrConsultation(){
        return view('medecin.components.nbrConsultation');
    }

}

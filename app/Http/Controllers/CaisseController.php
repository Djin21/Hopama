<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Examen;
use App\Models\Examen_prescrit;
use App\Models\ExamenEffectue;
use App\Models\Paiement;
use App\Models\Patient;
use App\Models\Patient_tmp;
use App\Models\Personnel;
use App\Models\Prescription;
use App\Models\Service;
use App\Models\Session;
use App\Models\Tmpclient;
use App\Models\Type_consultation;
use App\Models\Validite;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function dashboard(Request $request){
        $consultations = Session::where("created_at", "LIKE", date("Y-m-d")."%")->get();
        $prixConsult = 0;
        $session = Session::where("created_at", "LIKE", date("Y-m-d")."%")->get();
        foreach ($session as $key => $row) {
            $prixConsult += Type_consultation::where('id', $row->type_consultation_id)->first()->prix;
        }
        $examens = Paiement::where("created_at", "LIKE", date("Y-m-d")."%")->get();
        $total = $consultations->count() + $examens->count();
        $consulPercent = 0;
        $examPercent = 0;
        $prixExamen = 0;
        $totalRevAnneeExam = [];
        $totalConsultAnnee = [];
        $i = 0;
        for($i = 0; $i < 12; $i++){
            $j = $i + 1;
            $totalConsultAnnee[$i] = 0;
            $exam = Paiement::where("created_at", "LIKE", date("Y-0$j")."%")->get();
            $tmp = 0;
            if($exam !=  Null){
                foreach ($exam as $key => $value) {
                    $exa = Examen::where('id', $value->examen_id)->first();
                    $tmp = $tmp + $exa->prix;
                }
            }
            $totalRevAnneeExam[$i] = $tmp;

            $session = Session::where("created_at", "LIKE", date("Y-0$j")."%")->get();
            foreach ($session as $key => $row) {
                $totalConsultAnnee[$i] += Type_consultation::where('id', $row->type_consultation_id)->first()->prix;
            }
        }
        foreach ($examens as $key => $value) {
            $exam = Examen::where('id', $value->examen_id)->first();
            $prixExamen = $prixExamen + $exam->prix;
        }
        if($total != 0){
            $consulPercent = ($consultations->count() / $total) * 100;
            $examPercent = ($examens->count() / $total) * 100;
        }


        return view('caissier.index', [
            'personnel' => Personnel::where('id', $request->session()->get('idPersonnel'))->first(),
            'consultations' => $consultations,
            'examens' => $examens,
            'total' => $total,
            'consultPercent' => $consulPercent,
            'examPercent' => $examPercent,
            'prixExamens' => $prixExamen,
            'totalRevAnneeExam' => $totalRevAnneeExam,
            'prixConsultation' => $prixConsult,
            'totalConsultAnnee' => $totalConsultAnnee
        ]);
    }

    public function paiementClient(){
        // $service = Service::all();
        // $examen = 0;
        // return view('caissier.paiementClient', [
        //     'services' => $service,
        //     'examen' => $examen
        // ]);
        return view('caissier.paiementClient');
    }

    public function afficherListeExamen($name){
        $nom = $name;
        return view('caissier.test', [
            'nom' => $nom
        ]);
    }

    public function afficherListePatient($name){
        $nom = $name;
        return view('caissier.components.enregistrerPaiement.controlListePatient', [
                'nom' => $nom
        ]);
    }

    public function enregistrerClient(Request $request){
        // if($request->type == 1){
        //     Patient::create([
        //         'nom' => $request->nomClient,
        //         'prenom' => $request->prenomClient,
        //         'sexe' => $request->sexeClient == 'masculin'? 0 : 1,
        //     ]);
        //     // Client::create([
        //     //     'nom' => $request->nomClient,
        //     //     'prenom' => $request->prenomClient,
        //     //     'sexe' => $request->sexeClient == 'masculin'? 0 : 1,
        //     // ]);
        //     $patients = Patient::all();
        //     $patientId = $patients->count();
        //     Tmpclient::create([
        //         'client_id' => $patientId
        //     ]);
        // }else{
        //     Tmpclient::create([
        //         'client_id' => $request->patient
        //     ]);
        // }
        // return view('caissier.components.enregistrerPaiement.enregistrerPaiement');
    }
    
    public function newSession(Request $request){
        date_default_timezone_set("Africa/Douala");
        if($request->type == 1){
            Patient::create([
                'nom' => $request->nomClient,
                'prenom' => $request->prenomClient,
                'sexe' => $request->sexeClient == 'masculin'? 0 : 1,
            ]);
            $patients = Patient::all();
            $patientId = $patients->count();
            Tmpclient::create([
                'client_id' => $patientId
            ]);
        }else{
            Tmpclient::create([
                'client_id' => $request->patient
            ]);
        }

        return redirect()->route('caisse.consultationPaiement.show');

        // $clientcpt = Tmpclient::all()->count();
        // $tmpclientId = Tmpclient::where('id', $clientcpt)->firstOrFail();

        // $patientId = Patient::where('id', $tmpclientId->client_id)->firstOrFail()->id;

        // $valid = Validite::all();
        // $cpt = $valid->count();
        // $idValidite = $valid[$cpt-1]->id;

        // Session::create([
        //     'etat' => 1,
        //     'nbrConsultation' => 0,
        //     'service_id' => 0,
        //     'patient_id' => $patientId,
        //     'validite_id' => $idValidite,
        //     'type_consultation_id' => Type_consultation::orderBy('created_at', 'desc')->first()->id
        // ]);
        // return view('caissier.historique', [
        //     'state' => 0
        // ]);
    }

    public function montrerPaiement(Request $request){
        // if(!empty($request->nom)){
        //     dd('premier');
        //     // Client::create([
        //     //     'nom' => $request->nomClient,
        //     //     'prenom' => $request->prenomClient,
        //     //     'sexe' => $request->sexeClient ? 1 : 0,
        //     // ]);
        //     // $clients = Client::all();
        //     // $clientId = $clients->count();
        //     // Tmpclient::create([
        //     //     'client_id' => $clientId
        //     // ]);
        // }else{
        //     dd('deuxieme');
        //     // Tmpclient::create([
        //     //     'client_id' => $request->patient
        //     // ]);
        // }
        return view('caissier.paiementClient');
    }

    public function enregistrerPaiement($id){
        date_default_timezone_set("Africa/Douala");
        
        $clientcpt = Tmpclient::all()->count();
        $tmpclientId = Tmpclient::where('id', $clientcpt)->firstOrFail();
        
        $patientId = Patient::where('id', $tmpclientId->client_id)->firstOrFail()->id;
        
        $valid = Validite::all();
        $cpt = $valid->count();
        $idValidite = $valid[$cpt-1]->id;

        Session::create([
            'etat' => 1,
            'nbrConsultation' => 0,
            'patient_id' => $patientId,
            'validite_id' => $idValidite,
            'type_consultation_id' => $id
        ]);
        return view('caissier.historique', [
            'state' => 0
        ]);
    }

    // public function enregistrerPaiement2($id){
    //     Paiement::create([
    //         // 'client_id' => $idClient,
    //         'examen_id' => $id,
    //     ]);
    //     return view('caissier.components.enregistrerPaiement.confirmation');
    //     // header('caissier.paiementClient');
    // }

    public function showPaiement2($id){
        return view('caissier.components.enregistrerPaiement.enregistrerPaiement2', [
            'idClient' => $id
        ]);
        // header('caissier.paiementClient');
    }

    public function confirmationPaie(){
        return view('caissier.components.enregistrerPaiement.confirmation');
    }

    // Historique
    public function showHistorique(){
        // $paiements = Paiement::all();
        // $paiements = Paiement::orderBy('created_at', 'desc')->get();
        
        return view('caissier.historique',[
            // 'paiements' => $paiements
        ]);
    }

    // Bilan
    public function showBilan(){
        // $paiements = Paiement::all();
        // $paiements = Paiement::orderBy('created_at', 'desc')->get();
        
        return view('caissier.bilan', [
            // 'paiements' => $paiements
        ]);
    }

    public function refreshEtat(){
        $sessions = Session::orderBy('created_at', 'desc')->get();
        foreach ($sessions as $session) {
            $validite = Validite::where('id', $session->validite_id)->firstOrFail();
            $date = $session->created_at() +  $validite->validite;
        }
    }

    public function enregistrerSession(){
        return view('caissier.paiementClient');
    }

    public function showExamenListe(){
        return view('caissier.examenListe');
    }

    public function afficherListeExamenPrescrit($name){
        $nom = $name;
        // return view('caissier.components.enregistrerPaiement.controlListePatient', [
        //         'nom' => $nom
        // ]);
        return view('caissier.layouts.controlListeExamenPrescrit', [
            'nom' => $nom
        ]);
    }

    public function afficherListeExamenEffectue($name){
        $nom = $name;
        // return view('caissier.components.enregistrerPaiement.controlListePatient', [
        //         'nom' => $nom
        // ]);
        return view('caissier.layouts.controlListeExamenEffectue', [
            'nom' => $nom
        ]);
    }

    public function showPaiementExamen(){
        return view('caissier.paiementExamen');
    }

    public function saveExamenPatient(Request $request){
        if($request->type == 1){
            Patient::create([
                'nom' => $request->nomPatient,
                'prenom' => $request->prenomPatient,
                'sexe' => $request->sexePatient,
            ]);
            Patient_tmp::create([
                'patient_id' => Patient::orderBy('created_at', 'desc')->first()->id
            ]);
        }else{
            Patient_tmp::create([
                'patient_id' => $request->patient
            ]);
        }
        return redirect()->route('caisse.examenPaiement.show');
    }

    public function savePaiementExamen(Request $request, $idPrescription){
        $consultation = Consultation::where('id', Prescription::where('id', $idPrescription)->first()->consultation_id)->first();
        $session = Session::where('id', $consultation->session_id)->first();
        $patient = Patient::where('id', $session->patient_id)->first();
        if($request->examenVal != Null){
            foreach ($request->examenVal as $val => $exam) {
                Examen_prescrit::where('id', $exam)->update([
                    'etatPaiement' => 1,
                ]);
                Paiement::create([
                    'patient_id' => $patient->id,
                    'examen_id' => Examen::where('id', Examen_prescrit::where('id', $exam)->first()->examen_id)->first()->id
                ]);
            }
        }
        return redirect()->route('caisse.examenListe');
    }

    public function showExamenPaiement(){
        return view('caissier.enregistrerPaiementExamen');
    }

    public function saveExamenPaiement(Request $request){
        if($request->examenVal != Null){
            foreach ($request->examenVal as $val => $exam) {
                Paiement::create([
                    'patient_id' => Patient_tmp::orderBy('created_at', 'desc')->first()->patient_id,
                    'examen_id' => $exam
                ]);
            }
        }
        Patient_tmp::where('patient_id', Patient_tmp::orderBy('created_at', 'desc')->first()->patient_id)->delete();
        return redirect()->route('caisse.examenListe');
    }

    public function showConsultationPaiement(){
        return view('caissier.enregistrerPaiementConsultation');
    }

    public function saveConsultationPaiement(Request $request){
        if($request->consultation != Null){
            $clientcpt = Tmpclient::all()->count();
            $tmpclientId = Tmpclient::where('id', $clientcpt)->firstOrFail();
    
            $patientId = Patient::where('id', $tmpclientId->client_id)->firstOrFail()->id;
    
            $valid = Validite::all();
            $cpt = $valid->count();
            $idValidite = $valid[$cpt-1]->id;
    
            Session::create([
                'etat' => 1,
                'nbrConsultation' => 0,
                'patient_id' => $patientId,
                'validite_id' => $idValidite,
                'type_consultation_id' => $request->consultation
            ]);
            return view('caissier.historique', [
                'state' => 0
            ]);
        }
    }

    public function loadListeExamen($nom){
        return view('caissier.layouts.listeExamen', [
            'nom' => $nom
        ]);
    }

    public function loadListeConsultation($nom){
        return view('caissier.layouts.listeConsultation', [
            'nom' => $nom
        ]);
    }
}

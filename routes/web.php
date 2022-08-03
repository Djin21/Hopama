<?php

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AideSoignantController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CaisseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes pages de connexion
Route::post('/', [ConnexionController::class, 'login'])->name('connexion');
Route::get('/', [ConnexionController::class, 'connexion'])->name('accueil');

// Routes pages administrateur
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/examen/{idExamen?}', [AdminController::class, 'modifierExamen'])->name('admin.examen.modifier');
Route::get('/admin/examen/{idExamen?}', [AdminController::class, 'showExamen'])->name('admin.examen');
Route::post('/admin/examen/ajouter', [AdminController::class, 'ajouterExamen'])->name('admin.examen.ajouter');
Route::get('/admin/examen/ajouter', [AdminController::class, 'showFormExamen'])->name('admin.examen.show');
Route::get('/admin/listExamen/{name}', [AdminController::class, 'afficherListeExamen'])->name('admin.listeExamen');
Route::get('/admin/examen/supprimer/{idExamen?}', [AdminController::class, 'supprimerExamen'])->name('admin.examen.supprimer');
Route::get('/admin/restaurer/examen', [AdminController::class, 'restaurerExamen'])->name('admin.examen.restaurer');
Route::get('/admin/service', [AdminController::class, 'showService'])->name('admin.service');
Route::get('/admin/listService/{name}', [AdminController::class, 'afficherListeService'])->name('admin.listeService');
Route::post('/admin/service/{idService?}', [AdminController::class, 'modifierService'])->name('admin.service.modifier');
Route::get('/admin/service/supprimer/{idService?}', [AdminController::class, 'supprimerService'])->name('admin.service.supprimer');
Route::get('/admin/service/restaurer', [AdminController::class, 'restaurerService'])->name('admin.service.restaurer');
Route::get('/admin/personnel', [AdminController::class, 'showPersonnel'])->name('admin.personnel');
Route::get('/admin/listPersonnel/{name}', [AdminController::class, 'afficherListePersonnel'])->name('admin.listePersonnel');
Route::post('/admin/personnel/{idPersonnel?}', [AdminController::class, 'modifierPersonnel'])->name('admin.personnel.modifier');
Route::get('/admin/personnel/supprimer/{idPersonnel?}', [AdminController::class, 'supprimerPersonnel'])->name('admin.personnel.supprimer');
Route::get('/admin/restaurer/personnel', [AdminController::class, 'restaurerPersonnel'])->name('admin.personnel.restaurer');
Route::get('/admin/salle', [AdminController::class, 'showSalle'])->name('admin.salle');
Route::get('/admin/listSalle/{name}', [AdminController::class, 'afficherListeSalle'])->name('admin.listeSalle');
Route::post('/admin/salle/{idSalle?}', [AdminController::class, 'modifierSalle'])->name('admin.salle.modifier');
Route::get('/admin/salle/supprimer/{idSalle?}', [AdminController::class, 'supprimerSalle'])->name('admin.salle.supprimer');
Route::get('/admin/lit/supprimer/{idLit?}', [AdminController::class, 'supprimerLit'])->name('admin.lit.supprimer');
Route::get('/admin/restaurer/salle', [AdminController::class, 'restaurerSalle'])->name('admin.salle.restaurer');
Route::get('/admin/consultation', [AdminController::class, 'showConsultation'])->name('admin.consultation');
Route::post('/admin/consultation', [AdminController::class, 'modifierValidite'])->name('admin.validite');
Route::get('/admin/msgDiffus', [AdminController::class, 'showMsgDiffus'])->name('admin.msgDiffus');
Route::get('/admin/newMsgDiffus', [AdminController::class, 'showNewMsgDiffus'])->name('admin.newMsgDiffus');
Route::get('/admin/listePatientDyn/{nom}', [AdminController::class, 'showListePatientDyn'])->name('admin.listePatientDyn');
Route::get('/admin/listePatientStat/{nom}', [AdminController::class, 'showListePatientStat'])->name('admin.listePatientStat');
Route::post('/admin/sendMsg', [AdminController::class, 'sendMsgMultiple'])->name('admin.sendMsg');
Route::get('/admin/statAccouchement', [AdminController::class, 'showStatAccouchement'])->name('admin.statAccouchement');
Route::get('/admin/statDiagnostique', [AdminController::class, 'showStatDiagnostique'])->name('admin.statDiagnostique');
Route::get('/admin/impressionStatDiagnostique', [AdminController::class, 'impressionStatDiagnostique'])->name('admin.impressionStatDiagnostique');
Route::post('/admin/Consultation/{idConsultation?}', [AdminController::class, 'modifierConsultation'])->name('admin.consultation.modifier');

// Routes pages aide_soignants
Route::get('/aide_soignant', [AideSoignantController::class, 'dashboard'])->name('aide_soignant.dashboard');
Route::get('/aide_soignant/patients', [AideSoignantController::class, 'showPatientsListe'])->name('aide_soignant.patients');
Route::post('/aide_soignant/ajouter_patient', [AideSoignantController::class, 'addPatient'])->name('aide_soignant.enreg_patient');
Route::get('/aide_soignant/ajouter_patient', [AideSoignantController::class, 'showAddPatient'])->name('aide_soignant.ajouter_patient');
Route::get('/aide_soignant/enreg_params', [AideSoignantController::class, 'showEnregParams'])->name('aide_soignant.enreg_params');
Route::post('/aide_soignant/profile_patient/{idPatient}', [AideSoignantController::class, 'saveParamsPatient'])->name('aide_soignant.enreg_parametres');
Route::get('/aide_soignant/profile_patient/{idPatient}', [AideSoignantController::class, 'showProfilePatient'])->name('aide_soignant.profile_patient');
Route::get('/aide_soignant/historique', [AideSoignantController::class, 'showHistorique'])->name('aide_soignant.historique');
Route::get('/aide_soignant/listPatient/{name}', [AideSoignantController::class, 'afficherListePatient'])->name('aide_soignant.listePatient');
Route::get('/aide_soignant/histSession/{name}', [AideSoignantController::class, 'afficherHistSession'])->name('aide_soignant.histSession');
Route::post('/aide_soignant/saveAccouchement', [AideSoignantController::class, 'saveAccouchement'])->name('aide_soignant.saveAccouchement');
Route::get('/aide_soignant/accouchement', [AideSoignantController::class, 'showAccouchement'])->name('aide_soignant.accouchement');
Route::get('/aide_soignant/listPatientFille', [AideSoignantController::class, 'showListPatientFille'])->name('aide_soignant.listPatientFille');
Route::get('/aide_soignant/listAll/{nom}', [AideSoignantController::class, 'afficherListeAll'])->name('aide_soignant.listeAll');
Route::get('/aide_soignant/listSuivit/{nom}', [AideSoignantController::class, 'afficherListeSuivit'])->name('aide_soignant.listeSuivit');
Route::get('/aide_soignant/listHospitalisee/{nom}', [AideSoignantController::class, 'afficherListeHospitalisee'])->name('aide_soignant.listeHospitalisee');
Route::get('/aide_soignant/patientParametre/{idPatient}', [AideSoignantController::class, 'showPatientParametre'])->name('aide_soignant.patientParametre');
Route::post('/aide_soignant/saveInfosPatient/{idPatient}', [AideSoignantController::class, 'saveInfosPatient'])->name('aide_soignant.saveInfosPatient');
Route::get('/aide_soignant/histAccouchement', [AideSoignantController::class, 'showHistAccouchement'])->name('aide_soignant.histAccouchement');
Route::get('/aide_soignant/statAccouchement', [AideSoignantController::class, 'showStatAccouchement'])->name('aide_soignant.statAccouchement');
Route::post('/aide_soignant/newHospi', [AideSoignantController::class, 'setNewHospi'])->name('aide_soignant.setNewHospi');
Route::get('/aide_soignant/newHospi', [AideSoignantController::class, 'newHospi'])->name('aide_soignant.newHospi');
Route::get('/aide_soignant/listeLit/{idSalle}', [AideSoignantController::class, 'showListeLit'])->name('aide_soignant.listeLit');
Route::get('/aide_soignant/histHospi', [AideSoignantController::class, 'showHistHospi'])->name('aide_soignant.histHospi');

// Routes services
Route::get('/service', [ServiceController::class, 'dashboard'])->name('service.dashboard');
Route::get('/service/nouveauRDV', [ServiceController::class, 'showNewRDV'])->name('service.nouveauRDV');
Route::get('/service/historique', [ServiceController::class, 'showHistorique'])->name('service.historique');
Route::get('/service/historiqueGlobal', [ServiceController::class, 'showHistoriqueGlobal'])->name('service.historiqueGlobal');
Route::get('/service/examenListe', [ServiceController::class, 'showListeExamen'])->name('service.examenListe');
Route::post('/service/examenListe', [ServiceController::class, 'setResult'])->name('service.setResult');

// Routes caisse
Route::get('/caisse', [CaisseController::class, 'dashboard'])->name('caisse.dashboard')->middleware('connect');
Route::get('/listExam/{name}', [CaisseController::class, 'afficherListeExamen'])->name('caisse.liste');
Route::get('/caisse/listPatient/{name}', [CaisseController::class, 'afficherListePatient'])->name('caisse.listePatient');
Route::post('/caisse/paiementClient', [CaisseController::class, 'newSession'])->name('caisse.enregistrerClient');
Route::get('/caisse/paiementClient', [CaisseController::class, 'paiementClient'])->name('caisse.paiementClient');
Route::get('/caisse/paiementClient/show', [CaisseController::class, 'montrerPaiement'])->name('caisse.montrerPaiement');
Route::get('/caisse/paiementClient/{id}', [CaisseController::class, 'enregistrerPaiement'])->name('caisse.enregistrerPaiement');
Route::get('/caisse/historique', [CaisseController::class, 'showHistorique'])->name('caisse.historique');
Route::get('/caisse/bilan', [CaisseController::class, 'showBilan'])->name('caisse.bilan');
Route::get('/caisse/confirmationPaie', [CaisseController::class, 'confirmationPaie'])->name('confirmationPaie');
Route::post('/caisse/save_session', [CaisseController::class, 'enregistrerSession'])->name('caisse.save_session');
Route::get('/caisse/showExamenListe', [CaisseController::class, 'showExamenListe'])->name('caisse.examenListe');
Route::get('/caisse/listExamenPrescrit/{name}', [CaisseController::class, 'afficherListeExamenPrescrit'])->name('caisse.listeExamenPrescrit');
Route::get('/caisse/listExamenEffectue/{name}', [CaisseController::class, 'afficherListeExamenEffectue'])->name('caisse.listeExamenEffectue');
Route::post('/caisse/paiementExamen/patient', [CaisseController::class, 'saveExamenPatient'])->name('caisse.paiementExamen.save');
Route::get('/caisse/paiementExamen/patient', [CaisseController::class, 'showPaiementExamen'])->name('caisse.paiementExamen.patient');
Route::post('/caisse/savePaiementExamen/{idPrescription}', [CaisseController::class, 'savePaiementExamen'])->name('caisse.savePaiementExamen');
Route::post('/caisse/paiementExamen/paiement', [CaisseController::class, 'saveExamenPaiement'])->name('caisse.examenPaiement.save');
Route::get('/caisse/paiementExamen/paiement', [CaisseController::class, 'showExamenPaiement'])->name('caisse.examenPaiement.show');
Route::post('/caisse/paiementConsultation/paiement', [CaisseController::class, 'saveConsultationPaiement'])->name('caisse.consultationPaiement.save');
Route::get('/caisse/paiementConsultation/paiement', [CaisseController::class, 'showConsultationPaiement'])->name('caisse.consultationPaiement.show');
Route::get('/caisse/loadListeExamen/{nom}', [CaisseController::class, 'loadListeExamen'])->name('caisse.loadListeExamen');
Route::get('/caisse/loadListeConsultation/{nom}', [CaisseController::class, 'loadListeConsultation'])->name('caisse.loadListeConsultation');

// Routes medecin
Route::get('/medecin', [MedecinController::class, 'dashboard'])->name('medecin.dashboard')->middleware('connect');
// Route::get('/medecin', [MedecinController::class, 'dashboard'])->name('medecin.dashboard');
Route::get('/medecin/statistiques', [MedecinController::class, 'statistiques'])->name('medecin.statistiques');
Route::post('/medecin/consultation/nouveau', [MedecinController::class, 'saveConcultation'])->name('medecin.consultation.save');
Route::get('/medecin/consultation/liste/{consulter?}', [MedecinController::class, 'showConsultation'])->name('medecin.consultation.liste');
Route::get('/medecin/consultation/historique', [MedecinController::class, 'showHistorique'])->name('medecin.consultation.historique');
Route::get('/medecin/patient', [MedecinController::class, 'showPatient'])->name('medecin.patient');
Route::get('/medecin/rdv', [MedecinController::class, 'showRdv'])->name('medecin.rdv');
Route::get('/medecin/bilan', [MedecinController::class, 'showBilan'])->name('medecin.bilan');
Route::get('/medecin/dossierPatient', [MedecinController::class, 'showDossierPatient'])->name('medecin.dossierPatient');
Route::get('/medecin/listConsultation/{name}', [MedecinController::class, 'afficherListeConsultation'])->name('medecin.listeConsultation');
Route::get('/medecin/listRdv/{name}', [MedecinController::class, 'afficherListeRdv'])->name('medecin.listeRdv');
Route::get('/medecin/listRdvEffectue/{name}', [MedecinController::class, 'afficherListeRdvEffectue'])->name('medecin.listeRdvEffectue');
Route::get('/medecin/listRdvManque/{name}', [MedecinController::class, 'afficherListeRdvManque'])->name('medecin.listeRdvManque');
Route::get('/medecin/histConsultation/{name}', [MedecinController::class, 'afficherHistoriqueConsultation'])->name('medecin.HistoriqueConsultation');
Route::get('/medecin/consultation/{idProceder}', [MedecinController::class, 'showNewConsultation'])->name('medecin.consultation');
Route::post('/medecin/profile_patient/{idConsultation}', [MedecinController::class, 'saveConsultationPatient'])->name('medecin.saveConsultation');
Route::get('/medecin/profile_patient/{idConsultation}', [MedecinController::class, 'showProfil'])->name('medecin.profile_patient');
Route::get('/medecin/listPatient/{name}', [MedecinController::class, 'afficherListePatient'])->name('medecin.listePatient');
Route::get('/medecin/listLit/{name}', [MedecinController::class, 'afficherListeLit'])->name('medecin.listeLit');
Route::get('/medecin/profilConsultation', [MedecinController::class, 'afficherProfilConsultationPatient'])->name('medecin.profilConsultationPatient');
Route::get('/medecin/supprimer/examen_prescrit', [MedecinController::class, 'supprimerExamenPrescrit'])->name('medecin.supprimer.examen.prescrit');
Route::post('/medecin/rdv/modifier', [MedecinController::class, 'modifierRdv'])->name('medecin.modifierRdv');
Route::post('/medecin/rdv/delete', [MedecinController::class, 'deleteRdv'])->name('medecin.deleteRdv');
Route::get('/medecin/listeMaladies/{nom}', [MedecinController::class, 'showListeMaladies'])->name('medecin.listeMaladies');
Route::get('/medecin/listExamensPrescriptions/{nom}', [MedecinController::class, 'showListExamensPrescriptions'])->name('medecin.listExamensPrescriptions');
Route::get('/medecin/statMaladie', [MedecinController::class, 'showStatMaladie'])->name('medecin.statMaladie');
Route::get('/medecin/listStatMaladie/{nom}', [MedecinController::class, 'showListStatMaladie'])->name('medecin.listStatMaladie');
Route::get('/medecin/imprimer', [MedecinController::class, 'imprimer'])->name('medecin.imprimer');
Route::get('/medecin/testImpression', [MedecinController::class, 'testImpression'])->name('medecin.testImpression');
Route::get('/medecin/impressionStatMaladies', [MedecinController::class, 'impressionStatMaladies'])->name('medecin.impressionStatMaladies');
Route::get('/medecin/nbrConsult', [MedecinController::class, 'nbrConsultation'])->name('medecin.nbrConsult');
// Route::post('/medecin/agePatientConsulter/{intervalle}', [MedecinController::class, 'showAgePatient'])->name('medecin.agePatientConsulter');

// Route::get('/global/allPatient/{name}', [ConnexionController::class, 'showListePatient'])->name('global.all.listePat');
Route::get('/medecin/listAll/{name}', [MedecinController::class, 'afficherListeAll'])->name('medecin.listeAll');
Route::get('/medecin/listSuivit/{name}', [MedecinController::class, 'afficherListeSuivit'])->name('medecin.listeSuivit');
Route::get('/medecin/listHospitalisee/{name}', [MedecinController::class, 'afficherListeHospitalisee'])->name('medecin.listeHospitalisee');

// Global's routes
Route::get('/global/dossierPatient/{idPatient}', [ConnexionController::class, 'showdossierPatient'])->name('global.dossierPatient.show');
Route::get('/global/agePatientConsulter', [ConnexionController::class, 'showAgePatient'])->name('global.agePatientConsulter');
Route::get('/global/profile_patient/{idConsultation}', [ConnexionController::class, 'showProfil'])->name('global.profile_patient');
Route::get('/global/sendSmsOne/{idPatient}', [ConnexionController::class, 'sendSmsOne'])->name('global.sendSmsOne');
Route::get('/global/dynListePatient/{nom}', [ConnexionController::class, 'showDynListePatient'])->name('global.dynListePat');
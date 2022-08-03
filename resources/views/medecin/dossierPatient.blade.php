@extends('medecin.layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y ps-0">

    {{-- <div class="row" style="height: 50vh; width: 100%; background-color:antiquewhite">

    </div>
    <div class="row" style="height: 50vh; width: 100%; background-color:blue">

    </div> --}}
    {{-- Best color rgba(255, 255, 255, 0.699) --}}
    <div class="row m-0 p-0" style="width: 100%; height: 110vh">
        <div class="col-md-8" style="height: 100%">
            <div class="row h-100" style="height: 80%">
              <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link active"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-home"
                      aria-controls="navs-pills-justified-home"
                      aria-selected="true"
                    >
                      <i class="tf-icons bx bx-home"></i> Consultations
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-profile"
                      aria-controls="navs-pills-justified-profile"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-user"></i> Examens
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-messages"
                      aria-controls="navs-pills-justified-messages"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-message-square"></i> Rendez-vous
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-pills-justified-messages"
                      aria-controls="navs-pills-justified-messages"
                      aria-selected="false"
                    >
                      <i class="tf-icons bx bx-message-square"></i> Hospitalisation
                    </button>
                  </li>
                </ul>
                <div class="w-100 p-2 d-flex justify-content-start rounded-3 mb-3 shadow-sm" style="background-color: white;">
                  <div class="navbar-nav align-items-center d-flex justify-content-start w-100">
                    <div class="nav-item d-flex align-items-center w-100">
                      <i class="bx bx-search fs-4 lh-0"></i>
                      <input
                        type="text"
                        class="form-control border-0 shadow-none w-100"
                        placeholder="Search..."
                        aria-label="Search..."
                        id="searchexam"
                        
                      />
                    </div>
                  </div>
                </div>
                <div class="tab-content p-0 p-3 rounded-3" style="height: 100%; background-color:white;">
                  <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-3" style="border-radius:10px; background-color:rgba(201, 201, 201, 0.05);">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-3" style="border-radius:10px; background-color:rgba(201, 201, 201, 0.05);">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-3" style="border-radius:10px; background-color:rgba(201, 201, 201, 0.05);">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                    <div class="card d-flex flex-row justify-content-evenly py-3 px-4 mb-2">
                        <p class="p-0 m-0 me-auto">Type de la consultation</p>
                        <p class="p-0 m-0 mx-auto">Date</p>
                        <p class="p-0 m-0">Medecin</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-evenly" style="height:10%">
                <div class="card space-profile py-3 d-flex flex-row justify-content-start h-auto w-auto m-0" style="border-radius: 20px; background-color: rgba(255, 255, 255, 0.87);">
                    <button class="btn btn-icon btn-primary btn-xl m-0" style="cursor:default"><span class="bx bx-user" style="font-size: 2rem"></span></button>
                    <div class="m-0 ms-3">
                      <p class="m-0">Consultations</p>
                      <p class="m-0" style="font-size: 1.15rem; font-weight: bold">10</p>
                    </div>
                </div>
                <div class="card space-profile py-3 d-flex flex-row justify-content-start h-auto w-auto m-0" style="border-radius: 20px; background-color: rgba(255, 255, 255, 0.87);">
                    <button class="btn btn-icon btn-primary btn-xl m-0" style="cursor:default"><span class="bx bx-user" style="font-size: 2rem"></span></button>
                    <div class="m-0 ms-3">
                      <p class="m-0">Examens</p>
                      <p class="m-0" style="font-size: 1.15rem; font-weight: bold">10</p>
                    </div>
                </div>
                <div class="card space-profile py-3 d-flex flex-row justify-content-start h-auto w-auto m-0" style="border-radius: 20px; background-color: rgba(255, 255, 255, 0.87);">
                    <button class="btn btn-icon btn-primary btn-xl m-0" style="cursor:default"><span class="bx bx-user" style="font-size: 2rem"></span></button>
                    <div class="m-0 ms-3">
                      <p class="m-0">Rendez-vous</p>
                      <p class="m-0" style="font-size: 1.15rem; font-weight: bold">10</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Color : #696cff --}}
        <div class="col-md-4 px-2" style="height: 100%; ">
            <div style="height: 100%; width:100%;">
                <div class="infosPerso pb-4 card" style="width:100%; border-radius: 20px; background-color:white;">
                    <div class="row p-0 m-0 d-flex justify-content-center text-center pt-3 pb-3 infosPersoFirst" style=" width:100%; background-color:#696cff;">
                        <div class="image rounded-pill align-items-center d-flex flex-column justify-content-center" style="height: 80px; width: 80px; background-color: white;">
                            <span class="bx bx-user my-auto" style="font-size: 2rem; color:#696cff;"></span> 
                          </div>
                          <div class="name pt-4">
                              <h5 class="mb-1 pb-0" style="font-weight: 600; color:white;">Nom et prenom</h5>
                              <a href="" class="bn m-0 " style="color: rgba(255, 255, 255, 0.39); width:auto; height:auto;">Envoyer un message</a>
                          </div>
                          <div class="name pt-2">
                              <p class="m-0 p-0" style="font-size: 0.85rem; color:white;">Prochain rendez-vous</p>
                              <h6 class="m-0 p-0 mt-1" style="font-weight: 600; color:white;">Date du rdv</h6>
                          </div>
                    </div>
                    <div class="row d-flex justify-content-center p-0 m-0" style=" width:100%;">
                        <div class="mt-3" style=" width:100%;">
                            <div class="row pb-3 pt-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143); color:rgb(143, 143, 143)">Date de naissance :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Telephone :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                            </div>
                            <div class="row pb-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Sexe :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Adresse :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                            </div>
                            <div class="row pb-3 mb-md-0">
                                <div class="offset-1 col-6">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Statut matrimonial :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                                <div class="col-5">
                                    <p class="m-0 p-0" style="font-size: 0.85rem; color:rgb(143, 143, 143)">Enregistre le :</p>
                                    <h6 class="m-0 p-0 mt-1"><strong>Inconnu</strong></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row m-0 p-0 pt-4 mt-3 card" style=" width:100%; border-radius: 20px; background-color:white;">
                    <h5 class="text-start ms-4" style="font-weight: 600; width:100%">Parametres corporelles</h5>
                        <ul class="m-0 p-0 m-0 px-5 pt-2" style="list-style: none">
                            <li class="d-flex justify-content-between">
                                <p>Temperature</p>
                                <h6 style="font-size: 1.05rem">Inconnu</h6>
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Tension</p>
                                <h6 style="font-size: 1.05rem">Inconnu</h6>
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Poids</p>
                                <h6 style="font-size: 1.05rem">Inconnu</h6>
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Taille</p>
                                <h6 style="font-size: 1.05rem">Inconnu</h6>
                            </li>
                        </ul>
                </div> --}}
                <div class="row m-0 p-0 pt-4 mt-3 card" style=" width:100%; border-radius: 20px; background-color:white;">
                    <h5 class="text-start ms-4" style="font-weight: 600; width:100%">Antecedents</h5>
                        <ul class="m-0 p-0 m-0 px-3 pt-2" style="list-style: none">
                            <li class="mb-2 p-3" style="background-color: rgba(187, 187, 187, 0.199); border-radius:10px;">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent; ">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent'>
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="mb-2 p-3" style="background-color: rgba(187, 187, 187, 0.199); border-radius:10px;">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent; ">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent'>
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                            </li>
                            <li class="mb-2 p-3" style="background-color: rgba(187, 187, 187, 0.199); border-radius:10px;">
                                <div class="card d-flex flex-row justify-content-between" style="box-shadow: 0 0 0; background-color:transparent; ">
                                  <div class="text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Theme de l'antecedent
                                  </div>
                                    <button class="btn m-0 p-0" data-bs-toggle='modal' data-bs-target='#modalAntecedent'>
                                      <i class="bx bx-zoom-in"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
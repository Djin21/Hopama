<?php
  use App\Models\Personnel;


  $id = Session()->get('idPersonnel');
  $user = Personnel::find(Session()->get('idPersonnel'));

  // $cptNotif = 0;
  if($user->unreadNotifications == Null){
    $cptNotif = 0;
  }else{
    $cptNotif = count($user->unreadNotifications);
  }
?>

@if($cptNotif != 0)<span class="badge bg-warning rounded-pill mx-1">{{$cptNotif}}</span>@endif

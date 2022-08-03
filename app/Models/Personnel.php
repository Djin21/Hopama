<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Personnel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['nom', 'prenom', 'sexe', 'dateNaiss', 'lieuNaiss', 'telephone', 'code', 'service_id'];
}

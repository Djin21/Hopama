<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre_tmp extends Model
{
    use HasFactory;

    protected $fillable = ['temperature', 'tension', 'poids', 'taille', 'patient_id'];
}

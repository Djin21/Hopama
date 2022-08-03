<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen_prescrit extends Model
{
    use HasFactory;

    protected $fillable = ['etatPaiement', 'resultat', 'dateRealisation', 'prescription_id', 'examen_id', 'personnel_id'];
}

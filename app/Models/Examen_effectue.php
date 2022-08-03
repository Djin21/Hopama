<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen_effectue extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'resultat', 'paiement_id', 'personnel_id'];
}

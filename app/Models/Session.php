<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['etat', 'nbrConsultation', 'patient_id', 'validite_id', 'type_consultation_id'];
}

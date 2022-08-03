<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalisation extends Model
{
    use HasFactory;

    protected $fillable = ['dureePrevue', 'dureeRealisee', 'motif_sortie_id', 'prescription_id', 'lit_id'];
}

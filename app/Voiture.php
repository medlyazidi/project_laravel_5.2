<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{

    protected $fillable = [
        'marque', 'matricule', 'date_prochaine_assurance'
    ];
}

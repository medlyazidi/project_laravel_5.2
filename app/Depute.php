<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depute extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'sexe', 'photo', 'email', 'telephone', 'dateDebutMandat', 'dateFinMandat',
        'id_cree_par', 'id_typeDeputes', 'id_local'
    ];
}

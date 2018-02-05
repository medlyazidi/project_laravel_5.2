<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable = [
        'numero_banque', 'nom_banque', 'sugnataire', 'dateAjout',
        'dateOuvrageCompte', 'somme_compte', 'id_cree_par', 'id_banque'
    ];
}

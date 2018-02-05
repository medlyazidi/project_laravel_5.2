<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    protected $fillable = [
        'libelle_banque', 'dateAjout', 'id_cree_par'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousLigneB extends Model
{
    public $table = "sous_ligne_bs";
    protected $fillable = [
        'libelle_ss_ligneB', 'dateCreation', 'id_cree_par', 'id_ligneB'
    ];
}

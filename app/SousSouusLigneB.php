<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousSouusLigneB extends Model
{
    public $table = "sous_sous_ligne_bs";
    protected $fillable = [
        'libelle_ss_ss_ligneB', 'dateCreation', 'id_cree_par', 'id_ss_ligneB'
    ];
}

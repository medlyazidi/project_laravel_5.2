<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneBudgetaire extends Model
{
    public $table = "ligne_budgetaires";
    protected $fillable = [
        'libelle_ligneB', 'dateCreation', 'id_cree_par'
    ];
}

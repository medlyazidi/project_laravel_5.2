<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = [
        'id_depense','solde', 'id_compte', 'id_cree_par', 'id_ligneB', 'id_ss_ligneB', 'id_ss_ss_ligneB',
        'descriptif', 'date_operation', 'num_cheque', 'calssement', 'piece_joint','lien'
    ];
}

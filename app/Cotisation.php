<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    protected $fillable = [
        'montant', 'date_reception', 'date_encaissement', 'id_mode_paiement',
        'id_depute', 'id_compte', 'id_cree_par', 'piece_joint','lien','descriptif'
    ];
}

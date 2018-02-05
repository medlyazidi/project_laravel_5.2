<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    protected $fillable = [
        'montant', 'date', 'descriptif', 'id_type_ressouurce', 'id_compte', 'id_cree_par','lien'
    ];
}

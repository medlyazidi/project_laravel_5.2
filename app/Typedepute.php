<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typedepute extends Model
{
    public $table = "type_deputes";
    protected $fillable = [
        'libelle_typeDepute','somme_type'
    ];
}

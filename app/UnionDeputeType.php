<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnionDeputeType extends Model
{
    public $table = "union_depute_type";

    protected $fillable = [
        'id_typeDepute', 'id_depute'
    ];
}

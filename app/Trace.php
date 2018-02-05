<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    protected $fillable = [
        'operation', 'table', 'info', 'id_user'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coeficiente extends Model
{
    protected $fillable = [
        'name',
        'value',
        'description',
    ];
}

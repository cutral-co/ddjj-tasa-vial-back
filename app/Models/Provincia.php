<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $connection = 'admin';

    protected $table = 'provincias';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}

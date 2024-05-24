<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derivado extends Model
{
    protected $table = 'derivados';

    protected $fillable = [
        'id',
        'name',
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}

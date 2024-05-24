<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclaracionJuradaItem extends Model
{
    protected $table = 'dj_items';

    protected $fillable = [
        'id',
        'precio',
        'precio_final',
        'volumen_m3',
        'derivado_id',
        'dj_id',
    ];

    protected $hidden = [
        'derivado_id',
        'updated_at',
        'created_at'
    ];

    public function derivado()
    {
        return $this->belongsTo(Derivado::class);
    }

    public function dj()
    {
        return $this->belongsTo(DeclaracionJurada::class);
    }
}

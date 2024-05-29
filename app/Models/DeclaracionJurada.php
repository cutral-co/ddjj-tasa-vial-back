<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclaracionJurada extends Model
{
    protected $table = 'ddjj';

    protected $fillable = [
        'id',
        'periodo',

        'total',
        'total_percibido',
        'gastos_adm',
        'total_pagar',
        'rectificativa',

        'user_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    protected $appends = ['is_rectificable'];

    public function items()
    {
        return $this->hasMany(DeclaracionJuradaItem::class, 'dj_id');
    }

    public function getIsRectificableAttribute()
    {
        $maxRectificador = $this::where('user_id', $this->user_id)
            ->where('periodo', $this->periodo)
            ->max('rectificativa');

        return $this->rectificativa == $maxRectificador;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

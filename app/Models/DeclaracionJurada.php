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
        'razon_social',
        'total_precio',
        'user_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function items()
    {
        return $this->hasMany(DeclaracionJuradaItem::class, 'dj_id');
    }
}

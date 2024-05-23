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
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(ItemDeclaracionJurada::class, 'order_id');
    }
}

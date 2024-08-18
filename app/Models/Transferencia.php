<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use LogsActivity;

    protected $table = 'transferencias';

    protected $fillable = [
        'dj_id',
        'fecha_pago',
        'monto'
    ];

    protected $dates = ['fecha_pago'];

    protected $hidden = [
        'dj_id',
        'created_at',
        'updated_at'
    ];


}

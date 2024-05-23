<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDeclaracionJurada extends Model
{
    protected $table = 'dj_items';

    public function derivado()
    {
        return $this->belongsTo(Derivado::class);
    }
}

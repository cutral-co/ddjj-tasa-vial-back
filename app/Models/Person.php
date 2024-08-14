<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    protected $table = 'persons';
    protected $fillable = [
        'id',
        'cuit',
        'razon_social',
        'direccion',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['direccion', 'is_company'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getDireccionAttribute()
    {
        if (!$this->call && !$this->altura) {
            return null;
        }

        return [
            'calle' => $this->calle,
            'altura' => $this->altura,
            'manzana' => $this->manzana,
            'lote' => $this->lote,
            'piso' => $this->piso,
            'depto' => $this->depto,

            'municipio' => $this->municipio,
            'barrio' => $this->barrio_id ? $this->barrio_municipal : $this->barrio,
            'provincia' => $this->provincia ? $this->provincia : ($this->barrio_municipal ?  $this->barrio_municipal->provincia : null),
            'is_cutral' => (bool)$this->barrio_id,

            'string' => trim("$this->calle $this->altura $this->manzana $this->lote $this->piso $this->depto")
        ];
    }

    public function getIsCompanyAttribute()
    {
        return true;
    }
}

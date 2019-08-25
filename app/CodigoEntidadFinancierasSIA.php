<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoEntidadFinancierasSIA extends Model
{
    protected $fillable=['abreviatura','concepto'];


    public function puc()
    {
        return $this->hasMany(Puc::class);
    }



}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuentesFinancierasSIA extends Model
{
    protected $fillable=['abreviatura','concepto'];

    public function cuentasInstitucionales(){
        return $this->hasMany(CuentasInstitucionales::class);
    }

    public function puc()
    {
        return $this->hasMany(Puc::class);
    }



}

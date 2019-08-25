<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    protected $fillable=['nombre'];

    public function puc(){
        return $this->hasMany(Puc::class);
    }


    public function niff()
    {
        return $this->hasMany(Niff::class);
    }
}

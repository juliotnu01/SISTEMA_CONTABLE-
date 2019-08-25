<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivilegiosPUC extends Model
{
    protected $fillable=['nombrePrivilegio'];

    public function puc()
    {
        return $this->hasMany(Puc::class);
    }


    public function niff()
    {
        return $this->hasMany(Niff::class);
    }
}

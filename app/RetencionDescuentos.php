<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetencionDescuentos extends Model
{
    protected $fillable = ['anio', 'concepto', 'porcentaje', 'base', 'montoMinimo', 'iva', 'consumo', 'automatico',
        'tipoRetencion', 'activo', 'codigo_id', 'puc_id', 'empresa_id', 'RetoDes','detalle'];

    public function puc()
    {
        return $this->belongsTo(Puc::class);
    }

    public function codigo()
    {
        return $this->belongsTo(CodigoConcepto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function plantilaContable()
    {
        return $this->hasMany(PlantillaContable::class);
    }
}

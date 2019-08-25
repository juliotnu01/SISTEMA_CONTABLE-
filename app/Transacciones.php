<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Transacciones extends Model
{
    protected $fillable=['anio','mes','dia', 'numeroDoc', 'valortransaccion','codigoPresupuesto','tipoPago','valorBase'
        , 'revelacion', 'tercero_id', 'comprobante_id', 'tipoPresupuesto_id','plantilla','totalDebito', 'totalCredito',
        'diferencia','detalle'];

    public function  terceros()
    {
        return $this->belongsTo(Persona::class, 'tercero_id','id');
    }

    public function  comprobante()
    {
        return $this->belongsTo(Comprobante::class);
    }

    public function  TipoPresupuesto()
    {
        return $this->belongsTo(TipoPresupuesto::class);
    }

    public function plantilaContable()
    {
        return $this->hasMany(PlantillaContable::class, 'transacciones_id');
    }
}

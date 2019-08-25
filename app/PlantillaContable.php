<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantillaContable extends Model
{
    protected $fillable=['docReferencia', 'coNoCo', 'debito', 'credito', 'nota','base', 'codigoPUC',
        'codigoNIIIF','transacciones_id', 'transaccionesDescuento_id','valorRetenido','puc_id'];

    public function transaccion()
    {
        return $this->belongsTo(Transacciones::class, 'transacciones_id');
    }

    public function RetencionDescuento()
    {
        return $this->belongsTo(RetencionDescuentos::class);
    }

    public function pucs()
    {
        return $this->belongsTo(Puc::class, 'puc_id');
    }



}

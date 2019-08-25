<?php

namespace App\Http\Controllers;

use App\TipoPresupuestoComprobante;
use Illuminate\Http\Request;

class TipoPresupuestoController extends Controller
{
    public function loadTipoPresupuesto($id)
    {
        return response()->json(TipoPresupuestoComprobante::where('comprobante_id', $id)
            ->join('tipo_presupuestos', 'tipo_presupuestos.id', '=', 'tipo_presupuesto_comprobantes.tipoPresupuesto_id')
            ->join('comprobantes', 'comprobantes.id', '=', 'tipo_presupuesto_comprobantes.comprobante_id')
            ->select('tipo_presupuestos.id','tipo_presupuestos.nombrePresupuesto','comprobantes.activarDescuentos',
                    'comprobantes.estado')
            ->get());
    }
}

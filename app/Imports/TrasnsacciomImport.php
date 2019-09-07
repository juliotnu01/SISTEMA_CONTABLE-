<?php

namespace App\Imports;

use App\PlantillaContable;
use App\Transacciones;
use Maatwebsite\Excel\Concerns\ToModel;
class TrasnsacciomImport implements ToModel
{

    public function model(array $row)
    {
        $transaccion_para_actualizar = Transacciones::find($row[0]);

        $transaccion_para_actualizada = Transacciones::find($transaccion_para_actualizar->id)
                                                    ->update([
                                                        'totalDebito' => $transaccion_para_actualizar->totalDebito + $row[6],
                                                        'totalCredito' => $transaccion_para_actualizar->totalCredito + $row[7],
                                                        'diferencia' => $transaccion_para_actualizar->diferencia + $row[8]
                                                    ]);

        return new  PlantillaContable([
            'transacciones_id' => $row[0],
            'docReferencia' => $row[2],
            'puc_id'=> $row[3],
            'debito'=> $row[4],
            'credito'=> $row[5],
            'base'=>0
        ]);

    }
}

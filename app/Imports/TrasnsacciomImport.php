<?php

namespace App\Imports;

use App\PlantillaContable;
use App\Transacciones;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class TrasnsacciomImport implements ToModel
{

    public function model(array $row)
    {
        return new  PlantillaContable([
            'transacciones_id' => $row[0],
            'docReferencia' => $row[2],
            'debito'=> $row[3],
            'credito'=> $row[4],
            //'diferencia' => $row[3]-$row[2],
            'base'=>0
        ]);

    }
}

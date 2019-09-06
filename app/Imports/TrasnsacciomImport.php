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
            'puc_id'=> $row[3],
            'debito'=> $row[4],
            'credito'=> $row[5],
            'base'=>0
        ]);

    }
}

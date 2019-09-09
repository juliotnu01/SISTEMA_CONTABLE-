<?php

namespace App\Imports;

use App\Niff;
use Maatwebsite\Excel\Concerns\ToModel;

class NiffImport implements ToModel
{

    public function model(array $row)
    {
        return new Niff([
            'puc_id'=> $row[0],
            'codigoNiff'=> $row[3],
            'nombreNiff'=> $row[4],
            'tipoCuenta_id'=> $row[5],
            'naturalezaCuenta'=> $row[6],
            'nivel'=> $row[7],

        ]);
    }
}

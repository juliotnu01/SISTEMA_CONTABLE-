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
            'tipoCuenta_id'=> $row[3],
            'naturalezaCuenta'=> $row[4],
            'nivel'=> $row[5],
            'codigoNiff'=> $row[6],
            'nombreNiff'=> $row[7]
        ]);
    }
}

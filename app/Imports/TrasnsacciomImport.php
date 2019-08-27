<?php

namespace App\Imports;

use App\PlantillaContable;
use App\Transacciones;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class TrasnsacciomImport implements ToCollection
{

    public $repetidos = [];

    public function collection(Collection $rows)
    {
        $variable = Transacciones::where('numeroDoc', $rows[0])->get();

        if(count($variable) > 0){

            $this->repetidos[] = $rows;
        }
        if (Transacciones::where('numeroDoc', $rows[0])->count() > 0) {
            // si se repite lo guardamos en un arreglo
            $this->repetidos[] = $rows;
        } else {
            foreach ($rows as $row) {
                $plantilla = Transacciones::create([
                    'numeroDoc' => $row[0],
                    'totalDebito' => $row[3],
                    'totalCredito' => $row[4],
                    'diferencia' => $row[4]-$row[3],
                ]);
                //dd($row);

                $plantilla->plantilaContable()->create([
                    'codigoPUC'=> $row[1],
                    'docReferencia'=> $row[2],
                    'debito'=> $row[3],
                    'credito'=> $row[4],
                    'base'=>0
                ]);
            }
        }

    }
}

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
                    'totalDebito' => $row[4],
                    'totalCredito' => $row[5],
                    'diferencia' => $row[5]-$row[4],
                ]);
                //dd($row);

                $plantilla->plantilaContable()->create([
                    'codigoPUC'=> $row[1],
                    'docReferencia'=> $row[2],
                    'coNoCo'=> $row[3],
                    'debito'=> $row[4],
                    'credito'=> $row[5],
                    'base'=>0
                ]);
            }
        }

    }
}

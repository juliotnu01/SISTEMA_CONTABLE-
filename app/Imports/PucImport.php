<?php
namespace App\Imports;
use App\Puc;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
class PucImport implements ToModel
{
    public $repetidos = [];
    public function model(array $row)
    {
        $variable = Puc::where('codigoCuenta', $row[0])->get();
        if(count($variable) > 0){
            $this->repetidos[] = $row;
        }
        if (Puc::where('codigoCuenta', $row[0])->count() > 0) {
            // si se repite lo guardamos en un arreglo
            $this->repetidos[] = $row;
        } else {
            //si no se repite lo guardamos en la base
            return new Puc([
                'codigoCuenta' => $row[0],
                'codigoSuperior' => $row[1],
                'nombreCuenta' => $row[2],
                'fuentefinanciacionSIA_id' => 12,
                'codigoEntidadFinancieraSIA_id' => 29,
                'cuentaMaestra_id' => 8,
                'futExcedentesLiquidez_id' => 1,
                'empresa_id' => 1,
                'conceptoDian_id' => 102,
                'formatoDian_id' => 8,
                'opcionesPrivilegios_id' => 8,
                'tipoCuenta_id' => $row[3],
                'naturalezaCuenta' => $row[4],
                'nivel' => $row[5],
            ]);
        }
    }
}
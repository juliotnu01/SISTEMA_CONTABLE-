<?php

namespace App\Http\Requests;

use App\Puc;
use Illuminate\Foundation\Http\FormRequest;

class CuentaRequest extends FormRequest
{
    protected $cuenta;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //$this->cuenta = Puc::where([
           // 'codigoCuenta' => $this->codigoSuperior.$this->codigoCuenta])->first();
        //if($this->cuenta){
            return [
                'codigoCuenta' => 'unique:pucs'
            ];
       // }

       // return [];
    }

    public function messages()
    {
        //$cuentaExistente = $this->cuenta ? $this->cuenta->nombreCuenta : '';
        return [
            'codigoCuenta.unique' => 'El codigo de la cuenta ya esta asignada'
        ];
    }
}

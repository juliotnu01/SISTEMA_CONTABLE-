<?php

namespace App\Exports;

use App\Puc;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PucExport implements FromCollection,WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Codigo de Cuenta',
            'codigo cueta Superior ',
            'Nombre de Cuenta',
            'Naturaleza Cuenta',
            'Cuenta Corriente o No Corriente',
            'cuenta por Cobrar',
            'Cuenta por Pagar',
            'Refiere Flujo',
            'Exige Terceros',
            'Exige CentroCostos',
            'Exige Base',
            'Activa',
            'Porcentaje',
            'Privilegio',
            'Número de Cuenta',
            'Descripcion',
            'Tipo de Cuenta Bancaria',
            'Situacion de Fondos',
            'Uso de Cuenta Bancaria',
            'Posición Clasificador Presupuestal de Gastos',
            'Posición Clasificador Presupuestal de Ingresos',
            'Código Interno',
            'Código Sucursal',
            'Fuentes Financieras SIA',
            'Entidad Financieras SIA',
            'Cuenta Maestra',
            'FUT Excedentes de Liquidezs',
            'Concepto DIAN exogenos',
            'Formato DIAN Exogenos',
        ];
    }

    public function collection()
    {
        return DB::table('pucs')
            ->join('fuentes_financieras_s_i_as', 'fuentes_financieras_s_i_as.id', '=', 'pucs.fuentefinanciacionSIA_id')
            ->join('codigo_entidad_financieras_s_i_as', 'codigo_entidad_financieras_s_i_as.id', '=', 'pucs.codigoEntidadFinancieraSIA_id')
            ->join('cuenta_maestas', 'cuenta_maestas.id', '=', 'pucs.cuentaMaestra_id')
            ->join('tipo_cuentas', 'tipo_cuentas.id', '=', 'pucs.tipoCuenta_id')
            ->join('f_u_t_excedentes_liquidezs', 'f_u_t_excedentes_liquidezs.id', '=', 'pucs.futExcedentesLiquidez_id')
            ->join('concepto_dian_exogenos', 'concepto_dian_exogenos.id', '=', 'pucs.conceptoDian_id')
            ->join('formato_dian_exogenos', 'formato_dian_exogenos.id', '=', 'pucs.formatoDian_id')
            ->join('entidad_bancarias', 'entidad_bancarias.id', '=', 'pucs.opcionesPrivilegios_id')
            ->join('privilegios_p_u_cs', 'privilegios_p_u_cs.id', '=', 'pucs.opcionesPrivilegios_id')

            ->select('pucs.codigoCuenta', 'pucs.codigoSuperior', 'pucs.nombreCuenta','tipo_cuentas.nombre',
                'pucs.naturalezaCuenta', 'pucs.CuentaCoNC', 'pucs.cuentaCobrar', 'pucs.cuentaPagar',
                'pucs.refiereFlujo', 'pucs.exigeTerceros', 'pucs.exigeCentroCostos', 'pucs.exigeBase', 'pucs.activa',
                'pucs.porcentaje','privilegios_p_u_cs.nombrePrivilegio','pucs.numeroCuenta','pucs.descripcion',
                'pucs.tipoCuentaBancaria','pucs.situacionFondos','pucs.usocuentaBancaria','pucs.posicionClasificadorPresupuestalGastos',
                'pucs.posicionClasificadorPresupuestalIngresos','pucs.codigoInterno','pucs.codigoSucursal',
                'pucs.porcentaje',

                'fuentes_financieras_s_i_as.concepto','codigo_entidad_financieras_s_i_as.abreviatura',
                'cuenta_maestas.conceptoCuentaMaestra','f_u_t_excedentes_liquidezs.conceptoLiquidez',
                'concepto_dian_exogenos.concepto', 'formato_dian_exogenos.nombreFormatoDian'

            )

            ->get();

        //dd($d->toArray());
    }
}


<?php

namespace App\Http\Controllers;

use App\conceptoDianExogeno;
use App\CuentaMaesta;
use App\Exports\PucExport;
use App\formatoDianExogeno;
use App\Http\Requests\CuentaRequest;
use App\Imports\PucImport;
use App\PrivilegiosPUC;
use App\Puc;
use App\TipoCuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Excel;

class planCuentasPUCController extends Controller
{

    public function index()
    {
        $p = new PucImport;
        $search = Input::get('search');
        if($search){
            $pucQuery = puc::where('codigoCuenta',$search);

        }else{
            $pucQuery=puc::whereNull('codigoSuperior');

        }
        $puc = $pucQuery->with('cuentas.cuentas.cuentas.cuentas.cuentas')
                        ->where('id','!=',1)
                        ->get();
        $pucTipoCuenta=Puc::select('tipoCuenta');
        //return response()->json($puc);
        return view('planUnicoCuentas.index',compact('puc','pucTipoCuenta'));
        //return view('planUnicoCuentas.index');
    }

    public function create(Puc $cuenta)
    {
        $concepto=conceptoDianExogeno::all();
        $pucs=Puc::all();
        $maesta=CuentaMaesta::all();
        $formato=formatoDianExogeno::all();
        $privilegios=PrivilegiosPUC::all();
        $tipoCuentas=TipoCuenta::all();
        return view('planUnicoCuentas.create',compact('concepto','formato','privilegios',
            'pucs','cuenta','maesta','tipoCuentas'));

    }

    public function store(CuentaRequest $request)
    {
        $puc=new Puc();
        //dd($request->all());
        $puc->codigoCuenta=$request->input('codigoCuenta');
        $puc->codigoSuperior=$request->input('codigoSuperior');
        $puc->nombreCuenta=$request->input('nombreCuenta');
        $puc->tipoCuenta_id=$request->input('tipoCuenta_id');
        $puc->naturalezaCuenta=$request->input('naturalezaCuenta');
        $puc->CuentaCoNC=$request->input('CuentaCoNC');
        $puc->cuentaCobrar=$request->input('cuentaCobrar');
        $puc->cuentaPagar=$request->input('cuentaPagar');
        $puc->refiereFlujo=$request->input('refiereFlujo');
        $puc->exigeTerceros=$request->input('exigeTerceros');
        $puc->exigeCentroCostos=$request->input('exigeCentroCostos');
        $puc->exigeBase=$request->input('exigeBase');
        $puc->activa=$request->input('activa');
        $puc->numeroCuenta=$request->input('numeroCuenta');
        $puc->descripcion=$request->input('descripcion');
        $puc->tipoCuentaBancaria=$request->input('tipoCuentaBancaria');
        $puc->situacionFondos=$request->input('situacionFondos');
        $puc->usocuentaBancaria=$request->input('usocuentaBancaria');
        $puc->posicionClasificadorPresupuestalGastos=$request->input('posicionClasificadorPresupuestalGastos');
        $puc->posicionClasificadorPresupuestalIngresos=$request->input('posicionClasificadorPresupuestalIngresos');
        $puc->codigoInterno=$request->input('codigoInterno');
        $puc->codigoSucursal=$request->input('codigoSucursal');
        if (isset($request->cuentaMaestra_id)){
            $puc->cuentaMaestra_id= $request->input('cuentaMaestra_id');
        }else{
            $puc->cuentaMaestra_id=8;
        }
        $puc->nivel=$request->input('nivel');
        $puc->fuentefinanciacionSIA_id=12;
        $puc->codigoEntidadFinancieraSIA_id=29;
        $puc->futExcedentesLiquidez_id=1;
        $puc->cuentaMaestraSalud=$request->input('cuentaMaestraSalud');
        $puc->empresa_id=$request->input('empresa_id');
        $puc->persona_id=$request->input('persona_id');
        $puc->conceptoDian_id=$request->input('conceptoDian_id');
        $puc->formatoDian_id=$request->input('formatoDian_id');
        //$puc->opcionesPrivilegios_id= $request->input('opcionesPrivilegios_id')
        if (isset($request->opcionesPrivilegios_id)){
            $puc->opcionesPrivilegios_id= $request->input('opcionesPrivilegios_id');
        }else{
            $puc->opcionesPrivilegios_id=8;
        }
        $puc->porcentaje=$request->input('porcentaje');
        //dd($puc);
        $puc->save();
        Session::flash('message','Cuenta registrada con exito');
        return redirect()->route('puc.index');
    }

    public function edit($id)
    {
        $puc=Puc::find($id);
        $concepto=conceptoDianExogeno::all();
        $formato=formatoDianExogeno::all();
        $privilegios=PrivilegiosPUC::all();
        $maesta=CuentaMaesta::all();
        $tipoCuentas=TipoCuenta::all();
        //dd($puc);
        return view('planUnicoCuentas.edit',compact('concepto','formato','puc',
            'privilegios','maesta','tipoCuentas'));
    }

    public function update(Request $request, $id)
    {
        $puc=Puc::find($id);
        //dd($puc->opcionesPrivilegios_id=$request->opcionesPrivilegios_id);
        //$request->all();
        $puc->codigoCuenta=$request->codigoCuenta;
        $puc->codigoSuperior=$request->codigoSuperior;
        $puc->nombreCuenta=$request->nombreCuenta;
        $puc->tipoCuenta_id=$request->tipoCuenta_id;
        $puc->naturalezaCuenta=$request->naturalezaCuenta;
        $puc->CuentaCoNC=$request->CuentaCoNC;
        $puc->cuentaCobrar=$request->cuentaCobrar;
        $puc->cuentaPagar=$request->cuentaPagar;
        $puc->refiereFlujo=$request->refiereFlujo;
        $puc->exigeTerceros=$request->exigeTerceros;
        $puc->exigeCentroCostos=$request->exigeCentroCostos;
        $puc->exigeBase=$request->exigeBase;
        $puc->activa=$request->activa;
        $puc->numeroCuenta=$request->numeroCuenta;
        $puc->descripcion=$request->descripcion;
        $puc->tipoCuentaBancaria=$request->tipoCuentaBancaria;
        $puc->situacionFondos=$request->situacionFondos;
        $puc->usocuentaBancaria=$request->usocuentaBancaria;
        $puc->posicionClasificadorPresupuestalGastos=$request->posicionClasificadorPresupuestalGastos;
        $puc->posicionClasificadorPresupuestalIngresos=$request->posicionClasificadorPresupuestalIngresos;
        $puc->codigoInterno=$request->codigoInterno;
        $puc->codigoSucursal=$request->codigoSucursal;
        $puc->fuentefinanciacionSIA_id=$request->fuentefinanciacionSIA_id;
        $puc->fuentefinanciacionSIA_id=12;
        $puc->codigoEntidadFinancieraSIA_id=29;
        $puc->cuentaMaestra_id=8;
        $puc->futExcedentesLiquidez_id=1;
        $puc->empresa_id=$request->empresa_id;
        $puc->cuentaMaestraSalud=$request->cuentaMaestraSalud;
        $puc->persona_id=$request->persona_id;
        $puc->nivel=$request->nivel;
        $puc->conceptoDian_id=$request->conceptoDian_id;
        $puc->formatoDian_id=$request->formatoDian_id;
        if (isset($request->opcionesPrivilegios_id)){
            $puc->opcionesPrivilegios_id= $request->input('opcionesPrivilegios_id');
        }else{
            $puc->opcionesPrivilegios_id=8;
        }
        $puc->opcionesPrivilegios_id=$request->opcionesPrivilegios_id;
        $puc->porcentaje=$request->porcentaje;
        //dd($puc);
        $puc->save();
        Session::flash('message','Cuenta editada con exito');
        return redirect()->route('puc.index');
    }

    public function destroy($id)
    {
        try {
            //Eliminar registro
            Puc::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('message','Esta ya cuenta ya tiene movimientos, no se puede eliminar');
            return redirect()->route('puc.edit',$id);
            //return back()->with('message','EL registro no puede ser eliminado, comuniquese con el desarrollador');
        }
        //Retornar vista
        Session::flash('message','EL registro se elimino con exito');
        return redirect()->route('puc.index');
        /*ClasePersona::find($id)->delete();
        return back()->with('info', 'Eliminado correctamente');*/
    }

    public function exportPuc()
    {
        return (new PucExport)->download('PUC.xlsx');
    }

    public function import(Request $request)
    {
        try {
            //DB::table('pucs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::table('pucs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            $request->hasFile('excel');
            $archivo = $request->file('excel');
            $p = new PucImport;
            \Excel::import($p, $archivo);
             $duplicado=$p->repetidos;

            $pucRepetido = Puc::select('codigoCuenta')
                ->where('codigoCuenta' ,$p->repetidos)
                ->get();

            /*foreach ($pucRepetido as $key => $item){
                dd(json_encode($item));
            }
            dd($pucRepetido);*/
            // Confirmar si el email ya se encuentra registrado
            if (count($pucRepetido) > 0) {
                Session::flash('email','Un numero de cuenta repetido es '. $pucRepetido);
                return redirect()->route('puc.index');
            }

            /* if ($duplicado){
                 $cuenta=$duplicado;
                 //dd($cuenta);
                 Session::put('cuenta', $cuenta);
                 //dd(Session::get('cuenta'));
                 Session::flash('cuenta','Un numero de cuenta');
                return  redirect()->route('puc.index');
             }*/
            return  redirect()->route('puc.index')->with('message', 'Cuentas PUC Creadas Correctamente');

       }
        catch (\Illuminate\Database\QueryException $e) {
            //dd($archivo);
            Session::flash('message','Error, por favor vedifica tu excel o intentalo mas tarde.');
            return redirect()->route('puc.index');
        }
    }

    public function downloadPlantilla()
    {
        $file= public_path(). "/files/PUC-PLANTILLA.xlsx";

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->download($file, 'PUC-PLANTILLA.xlsx', $headers);
    }

}

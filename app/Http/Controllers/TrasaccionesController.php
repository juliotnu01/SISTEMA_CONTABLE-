<?php

namespace App\Http\Controllers;

use App\Comprobante;
use App\Empresa;
use App\Exports\TransaccionesExport;
use App\Http\Requests\TrassaccionesRequest;
use App\Imports\TrasnsacciomImport;
use App\Niff;
use App\PlantillaContable;
use App\Persona;
use App\Puc;
use App\RetencionDescuentos;
use App\Sede;
use App\TipoPresupuesto;
use App\Transacciones;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrasaccionesController extends Controller
{
    public function index()
    {
        $trasacciones = DB::table('transacciones')
            ->join('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->join('tipo_presupuestos', 'transacciones.tipoPresupuesto_id', '=', 'tipo_presupuestos.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id', 'transacciones.anio', 'transacciones.mes', 'transacciones.dia',
                'transacciones.numeroDoc', 'transacciones.valortransaccion', 'transacciones.valortransaccionLetras', 'personas.nombre1', 'personas.nombre2', 'personas.apellido', 'personas.apellido2',
                'comprobantes.nombreSoporte', 'tipo_presupuestos.nombrePresupuesto', 'transacciones.valorBase')
            ->where('transacciones.plantilla', '=', 'NO')
            ->where('transacciones.diferencia', '=', 0)
            ->get();

        $trasaccionesErronea=DB::table('transacciones')
            ->join('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->join('tipo_presupuestos', 'transacciones.tipoPresupuesto_id', '=', 'tipo_presupuestos.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id', 'transacciones.anio', 'transacciones.mes', 'transacciones.dia',
                'transacciones.numeroDoc', 'transacciones.valortransaccion', 'transacciones.valortransaccionLetras', 'personas.nombre1', 'personas.nombre2', 'personas.apellido', 'personas.apellido2',
                'comprobantes.nombreSoporte', 'tipo_presupuestos.nombrePresupuesto', 'transacciones.valorBase')
            ->where('transacciones.plantilla', '=', 'NO')
            ->where('transacciones.diferencia', '!=', 0)
            ->get();

        $trasaccionesPlantilla =DB::table('transacciones')
            ->join('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->join('tipo_presupuestos', 'transacciones.tipoPresupuesto_id', '=', 'tipo_presupuestos.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id', 'transacciones.anio', 'transacciones.mes', 'transacciones.dia',
                'transacciones.numeroDoc', 'transacciones.valortransaccion', 'transacciones.valortransaccionLetras', 'personas.nombre1', 'personas.nombre2', 'personas.apellido', 'personas.apellido2',
                'comprobantes.nombreSoporte', 'tipo_presupuestos.nombrePresupuesto', 'transacciones.valorBase')
            ->where('transacciones.plantilla', '=', 'NO')
            ->get();

        $tipoPresupuesnto = TipoPresupuesto::all();
        //dd($retenciones);
        return view('transacciones.index', compact('trasacciones', 'trasaccionesPlantilla',
            'tipoPresupuesnto','trasaccionesErronea'));
    }

    public function create()
    {
        $comprobante = Comprobante::select('id', 'abreviatura', 'nombreSoporte', 'activarDescuentos')
            ->where('estado', '=', 'SI')
            ->get();
        $puc = Puc::select('id', 'codigoCuenta', 'nombreCuenta', 'tipoCuenta_id')->get();
        $niif = Niff::all();
        $ultimoNumeroDoc=Transacciones::select('id','numeroDoc')->orderby('id','DESC')->take(1)->get();
        //dd($ultimoNumeroDoc);
        $centroCosto = Sede::all();
        $numDocs = Transacciones::select('numeroDoc', 'created_at')->get();
        $terceros = Persona::with('natural', 'juridica', 'empleado')->get();
        //$tipoPresupuestos = Comprobante::with('tipoPresupuesto');
        $tipoPresupuestos = TipoPresupuesto::all();
        $retenciones = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.tipoRetencion', 'retencion_descuentos.iva'
                , 'retencion_descuentos.concepto', 'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff')
            ->where('retencion_descuentos.RetoDes', '=', null)
            ->get();
        //dd($retenciones);
        $descuentos = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff', 'niffs.puc_id',
                'retencion_descuentos.activo')
            ->where('retencion_descuentos.activo', '=', 'SI')
            ->where('retencion_descuentos.RetoDes', '=', 'DESCUENTO')
            //->orWhere('niffs.puc_id', '=', null)
            //->orWhere('niffs.puc_id', '!=', null)
            ->get();
        //dd($descuentos);
        return view('transacciones.create', compact('comprobante', 'retenciones',
            'tipoPresupuestos', 'terceros', 'numDocs', 'descuentos', 'puc', 'niif', 'centroCosto','ultimoNumeroDoc'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $trans = new Transacciones;

        $erros = \Validator::make($request->all(), [

            'numeroDoc' => 'unique:transacciones'
        ]);

        if ($erros->fails()) {
            return redirect()->back()->withInput()->withErrors($erros->errors());
        }

        //$trans->create($request->all());
        //dd($request->all());
        // $trans = new Transacciones();
        //AGRUPAR FECHA
        $trans->anio = $request->anio;
        $trans->mes = $request->mes;
        $trans->dia = $request->dia;
        //DEMAS CAMPOS
        $trans->numeroDoc = $request->numeroDoc;
        $trans->codigoPresupuesto = $request->codigoPresupuesto;
        $trans->valortransaccion = $request->valortransaccion;
        $trans->valortransaccionLetras = $request->valortransaccionLetras;
        $trans->valorBase = $request->valorBase;
        $trans->revelacion = $request->revelacion;
        $trans->tercero_id = $request->tercero_id;
        $trans->comprobante_id = $request->comprobante_id;
        $trans->tipoPresupuesto_id = $request->tipoPresupuesto_id;
        $trans->detalle = $request->detalle;
        $trans->plantilla = $request->plantilla;
        $trans->totalDebito = $request->totalDebito;
        $trans->totalCredito = $request->totalCredito;
        $trans->diferencia = $request->diferencia;
        $trans->tipoPago = $request->tipoPago;
        $trans->save();
        if ($request->transacciones_id) {
            $plantillaContable = $request->transacciones_id;
            foreach ($plantillaContable as $key => $value) {

                $trans->plantilaContable()->create([

                    'transacciones_id' => $request->transacciones_id[$key],
                    'docReferencia' => $request->docReferencia[$key],
                    'centroCosto_id' => $request->centroCosto_id[$key],
                    'debito' => $request->debito[$key],
                    'credito' => $request->credito[$key],
                    'retecionesDescuentos_id' => $request->retecionesDescuentos_id[$key],
                    'base' => $request->base[$key],
                    'nota' => $request->nota[$key],
                    'valorRetenido' => $request->valorRetenido[$key],
                    'codigoNIIIF' => $request->codigoNIIIF[$key],
                    'puc_id' => $request->puc_id[$key],

                ]);
            }
        }


        Session::flash('message', 'El registro se creo con exito');
        return redirect()->route('transaccion.index');
    }

    public function duplicate(Request $request, $id)
    {
        $trasacciones = Transacciones::findOrFail($id);
        //dd($trasacciones);
        $comprobante = Comprobante::select('id', 'abreviatura', 'nombreSoporte', 'activarDescuentos')
            ->where('estado', '=', 'SI')
            ->get();
        $puc = Puc::all();
        $centroCosto = Sede::all();
        $niif = Niff::all();
        $numDocs = Transacciones::select('numeroDoc', 'created_at')->get();
        $terceros = Persona::with('natural', 'juridica', 'empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
        /* $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
             ->select('id','docReferencia', 'centroCosto_id', 'debito', 'credito', 'nota', 'codigoPUC',
                 'codigoNIIIF','transacciones_id', 'transacciones_id','valorRetenido','puc_id')
             ->get();*/
        $plantillaRetenciones = DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->leftJoin('pucs', 'plantilla_contables.puc_id', '=', 'pucs.id')
            ->select('plantilla_contables.id', 'plantilla_contables.docReferencia', 'plantilla_contables.centroCosto_id',
                'plantilla_contables.debito', 'plantilla_contables.credito', 'plantilla_contables.nota',
                'plantilla_contables.base', 'plantilla_contables.codigoNIIIF', 'plantilla_contables.transacciones_id',
                'plantilla_contables.transacciones_id', 'plantilla_contables.valorRetenido', 'plantilla_contables.retecionesDescuentos_id',
                'puc_id', 'transacciones.totalDebito', 'transacciones.totalCredito', 'transacciones.diferencia',
                'pucs.codigoCuenta', 'pucs.nombreCuenta')
            ->where('plantilla_contables.transacciones_id', '=', $id)
            ->get();
        //dd($plantillaRetenciones);
        $retenciones = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.tipoRetencion', 'retencion_descuentos.iva'
                , 'retencion_descuentos.concepto', 'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff')
            ->where('retencion_descuentos.RetoDes', '=', null)
            ->get();
        $descuentos = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff', 'niffs.puc_id',
                'retencion_descuentos.activo')
            ->where('retencion_descuentos.activo', '=', 'SI')
            ->where('retencion_descuentos.RetoDes', '=', 'DESCUENTO')
            //->orWhere('niffs.puc_id', '=', null)
            //->orWhere('niffs.puc_id', '!=', null)
            ->get();
        //dd($descuentos);
        return view('transacciones.duplicar', compact('comprobante', 'retenciones',
            'tipoPresupuestos', 'terceros', 'numDocs', 'descuentos', 'trasacciones', 'plantillaRetenciones', 'puc', 'niif', 'centroCosto'));
    }

    public function edit($id)
    {
        $trasacciones = Transacciones::findOrFail($id);
        //dd($trasacciones);
        $comprobante = Comprobante::select('id', 'abreviatura', 'nombreSoporte', 'activarDescuentos')
            ->where('estado', '=', 'SI')
            ->get();
        $puc = Puc::all();
        $centroCosto = Sede::all();
        $niif = Niff::all();
        $numDocs = Transacciones::select('numeroDoc', 'created_at')->get();
        $terceros = Persona::with('natural', 'juridica', 'empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
        /* $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
             ->select('id','docReferencia', 'centroCosto_id', 'debito', 'credito', 'nota', 'codigoPUC',
                 'codigoNIIIF','transacciones_id', 'transacciones_id','valorRetenido','puc_id')
             ->get();*/
        $plantillaRetenciones = DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->leftJoin('pucs', 'plantilla_contables.puc_id', '=', 'pucs.id')
            ->select('plantilla_contables.id', 'plantilla_contables.docReferencia', 'plantilla_contables.centroCosto_id',
                'plantilla_contables.debito', 'plantilla_contables.credito', 'plantilla_contables.nota',
                'plantilla_contables.base', 'plantilla_contables.codigoNIIIF', 'plantilla_contables.transacciones_id',
                'plantilla_contables.transacciones_id', 'plantilla_contables.valorRetenido', 'plantilla_contables.retecionesDescuentos_id',
                'puc_id', 'transacciones.totalDebito', 'transacciones.totalCredito', 'transacciones.diferencia',
                'pucs.codigoCuenta', 'pucs.nombreCuenta')
            ->where('plantilla_contables.transacciones_id', '=', $id)
            ->get();
        //dd($plantillaRetenciones);
        $retenciones = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.tipoRetencion', 'retencion_descuentos.iva'
                , 'retencion_descuentos.concepto', 'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff')
            ->where('retencion_descuentos.RetoDes', '=', null)
            ->get();
        $descuentos = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff', 'niffs.puc_id',
                'retencion_descuentos.activo')
            ->where('retencion_descuentos.activo', '=', 'SI')
            ->where('retencion_descuentos.RetoDes', '=', 'DESCUENTO')
            //->orWhere('niffs.puc_id', '=', null)
            //->orWhere('niffs.puc_id', '!=', null)
            ->get();
        //dd($descuentos);
        //dd($descuentos);
        return view('transacciones.edit', compact('comprobante', 'retenciones',
            'tipoPresupuestos', 'terceros', 'numDocs', 'descuentos', 'trasacciones', 'plantillaRetenciones', 'puc', 'niif', 'centroCosto'));
    }

    public function update(Request $request, $id)
    {
        $trans=Transacciones::findOrFail($id);
       // dd($request->all());
        $debito=$request->debito;
        $credito=$request->credito;
        //dd($debito, );
        $trans->anio= $request->anio;
        $trans->mes=$request->mes;
        $trans->dia=$request->dia;
        //DEMAS CAMPOS
        $trans->numeroDoc= $request->numeroDoc;
        $trans->codigoPresupuesto= $request->codigoPresupuesto;
        $trans->valortransaccion= $request->valortransaccion;
        $trans->valortransaccionLetras = $request->valortransaccionLetras;
        $trans->valorBase= $request->valorBase;
        $trans->revelacion= $request->revelacion;
        $trans->tercero_id= $request->tercero_id;
        $trans->comprobante_id= $request->comprobante_id;
        $trans->tipoPresupuesto_id= $request->tipoPresupuesto_id;
        $trans->detalle= $request->detalle;
        $trans->plantilla = $request->plantilla;
        $trans->totalDebito = $request->totalDebito;
        $trans->totalCredito = $request->totalCredito;
        $trans->diferencia = $request->diferencia;
        $trans->tipoPago = $request->tipoPago;
        $trans->save();
        if ($request->transacciones_id){
            $plantillaContable = $request->transacciones_id;
            foreach($plantillaContable as $key => $value) {
                $trans->plantilaContable()->create([
                    'transacciones_id' => $request->transacciones_id[$key],
                    'docReferencia' => $request->docReferencia[$key],
                    'centroCosto_id' => $request->centroCosto_id[$key],
                    'debito' => $request->debito[$key],
                    'credito' => $request->credito[$key],
                    'base' => $request->base[$key],
                    'nota' => $request->nota[$key],
                    'valorRetenido' => $request->valorRetenido[$key],
                    'codigoNIIIF' => $request->codigoNIIIF[$key],
                    'puc_id' => $request->puc_id[$key],
                ]);
            }
        }
        Session::flash('message', 'El registro se edito con exito');
        return back();

    }

    public function updatePlantilla(Request $request, $id)
    {

        $plantilla=PlantillaContable::findOrFail($id);
        $temporalDebito= $request->debitoTemporal;
        $temporalCredito= $request->creditoTemporal;
        $plantilla->docReferencia=$request->docReferencia;
        $plantilla->centroCosto_id= $request->centroCosto_id;
        $plantilla->debito= $request->debito;
        $plantilla->credito= $request->credito;
        $plantilla->base= $request->base;
        $plantilla->nota= $request->nota;
        $plantilla->valorRetenido= $request->valorRetenido;
        $plantilla->codigoNIIIF= $request->codigoNIIIF;
        if ($request->puc_id!=1){
            $plantilla->puc_id= $request->puc_id;
        }

        $plantilla->update();
        //dd($request->totalDebito);
        $idP = $plantilla->transacciones_id;
        $trans = Transacciones::findOrFail($idP);
        if ($request->totalDebito != $temporalDebito){
            if ($temporalDebito > $request->debito)
            {
                $preTotalDebito=$request->debito-$temporalDebito;
                $totalFinalDebito=$preTotalDebito+$request->totalDebito;
                $trans->totalDebito=$totalFinalDebito;
            }else{
                $preTotalDebito=$request->debito-$temporalDebito;
                $totalFinalDebito=$request->totalDebito+$preTotalDebito;
                $trans->totalDebito=$totalFinalDebito;
            }
        }
        if ($request->totalCredito != $temporalCredito){
            if ($temporalCredito > $request->credito)
            {
                $preTotalCredito=$request->credito-$temporalCredito;
                $totalFinalCredito=$preTotalCredito+$request->totalCredito;
                $trans->totalCredito=$totalFinalCredito;
            }else{
                $preTotalCredito=$request->credito-$temporalCredito;
                $totalFinalCredito=$request->totalCredito+$preTotalCredito;
                $trans->totalCredito=$totalFinalCredito;
            }
            /*if($temporalDebito < $request->debito)
            {
                $preTotal=$temporalDebito-$request->debito;
                $trans->totalDebito=$preTotal;
            }*/
        }

        $diferencia=$trans->diferencia = $trans->totalDebito-$trans->totalCredito;
        //dd($request->all());
        $trans->update();

       if ($diferencia!=0){
            Session::flash('messageMalo', 'Verifica que tus cambios de credito o debito sea para un total de 0');
        return back();
        }else {
            Session::flash('message', 'La plantilla se edito con exito');
            return back();
        }

    }

    public function destroy($id)
    {
        $trans=Transacciones::findOrFail($id);
        $trans->delete();
        Session::flash('message', 'El registro se elimino con exito');
        return redirect()->route('transaccion.index');
    }

    public function destroyPlantilla(Request $request, $id)
    {
        //dd($request->all());
        $plantilla=PlantillaContable::findOrFail($id);
        $debito= $request->debito;
        $credito= $request->credito;
        $idP = $plantilla->transacciones_id;
        $trans = Transacciones::findOrFail($idP);
        if ($debito == null){
            $trans->totalCredito=$trans->totalCredito-$credito;
            $trans->update();
        }else{
            $trans->totalDebito = $trans->totalDebito-$debito;
            $trans->update();
        }
       // $transPlantilla=PlantillaContable::findOrFail($id);
        $plantilla->delete();
        Session::flash('message', 'El registro se elimino con exito');
        return back();
    }

    public function printTrans($id)
    {

        $trasacciones=DB::table('transacciones')
            ->leftJoin('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->leftJoin('personas_empleados', 'personas.natural_id', '=', 'personas_empleados.id')
            ->leftJoin('personas_juridicas', 'personas.juridica_id', '=', 'personas_juridicas.id')
            ->leftJoin('personas_naturales', 'personas.empleado_id', '=', 'personas_naturales.id')
            ->leftJoin('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id','transacciones.anio','transacciones.mes','transacciones.dia',
                'personas_empleados.numeroDocumento','personas_juridicas.nit','personas_naturales.numeroDocumento',
                'comprobantes.abreviatura','comprobantes.nombreSoporte','personas.nombre1','personas.nombre2',
                'personas.apellido','personas.apellido2','transacciones.detalle','transacciones.valortransaccionLetras',
                'transacciones.valortransaccion','transacciones.revelacion')
            ->where('transacciones.id','=',$id)
            ->get();

        $retenciones=DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->leftJoin('pucs', 'plantilla_contables.puc_id', '=', 'pucs.id')
            ->select('plantilla_contables.id','plantilla_contables.debito','plantilla_contables.credito',
                'transacciones.totalCredito','transacciones.totalDebito',
                'plantilla_contables.puc_id','pucs.codigoCuenta','pucs.nombreCuenta')
            ->where('transacciones.id','=',$id)
            ->get();
        //dd($retenciones);
        $totales=Transacciones::select('id','totalCredito','totalDebito')->where('id','=',$id)->get();

        $movimientoContableDos=DB::table('plantilla_contables')
            ->leftJoin('pucs', 'plantilla_contables.puc_id', '=', 'pucs.id')
            ->leftJoin('personas_juridicas', 'pucs.persona_id', '=', 'personas_juridicas.id')
            ->leftJoin('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->select('plantilla_contables.id','plantilla_contables.docReferencia','pucs.codigoCuenta',
                'personas_juridicas.nit','transacciones.totalCredito','pucs.naturalezaCuenta','pucs.nombreCuenta','pucs.numeroCuenta',
                'plantilla_contables.credito')
            //->where('plantilla_contables.codigoPUC','like','11%')
            ->where('pucs.naturalezaCuenta','=','Credito')
            ->orWhere('plantilla_contables.transacciones_id','=',$id)
            ->get();
        //dd($movimientoContableDos);
        $desRet=DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('comprobantes.id','plantilla_contables.id','plantilla_contables.valorRetenido','comprobantes.nombreSoporte','comprobantes.activarDescuentos')
            ->where('comprobantes.activarDescuentos','=','SI')
            ->where('transacciones.id','=',$id)
            ->get();
        //dd($desRet);


        $sumValorRetenido=DB::table('plantilla_contables')->where('transacciones_id','=',$id)->sum('valorRetenido');
        //dd($sumValorRetenido);


        //dd($data);
        return view('transacciones.print', compact('totales','trasacciones','retenciones','movimientoContableDos',
            'desRet','sumValorRetenido'));
       /* $pdf = PDF::loadView('transacciones.print',$data);
        return $pdf->download('transacciones.pfd');*/
    }

    public function generarPlantilla($id)
    {
        $trasacciones=Transacciones::findOrFail($id);
        $comprobante=Comprobante::all();
        $puc=Puc::all();
        $numDocs=Transacciones::select('numeroDoc','created_at')->get();
        $terceros=Persona::with('natural','juridica','empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
        $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
            ->select('id','docReferencia', 'centroCosto_id', 'debito', 'credito', 'nota')
            ->get();
        $retenciones=DB::table('retencion_descuentos','pucs','plantilla_contables')
            ->join('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            //->join('plantilla_contables', 'plantilla_contables.retencion_id', '=', 'plantilla_contables.id')
            ->select('retencion_descuentos.id','retencion_descuentos.base','retencion_descuentos.iva'
                ,'retencion_descuentos.concepto','retencion_descuentos.porcentaje','pucs.codigoCuenta')
            ->where('retencion_descuentos.RetoDes','=',null)
            ->get();
        $descuentos=DB::table('retencion_descuentos','pucs')
            ->join('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            //->join('niffs', 'niffs.puc_id', '=', 'niffs.id')
            ->select('retencion_descuentos.id','retencion_descuentos.base','retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje','pucs.codigoCuenta')
            ->where('retencion_descuentos.RetoDes','=','DESCUENTO')
            ->get();
        return view('transacciones.plantilla',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','trasacciones','plantillaRetenciones','puc'));
    }

    public function editPlantilla($id)
    {
        $trasacciones=Transacciones::findOrFail($id);
        $comprobante=Comprobante::all();
        $niif=Niff::all();
        $puc=Puc::all();
        $numDocs=Transacciones::select('numeroDoc','created_at')->get();
        $terceros=Persona::with('natural','juridica','empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
        $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
            ->select('id','docReferencia', 'centroCosto_id', 'debito', 'credito', 'nota')
            ->get();
        $retenciones=DB::table('retencion_descuentos','pucs','plantilla_contables')
            ->join('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            //->join('plantilla_contables', 'plantilla_contables.retencion_id', '=', 'plantilla_contables.id')
            ->select('retencion_descuentos.id','retencion_descuentos.base','retencion_descuentos.iva'
                ,'retencion_descuentos.concepto','retencion_descuentos.porcentaje','pucs.codigoCuenta')
            ->where('retencion_descuentos.RetoDes','=',null)
            ->get();
        $descuentos = DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id', 'retencion_descuentos.base', 'retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje', 'pucs.codigoCuenta', 'pucs.nombreCuenta', 'niffs.codigoNiff', 'niffs.puc_id',
                'retencion_descuentos.activo')
            ->where('retencion_descuentos.activo', '=', 'SI')
            ->where('retencion_descuentos.RetoDes', '=', 'DESCUENTO')
            //->orWhere('niffs.puc_id', '=', null)
            //->orWhere('niffs.puc_id', '!=', null)
            ->get();
        //dd($descuentos);
        return view('transacciones.editPlantilla',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','trasacciones','plantillaRetenciones','niif','puc'));
    }

    public function export($id)
    {
        return Excel::download(new TransaccionesExport($id), 'PLANTILLA.xlsx');
    }

    public function import(Request $request)
    {
        try {
            $request->hasFile('excel');
            $archivo = $request->file('excel');
            Excel::import(new TrasnsacciomImport, $archivo);
            Session::flash('message', 'Plantilla creadas con exito');
            return  back();
        }
            catch (\Illuminate\Database\QueryException $e) {
                Session::flash('message', 'Error al crear plantilla, prueba nuevamente');
                return back();
            }
        }
}

    public function loadNiif ($id)
    {
        return response()->json(Niff::where('puc_id', $id)->get());
    }

    public function downloadPlantilla()
    {
        $file= public_path(). "/files/TRANSACCIONES-PLANTILLA.xlsx";

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->download($file, 'TRANSACCIONES-PLANTILLA.xlsx', $headers);
    }

    public function pucLoad()
    {
        $data = Puc::select('id','codigoCuenta', 'nombreCuenta', 'tipoCuenta_id')->get();
        dd($data);
        return response()->json(Puc::all());
    }

}

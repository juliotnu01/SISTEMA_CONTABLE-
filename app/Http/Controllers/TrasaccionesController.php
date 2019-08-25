<?php

namespace App\Http\Controllers;

use App\Comprobante;
use App\Empresa;
use App\Http\Requests\TrassaccionesRequest;
use App\Imports\TrasnsacciomImport;
use App\Niff;
use App\PlantillaContable;
use App\Persona;
use App\Puc;
use App\RetencionDescuentos;
use App\TipoPresupuesto;
use App\Transacciones;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrasaccionesController extends Controller
{
    public function index()
    {
        $trasacciones=DB::table('transacciones')
            ->join('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->join('tipo_presupuestos', 'transacciones.tipoPresupuesto_id', '=', 'tipo_presupuestos.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id','transacciones.anio','transacciones.mes','transacciones.dia',
                'transacciones.numeroDoc','transacciones.valortransaccion','personas.nombre1','personas.nombre2','personas.apellido','personas.apellido2',
                'comprobantes.nombreSoporte','tipo_presupuestos.nombrePresupuesto','transacciones.valorBase')
            ->where('transacciones.plantilla','=','NO')
            ->get();

        $trasaccionesFaltan=DB::table('transacciones')
            ->select('transacciones.id','transacciones.anio','transacciones.mes','transacciones.dia',
                'transacciones.numeroDoc','transacciones.valorBase')
            ->where('transacciones.tercero_id','=',null)
            ->get();

        $trasaccionesPlantilla=DB::table('transacciones')
            ->join('personas', 'transacciones.tercero_id', '=', 'personas.id')
            ->join('tipo_presupuestos', 'transacciones.tipoPresupuesto_id', '=', 'tipo_presupuestos.id')
            ->join('comprobantes', 'transacciones.comprobante_id', '=', 'comprobantes.id')
            ->select('transacciones.id','transacciones.anio','transacciones.mes','transacciones.dia',
                'transacciones.numeroDoc','personas.nombre1','personas.nombre2','personas.apellido','personas.apellido2',
                'comprobantes.nombreSoporte','tipo_presupuestos.nombrePresupuesto','transacciones.valorBase')
            ->where('transacciones.plantilla','=','SI')
            ->get();

        $tipoPresupuesnto=TipoPresupuesto::all();
        //dd($retenciones);
        return view('transacciones.index',compact('trasacciones','trasaccionesPlantilla','trasaccionesFaltan',
            'tipoPresupuesnto'));
    }

    public function create()
    {
        $comprobante=Comprobante::select('id','abreviatura', 'nombreSoporte','activarDescuentos')
                                ->where('estado','=','SI')
                                ->get();
        $puc=Puc::all();
        $niif=Niff::all();
        $numDocs=Transacciones::select('numeroDoc','created_at')->get();
        $terceros=Persona::with('natural','juridica','empleado')->get();
        //$tipoPresupuestos = Comprobante::with('tipoPresupuesto');
        $tipoPresupuestos = TipoPresupuesto::all();
        $retenciones=DB::table('retencion_descuentos')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id','retencion_descuentos.base','retencion_descuentos.tipoRetencion','retencion_descuentos.iva'
                ,'retencion_descuentos.concepto','retencion_descuentos.porcentaje','pucs.codigoCuenta','niffs.codigoNiff')
            ->where('retencion_descuentos.RetoDes','=',null)
            ->get();
        //dd($retenciones);
        $descuentos= DB::table('retencion_descuentos','pucs')
            ->leftJoin('pucs', 'retencion_descuentos.puc_id', '=', 'pucs.id')
            ->leftJoin('niffs', 'niffs.puc_id', '=', 'pucs.id')
            ->select('retencion_descuentos.id','retencion_descuentos.base','retencion_descuentos.concepto',
                'retencion_descuentos.porcentaje','pucs.codigoCuenta','niffs.codigoNiff','niffs.puc_id')
            ->where('niffs.puc_id','=',null)
            ->orWhere('niffs.puc_id','!=',null)
            ->where('retencion_descuentos.RetoDes','=','DESCUENTO')
            ->get();
        //dd($descuentos);
        return view('transacciones.create',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','puc','niif'));
    }

    public function store(Request $request)
    {

        $trans = new Transacciones;

        $erros = \Validator::make($request->all(), [

            'numeroDoc'=>'unique:transacciones',
            'codigoPresupuesto'=>'unique:transacciones',
        ]);

        if ($erros->fails())
        {
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
        if ($request->transacciones_id){
            $plantillaContable = $request->transacciones_id;
            foreach ($plantillaContable as $key => $value) {

                $trans->plantilaContable()->create([

                    'transacciones_id' => $request->transacciones_id[$key],
                    'codigoPUC' => $request->codigoPUC[$key],
                    'docReferencia' => $request->docReferencia[$key],
                    'coNoCo' => $request->coNoCo[$key],
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
        $trans=Transacciones::findOrFail($id);
        $trasacciones=Transacciones::findOrFail($id);
        $comprobante=Comprobante::select('id','abreviatura', 'nombreSoporte','activarDescuentos')
            ->where('estado','=','SI')
            ->get();
        $puc=Puc::all();
        $niif=Niff::all();
        $numDocs=Transacciones::select('numeroDoc','created_at')->get();
        $terceros=Persona::with('natural','juridica','empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
        $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
            ->select('id','docReferencia', 'coNoCo', 'debito', 'credito', 'nota')
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
        return view('transacciones.duplicar',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','trasacciones','plantillaRetenciones','puc','niif'));
    }

    public function edit($id)
    {
        $trasacciones=Transacciones::findOrFail($id);
        $comprobante=Comprobante::select('id','abreviatura', 'nombreSoporte','activarDescuentos')
            ->where('estado','=','SI')
            ->get();
        $puc=Puc::all();
        $niif=Niff::all();
        $numDocs=Transacciones::select('numeroDoc','created_at')->get();
        $terceros=Persona::with('natural','juridica','empleado')->get();
        $tipoPresupuestos = TipoPresupuesto::all();
       /* $plantillaRetenciones=PlantillaContable::where('transacciones_id', $id)
            ->select('id','docReferencia', 'coNoCo', 'debito', 'credito', 'nota', 'codigoPUC',
                'codigoNIIIF','transacciones_id', 'transacciones_id','valorRetenido','puc_id')
            ->get();*/


        $plantillaRetenciones=DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->select('plantilla_contables.id','plantilla_contables.docReferencia', 'plantilla_contables.coNoCo',
                'plantilla_contables.debito', 'plantilla_contables.credito', 'plantilla_contables.nota',
                'plantilla_contables.codigoPUC','plantilla_contables.base', 'plantilla_contables.codigoNIIIF','plantilla_contables.transacciones_id',
                'plantilla_contables.transacciones_id','plantilla_contables.valorRetenido','plantilla_contables.retecionesDescuentos_id',
                'puc_id', 'transacciones.totalDebito','transacciones.totalCredito','transacciones.diferencia')
            ->where('plantilla_contables.transacciones_id','=',$id)
            ->get();
        //dd($plantillaRetenciones);
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
        return view('transacciones.edit',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','trasacciones','plantillaRetenciones','puc','niif'));
    }

    public function update(Request $request, $id)
    {

        $trans=Transacciones::findOrFail($id);
        //dd($request->plantilla);
        $trans->anio= $request->anio;
        $trans->mes=$request->mes;
        $trans->dia=$request->dia;
        //DEMAS CAMPOS
        $trans->numeroDoc= $request->numeroDoc;
        $trans->codigoPresupuesto= $request->codigoPresupuesto;
        $trans->valortransaccion= $request->valortransaccion;
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
                    'codigoPUC' => $request->codigoPUC[$key],
                    'docReferencia' => $request->docReferencia[$key],
                    'coNoCo' => $request->coNoCo[$key],
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
        return redirect()->route('transaccion.index');

    }

    public function updatePlantilla(Request $request, $id)
    {

        $plantilla=PlantillaContable::findOrFail($id);
        $plantilla->codigoPUC=$request->codigoPUC;
        $plantilla->docReferencia=$request->docReferencia;
        $plantilla->coNoCo= $request->coNoCo;
        $plantilla->debito= $request->debito;
        $plantilla->credito= $request->credito;
        $plantilla->base= $request->base;
        $plantilla->nota= $request->nota;
        $plantilla->valorRetenido= $request->valorRetenido;
        $plantilla->codigoNIIIF= $request->codigoNIIIF;
        $plantilla->puc_id= $request->puc_id;

        if ($request->debito>$request->totalDebito){
            $debitoT=$request->totalDebito + $request->debito;
            $creditoT=$request->totalCredito + $request->credito;
            $diferencia=$debitoT-$creditoT;
            //dd('suma' .$debitoT .' ' .$creditoT);
        }else{
            $debitoT=$request->totalDebito - $request->debito;
            $creditoT=$request->totalCredito - $request->credito;
            $diferencia=$debitoT-$creditoT;
            //dd('resta' .$debitoT .' ' .$creditoT);
        }

        $plantilla->update();
        //dd($debitoT.' '.$creditoT);
        $idP=$plantilla->transacciones_id;
        $trans=Transacciones::findOrFail($idP);
        $trans->totalDebito= $debitoT;
        $trans->totalCredito= $creditoT;
        $trans->diferencia= $diferencia;
        $trans->update();

        Session::flash('message', 'El registro se edito con exito');
        return redirect()->route('transaccion.index');

    }

    public function destroy($id)
    {
        $trans=Transacciones::findOrFail($id);
        $trans->delete();
        Session::flash('message', 'El registro se elimino con exito');
        return redirect()->route('transaccion.index');
    }

    public function destroyPlantilla($id)
    {
        $transPlantilla=PlantillaContable::findOrFail($id);
        $transPlantilla->delete();
        Session::flash('message', 'El registro se elimino con exito');
        return back();
    }

    public function printTrans($id)
    {

        $trasacciones=Transacciones::with(['terceros','comprobante' => function($p){
            $p->select('id', 'nombre1', 'nombre2', 'apellido', 'apellido2');
            $p->select('id', 'abreviatura','nombreSoporte');
        }])
            ->select('id','anio','mes','dia', 'numeroDoc', 'valortransaccion','codigoPresupuesto','valorBase', 'revelacion',
                'tercero_id', 'comprobante_id', 'tipoPresupuesto_id','plantilla','totalDebito', 'totalCredito', 'diferencia',
                'detalle')
            ->where('transacciones.id','=',$id)
            ->get();

        $retenciones=DB::table('plantilla_contables')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->leftJoin('pucs', 'plantilla_contables.puc_id', '=', 'pucs.id')
            ->select('plantilla_contables.id','plantilla_contables.debito','plantilla_contables.credito',
                'plantilla_contables.codigoPUC','transacciones.totalCredito','transacciones.totalDebito',
                'plantilla_contables.puc_id','pucs.codigoCuenta')
            ->where('transacciones.id','=',$id)
            ->get();
        //dd($retenciones);
        $totales=Transacciones::select('id','totalCredito','totalDebito')->where('id','=',$id)->get();

        $movimientoContableDos=DB::table('plantilla_contables')
            ->join('pucs', 'plantilla_contables.codigoPUC', '=', 'pucs.codigoCuenta')
            ->join('personas_juridicas', 'pucs.persona_id', '=', 'personas_juridicas.id')
            ->join('transacciones', 'plantilla_contables.transacciones_id', '=', 'transacciones.id')
            ->select('plantilla_contables.id','plantilla_contables.docReferencia','pucs.codigoCuenta',
                'personas_juridicas.nit','transacciones.totalCredito','plantilla_contables.codigoPUC','pucs.naturalezaCuenta')
            ->where('plantilla_contables.codigoPUC','like','11%')
            ->where('pucs.naturalezaCuenta','=','Credito')
            ->where('plantilla_contables.transacciones_id','=',$id)
            ->get();

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
       /* $data= [
            'trasacciones'=>$trasacciones,
            'retenciones'=>$retenciones,
            'movimientoContableDos'=>$movimientoContableDos,
            'totales'=>$totales,
            'desRet'=>$desRet,
            'sumValorRetenido'=>$sumValorRetenido,
        ];*/

        //dd($data);
        return view('transacciones.print', compact('totales','trasacciones','retenciones','movimientoContableDos','desRet','sumValorRetenido'));
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
            ->select('id','docReferencia', 'coNoCo', 'debito', 'credito', 'nota')
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
            ->select('id','docReferencia', 'coNoCo', 'debito', 'credito', 'nota')
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
        return view('transacciones.editPlantilla',compact('comprobante','retenciones',
            'tipoPresupuestos','terceros','numDocs','descuentos','trasacciones','plantillaRetenciones','niif','puc'));
    }

    public function import(Request $request)
    {
        try {
            $request->hasFile('excel');
            $archivo = $request->file('excel');
            $p = new TrasnsacciomImport;
            Excel::import($p, $archivo);

            $docRepetido = Transacciones::select('numeroDoc')
                ->where('numeroDoc' ,$p->repetidos)
                ->get();
            if (count($docRepetido) > 0) {
                Session::flash('email','Un numero de docuemnto repetido es '. $docRepetido .' por favor elimne los demas registros de
                su excel y solu suba el que se le indica');
                return redirect()->route('transaccion.create');
            }
            return  redirect()->route('puc.index')->with('message', 'Cuentas PUC Creadas Correctamente');
        }
        catch (\Illuminate\Database\QueryException $e) {
            Session::flash('message','Error, por favor vedifica tu excel o intentalo mas tarde.');
            return redirect()->route('transaccion.index');
        }

    }

    public function loadNiif ($id)
    {
        return response()->json(Niff::where('puc_id', $id)->get());
    }


}

<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Puc;
use App\RetencionDescuentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RetencionesController extends Controller
{

    public function index()
    {
        $retenciones=RetencionDescuentos::select('id','tipoRetencion','concepto', 'anio', 'base', 'montoMinimo')
                                        ->where('RetoDes','=',null)
                                        ->get();
        return view('retenciones.index',compact('retenciones'));
    }

    public function create()
    {
        $puc=Puc::all();
        $empresa=Empresa::with('retencionDescuentos')->get();
        return view('retenciones.create',compact('puc','empresa'));

    }

    public function store(Request $request)
    {
        $retenciones=RetencionDescuentos::create($request->all());
        Session::flash('message','Retencion Creada con éxito');
        return redirect()->route('retenciones.index',compact('retenciones'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $retencion=RetencionDescuentos::findOrFail($id);
        $puc=Puc::all();
        $empresa=Empresa::with('retencionDescuentos')->get();
        return view('retenciones.edit',compact('puc','empresa','retencion'));
    }

    public function update(Request $request, $id)
    {
        $retencion=RetencionDescuentos::findOrFail($id);
        //dd($request->all());
        $retencion->update($request->all());
        Session::flash('message','Retencion Editada con éxito');
        return redirect()->route('retenciones.index');
    }

    public function destroy($id)
    {
        $retencion=RetencionDescuentos::findOrFail($id);
        $retencion->delete();
        Session::flash('message','Retencion Eliminada con éxito');
        return redirect()->route('retenciones.index');
    }
}

<?php
namespace App\Http\Controllers;
use App\Cierres;
use App\ConceptosCierres;
use App\Puc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CierresController extends Controller
{
    public function index()
    {
        $cierres = Cierres::all();
        $puc=Puc::all();
        return view('cierres.index',compact('cierres','puc'));
    }
    public function create()
    {
        $cierres=Cierres::all();
        $puc=Puc::all();
        return view('cierres.create',compact('cierres','puc'));
    }
    public function store(Request $request)
    {
        $cierre =  new Cierres();
        $cierre -> anio=$request->anio;
        //dd($request->cierre_id);
        $cierre->save();
        $cierreCon = $request->cierre_id;
        foreach($cierreCon as $key => $value) {
            $cierre->cieresConcepto()->create([
                'cierre_id' => $request->cierre_id[$key],
                'nombreConcepto' => $request->nombreConcepto[$key],
                'puc_id' => $request->puc_id[$key],
            ]);
        }
        Session::flash('message','Cierres Realizado con éxito');
        return redirect()->route('cierres.index');
    }
    public function edit($id)
    {
        $cierres=Cierres::with('cieresConcepto')->findOrFail($id);
        $puc=Puc::all();
        //$conceptos=ConceptosCierres::where('cierre_id','=',$id)->get();
        $conceptos=DB::table('conceptos_cierres')
            ->join('pucs', 'conceptos_cierres.puc_id', '=', 'pucs.id')
            ->select('conceptos_cierres.id','conceptos_cierres.nombreConcepto','pucs.codigoCuenta')
            ->where('conceptos_cierres.cierre_id','=',$id)
            ->get();
        //dd($conceptos);
        return view('cierres.edit',compact('cierres','puc','conceptos'));
    }
    public function update(Request $request, $id)
    {
        $cierre=Cierres::find($id);
        $cierre -> anio=$request->anio;
        //dd($request->cierre_id);
        $cierre->update();
        $cierreCon = $request->cierre_id;
        foreach($cierreCon as $key => $value) {
            $cierre->cieresConcepto()->create([
                'cierre_id' => $request->cierre_id[$key],
                'nombreConcepto' => $request->nombreConcepto[$key],
                'puc_id' => $request->puc_id[$key],
            ]);
        }
        Session::flash('message','Cierres Editada con éxito');
        return redirect()->route('cierres.index');
    }
    public function updateConcepto(Request $request, $id)
    {
        $cierre=ConceptosCierres::findOrFail($id);
        //dd($request->all());
        $cierre->puc_id = $request->puc_id;
        Session::flash('message','Cuenta Editada con éxito');
        return back();
    }
    public function destroy($id)
    {
        //
    }
    public function destroyConcepto($id)
    {
        $cierre=ConceptosCierres::findOrFail($id);
        $cierre->delete();
        Session::flash('message', 'Concepto Eliminado con exito');
        return back();
    }
}
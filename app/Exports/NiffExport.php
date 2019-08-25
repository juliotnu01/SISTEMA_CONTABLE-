<?php

namespace App\Exports;

/*use App\Niff;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;*/


use App\Puc;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;


class NiffExport implements FromView{
    public function view(): View{
        return view('niffs.export', [
            'niffs' => DB::table('pucs')
                ->distinct()
                ->leftJoin('niffs', function($join)
                {
                    $join->on('pucs.id', '=', 'niffs.puc_id');
                })->select('pucs.id','pucs.codigoCuenta','pucs.nombreCuenta','niffs.tipoCuenta_id','niffs.naturalezaCuenta','niffs.nivel','niffs.nombreNiff','niffs.codigoNiff')
                ->get()
        ]);
    }
}

/*
class NiffExport implements FromCollection,WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'ID',
            'Codigo de Cuenta',
            'Nombre de Cuenta',
            'Nombre NIFF',
            'Codigo CGC NIFF',
        ];
    }

    public function collection()
    {

        return DB::table('pucs')
            ->distinct()
            ->leftJoin('niffs', function($join)
            {
                $join->on('pucs.id', '=', 'niffs.puc_id');
            })->select('pucs.id','pucs.codigoCuenta','pucs.nombreCuenta','niffs.nombreNiff','niffs.codigoNiff')
//            ->where('niffs.nombreNiff', '=','')
//            ->orwhere('niffs.codigoNiff', '=','')
            ->get();


        //dd($results->toArray());


    }
}*/

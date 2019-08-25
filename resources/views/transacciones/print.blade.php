<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>COTA_XL</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700');
        body
        {
            font-family: 'Montserrat', sans-serif;
            font-size: 10pt;
            background-color: #F1F1F1;
            margin: 0;
            padding: 0.8rem !important;
            color: #929497;
        }
        table{
            padding: 0;
            margin: 0;
            width: 100%;
            border-radius: 4px;
        }
        span{
            font-weight: normal;
            color: #000000;
        }
        .hr{
            border: none;
            height: 1px;
            background-color: #E9E9E9;
        }
        .w80{
            margin: auto;
            width: 97%;
            padding: 0;
        }
        .all{
            height: 97%;
            border: 1px solid #E9E9E9;
            background: #ffffff;
        }
        .text-center{
            text-align: center;
        }
        .logo{
            width: 200px;
        }
        .bill-table{
            border-collapse: collapse;
            width: 168%;
            margin-left: -78%;
            padding: 0;
        }
        .bill-table td{
            padding-bottom: 0.8rem;
            padding-top: 0.8rem;
            padding-left: 1.8rem;
        }
        .bill-title{
            letter-spacing: 10.4pt;
            font-size: 12pt;
        }
        .noPadding td{
            border-top: 1px solid #ffffff;
            padding-left:  0;
        }
        .fz11{
            margin: 0;
            padding: 0;
            font-size: 11pt;
        }
        .clientDates{
            font-weight: 300;
            padding-right: 1rem;
            line-height: 1.5rem;
        }
        .normal{
            font-weight: 400;
        }
        .bg-blue td{
            padding: 1rem !important;
            background-color: #F2F8F9 ;
            vertical-align: middle;
        }
        .info-products{
            margin-top: 0.5rem;
            padding: 1rem;
            background-color: #F2F8F9;
            border-radius: 4px;
        }
        .days-container{
            vertical-align: top;
        }
        .precio-day-container,
        .precio-total-container, .precio-transporte-container, .precio-totalGen-container{
            padding: 1rem 0 1rem 0;
            vertical-align: top;
        }
        .table-details-days{
            color: #000000;
            padding: 0.5rem 0 0.5rem 0;
        }
        .table-details-days td span{
            color: #BB0034;
        }
        .more-detail-container a{
            color: #27AAE1;
            text-decoration: none;
        }
        .totals tr td{
            padding: 0.3rem;
        }
        .number span{
            color: #BB0034;
        }
        @page {
            margin: 0;
        }
        .logocontainer{
            width: 60%;
        }
        .text-center{
            text-align: center !important;
        }
        .bill-table td{
            margin-left: 0;
            text-align: center !important;
            width: 100% !important;
        }
        .imagenMaquina{
            width: auto;
            background-image: url("../../../public/images/1557418629Seven-Deadly-Sins-Portada-750x450.jpg");
            max-height: 105.4px;
            border-radius: 4px;
        }
    </style>
</head>
<body onload="imprimir()">
<div class="all">
    <table>
        <tr>
            @foreach($trasacciones as $item)
                <td class="logocontainer">
                    <div class="">
                        <?php $imageneEmpresa= \Illuminate\Support\Facades\DB::table('empresas')->select('logo_plandesarrollo')->first(); ?>
                        {{--{{dd($imageneEmpresa)}}--}}
                        <img src="{{asset('images/'.$imageneEmpresa->logo_plandesarrollo)}}" class="img-circle" style="margin-left: 51px;width: 21%;" alt="">
                    </div>
                </td>
                <td>
                    <table class="bill-table text-center">
                        <tr>
                            <td  class=""><h1>{{$item->comprobante->nombreSoporte}}</h1></td>
                        </tr>
                        <tr class="noPadding">
                            <td  class="text-center" colspan="2">
                                <h3>{{$item->comprobante->abreviatura .''.$item->comprobante->id }}</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            @endforeach
        </tr>
    </table>
    <table class="fz11 clientDates" style="width: 95%; margin: auto;">
        <tr>
            <td>
                <table style="width: auto;">
                    @foreach($trasacciones as $item)
                        <tr>
                            <td>fecha: </td>
                            <td> <span>{{$item->anio .'/'.$item->mes.'/'.$item->dia}}</span> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>A favor de:</td>
                            <td> <span>{{$item->terceros->nombre1}}</span> </td>
                            {{--<td> <span>{{$trasacciones->nombre1 .' '. $trasacciones->nombre2 .' '. $trasacciones->apellido .' '. $trasacciones->apellido2 }}</span> </td>--}}
                        </tr>
                        <tr>
                            <td>Concepto:</td>
                            <td> <span>{{$item->detalle }}</span> </td>
                        </tr>
                        <tr>
                            <td>Por Valor de:</td>
                            <td> <span>{{$item->valortransaccion }}</span> </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
    <hr class="w80  hr">
    <table class="fz11 clientDates" style="width: 95%; margin: auto;">
        <tr>
            <td  class="normal"><h3>MOVIMIENTO CONTABLE</h3></td>
        </tr>
    </table>
    <table class="collapse text-center" style="width: 95%; margin: auto;">
        <thead>
        <tr class="bg-blue">
            <th style="border: outset; color: #000;">Código y Cuenta P.G.C.P</th>
            <th style="border: outset; color: #000;">Debito</th>
            <th style="border: outset; color: #000;">Credito</th>
        </tr>
        </thead>
        <tbody>
        @foreach($retenciones as $item)
            <tr  class="info-products">
                @if ($item->puc_id)
                    <td> <span>{{$item->codigoCuenta}}</span> </td>
                @else
                    <td> <span>{{$item->codigoPUC}}</span> </td>
                @endif
                <td class="precio-day-container pt-0.5"><span>{{$item->debito}}</span></td>
                <td class="precio-total-container"><span>{{$item->credito}} </span></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        @foreach($totales as $item)
            <tr>
                <td> <span>Sumas Totales</span> </td>
                <td class="precio-total-container"><span>{{$item->totalDebito}} </span></td>
                <td class="precio-day-container pt-0.5"><span>{{$item->totalCredito}}</span></td>
            </tr>
        @endforeach
        </tfoot>
    </table>
    <table class="fz11 clientDates" style="width: 95%; margin: auto;">
        <tr>
            <td  class="normal"><h3>OBSERVACIONES</h3></td>
        </tr>
        @foreach($trasacciones as $item)
            <tr class="info-products">
                <td  class="normal">{{$item->revelacion}}</td>
            </tr>
        @endforeach
    </table>
    <hr>

    <table class="text-center collapse">
        <tr class="">
            <td  style="border: outset; color: #000;"><b>Bancos</b></td>
            <td  style="border: outset; color: #000;"><b>No. de Cuenta</b></td>
            <td  style="border: outset; color: #000;"><b>Cheque</b></td>
            <td  style="border: outset; color: #000;"><b>Valor</b></td>
        </tr>
        <tbody>
        @foreach($movimientoContableDos as $item)
            <tr class="info-products">
                <td class="precio-day-container pt-0.5"><span>{{$item->nit}}</span></td>
                <td class="precio-day-container pt-0.5"><span>{{$item->numeroCuenta}}</span></td>
                <td class="precio-total-container"><span>{{$item->docReferencia}} </span></td>
                <td class="precio-total-container"><span>{{$item->totalCredito}} </span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="fz11 clientDates" style="width: 95%; margin: auto;">
        <tr>
            <td  class="normal"><h3>DESCUENTOS, DEDUCCIONES, RETENCIONES PRO IMPUESTOS, TASAS Y CONTRIBUCIONES</h3></td>
        </tr>
    </table>
    <table class="fz11 clientDates" style="width: 100%; margin: auto;">
        <tr>
            <td>
                <table >
                    @foreach($desRet as $item)
                        <tr class="info-products">
                            <td class="precio-day-container pt-0.5"> <span>Descuento </span> {{$item->id}} </td>
                            <td class="precio-day-container pt-0.5">{{$item->nombreSoporte }}</td>
                            <td class="precio-day-container pt-0.5"> <span class="valorRetenido">{{$item->valorRetenido}}</span> </td>
                        </tr>
                    @endforeach
                    <td class="precio-day-container "></td>
                    <td class="precio-day-container "><span>Total desctos, deducc/ y retenciones</span></td>
                    <td class="precio-day-container pt-0.5"> <span class="valorRetenidoTotal" >{{$sumValorRetenido}}</span> </td>
                </table>
            </td>
        </tr>
    </table>
    <hr>
    <table class="text-center collapse">
        <tr class="">
            <td  style="border: outset; color: #000;"><b>Preparo</b></td>
            <td  style="border: outset; color: #000;"><b>Revisó</b></td>
            <td  style="border: outset; color: #000;"><b>Aprobó</b></td>
            <td  style="border: outset; color: #000;"><b>Beneficiario</b></td>
        </tr>
        <tbody>
        <tr class="info-products">
            <td class="precio-day-container" style="height: 50px;"></td>
            <td class="precio-day-container" style="height: 50px;"></td>
            <td class="precio-day-container" style="height: 50px;"></td>
            <td class="precio-day-container" style="height: 50px;"></td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="info-products">
            <td class="precio-day-container"></td>
            <td class="precio-day-container"></td>
            <td class="precio-day-container"><span style="margin-left:30px">CC/NIT</span></td>
            <td class="precio-day-container"></td>
        </tr>
        </tfoot>
    </table>
</div>

<script !src="">
    function imprimir() {
        confirm("Desea imprimir este reporte?");
        var contenido= document.getElementsByClassName('all');
        window.print();

    }
</script>

</body>
</html>
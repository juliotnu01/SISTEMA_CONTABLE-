@extends('layouts.plantillaBase')
@section('contenido')
<div class="row"  id="">
    <div class="col-md-12">
        <div class="card shadow mb-4">

            @if (Session::has('email'))
                <div class="alert alert-danger">{{ Session::get('email') }}</div>
            @endif
        </div>
    </div>
</div>
<div class="row"  id="">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card shadow mb-4" id="datosBasicos" >
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Crear Transacción</h6>
                    </div>
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif
                    &nbsp
                    <div class="container">
                        @if ($errors->any())
                            <div class="alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes31" id="enero">ENERO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mesBisiesto" id="febrero">FEBRERO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes31" id="marzo">MARZO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes30" id="abril">ABRIL</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes30" id="mayo">MAYO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes31" id="junio">JUNIO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes30" id="julio">JULIO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes31" id="agosto">AGOS</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes31" id="septiembre">SEPTI</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block mes30" id="octubre">OCTUB</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm mes31" id="noviembre">NOVIE</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm mes30" id="diciembre">DICIEM</button>
                            </div>
                        </div>
                    </div>
                    <form class="user"  action="{{route('transaccion.store')}}" method="post" id="puc"  name="puc">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <label for="">Definir como plantilla</label>
                                    <label class="radio-inline">
                                        <input type="radio"  id="plantilla"  name="plantilla"  value="SI" {{ old('plantilla')=="SI" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                    <label class="radio-inline">
                                        <input type="radio" id="plantilla" checked="checked" name="plantilla" value="NO" {{ old('plantilla')=="NO" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                </div>
                            </div>
                            &nbsp
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Año</label>
                                    <input type="text"  class="form-control form-control-user"  id="anio" name="anio" value="{{old('anio')}}" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">Mes</label>
                                    <input type="text"  class="form-control form-control-user" readonly="readonly" id="mes" name="mes" value="{{old('mes')}}" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">Día</label>
                                    <select  name= "dia" id="dia" class="select2 form-control custom-select" >
                                        <option value="" >[Seleccione una dia]</option>
                                       
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Comprobantes</label>
                                    <select  onchange="tipoPresupuesto()" name= "comprobante_id" id="comprobante_id" class="select2 form-control custom-select" >
                                        <option value="" >[Seleccione una Opción]</option>
                                        @foreach($comprobante as $item)
                                            <option value="{{$item->id}}" {{ old('comprobante_id') == $item->id ? 'selected' : '' }} >{{$item->nombreSoporte}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Tercero</label>
                                    <select  name="tercero_id" id="tercero_id" class="select2 form-control custom-select" >
                                        <option value="">[Seleccione una Opción]</option>
                                        @foreach($terceros as $item)
                                            <option value="{{$item->id}}" {{ old('tercero_id') == $item->id ? 'selected' : '' }} >{{$item->nombre1}} - {{$item->natural()->pluck('numeroDocumento')->implode(' / ')}} {{$item->empleado()->pluck('numeroDocumento')->implode(' / ')}} {{$item->juridica()->pluck('nit')->implode(' / ')}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Tipo de Presupuestos</label>
                                    <select  name="tipoPresupuesto_id" id="tipoPresupuesto_id" class=" form-control custom-select" >
                                        <option value="" >[Seleccione una Opción]</option>
                                        @foreach($tipoPresupuestos as $item)
                                            <option value="{{$item->id}}" {{ old('tipoPresupuesto_id') == $item->id ? 'selected' : '' }} >{{$item->tipoPresupuesto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">No Documento</label>
                                    @foreach($ultimoNumeroDoc as $item)
                                        <input type="text" id="numeroDoc" class="form-control form-control-user" name="numeroDoc"  value="{{$item->numeroDoc+1}}">
                                    @endforeach
                                    @if ($errors->has('numeroDoc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numeroDoc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <button type="button" style="margin-top: 40px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        Número de documentos previos
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipo de Pago</label>
                                    <select  name="tipoPago" id="tipoPago" class="select2 form-control custom-select" >
                                        <option value="" >[Seleccione una Opción]</option>
                                        <option value="Para Nómina" {{ old('tipoPago') }} > Para Nómina</option>
                                        <option value="Contribuciones Inherentes a la Nómina" {{ old('tipoPago') }} > Contribuciones Inherentes a la Nómina</option>
                                        <option value="Prestaciones Sociales" {{ old('tipoPago') }} > Prestaciones Sociales</option>
                                        <option value="Viáticos y Gastos de Transporte" {{ old('tipoPago') }} > Viáticos y Gastos de Transporte</option>
                                        <option value="Serviciode la Deuda " {{ old('tipoPago') }} > Servicio de la Deuda</option>
                                        <option value="Contratos de Prestación de Servicios"  {{ old('tipoPago') }} > Contratos de Prestación de Servicios</option>
                                        <option value="Consultorías"  {{ old('tipoPago') }} > Consultorías</option>
                                        <option value="Mantenimiento y/o Reparación"  {{ old('tipoPago') }} > Mantenimiento y/o Reparación</option>
                                        <option value="Obra Pública"  {{ old('tipoPago') }} > Obra Pública</option>
                                        <option value="Compra Ventas y/o Suministro"  {{ old('tipoPago') }} > Compra Ventas y/o Suministro</option>
                                        <option value="Concesión"  {{ old('tipoPago') }} > Concesión</option>
                                        <option value="Comodatos"  {{ old('tipoPago') }} > Comodatos</option>
                                        <option value="Arrendamientos"  {{ old('tipoPago') }} > Arrendamientos</option>
                                        <option value="Seguros"  {{ old('tipoPago') }} > Seguros</option>
                                        <option value="Convenios" {{ old('tipoPago') }} > Convenios</option>
                                        <option value="Emprestitos" {{ old('tipoPago') }} > Emprestitos</option>
                                        <option value="Otros" {{ old('tipoPago') }} > Otros.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Detalle</label>
                                    <textarea name="detalle" id="revelacion" class="form-control form-control-user" cols="1"  rows="1" style="resize: none;">{{old('detalle')}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Revelaciones</label>
                                    <textarea name="revelacion" id="revelacion" class="form-control form-control-user" cols="1"  rows="1" style="resize: none;">{{old('codigoPresupuesto')}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Código de Presupuesto</label>
                                    <input type="text"  class="form-control form-control-user"  id="codigoPresupuesto" value="{{old('codigoPresupuesto')}}" name="codigoPresupuesto"  placeholder="Codigo  Presupuesto...">
                                    @if ($errors->has('codigoPresupuesto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('codigoPresupuesto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="">Valor de transacción</label>
                                    <input type="text"  class="form-control form-control-user"  onkeyup="format(this)" onchange="format(this)" id="valortransaccion" value="{{old('valortransaccion')}}" name="valortransaccion"  placeholder="valor de transaccion...">
                                    <input type="hidden"  class="form-control form-control-user"  id="valortransaccionLetras" value="{{old('valortransaccionLetras')}}" name="valortransaccionLetras">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Valor Base</label>
                                    <input type="text"  class="form-control form-control-user" onkeyup="format(this)" onchange="format(this)" onblur="obtenerBase()" id="valorBase" value="{{old('valorBase')}}" name="valorBase"  placeholder="Valor Base...">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" disabled="disabled" style="margin-top: 40px;" class="btn btn-primary botonesDesRet" data-toggle="modal" data-target="#Revelaciones">
                                        Retenciones
                                    </button>
                                    <button type="button" disabled="disabled" style="margin-top: 40px;" class="btn btn-primary botonesDesRet" data-toggle="modal" data-target="#Descuentos">
                                        Descuentos
                                    </button>
                                </div>
                            </div>
                            <br>
                            <h2>Plantilla Contable</h2>
                            <button style="margin-top: -43px;float: right;" type="button" class="btn btn-primary agregarPlanBasico" id="agregarPlan"><i class="fa fa-plus"></i></button>
                            <div class="row"  id="numeroDocumentos">
                                <div class="col-md-12" style="overflow:scroll;
                                     height: 330px;">
                                    <table id="TablaPro" class="table">
                                        <thead>
                                        <tr>
                                            <th>CODIGO GUIA</th>
                                            <th>CODIGO</th>
                                            <th>DOC REF</th>
                                            <th>CENTRO DE COSTO</th>
                                            <th>DEBITO</th>
                                            <th>CREDITO</th>
                                            <th>BASE</th>
                                            <th>NIIF</th>
                                            <th>NOTA</th>
                                        </tr>
                                        </thead>
                                        <tbody id="ProSelected">
                                        </tbody>
                                        <tfoot>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Sumas Iguales:</b></td>
                                        <td><input readonly="readonly" type="text" style="width:150px;" class="form-control form-control-user" name="totalDebito" id="totalDebito"></td>
                                        <td><input readonly="readonly" type="text" style="width:150px;" class="form-control form-control-user" name="totalCredito" id="totalCredito"></td>
                                        <td><input readonly="readonly" type="text" style="width:150px;" class="form-control form-control-user" name="diferencia" id="direfencia"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block enviar" disabled="disabled" type="submit">AGREGAR</button>
                        </div>
                        &nbsp
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Números de documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Número</th>
                        <th>Fecha de Creación</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Número</th>
                        <th>Fecha de Creación</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($numDocs as $item )
                        <tr>
                            <td>{{$item->numeroDoc}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Revelaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 245%;!important;margin-left: -300px;!important;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retenciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table tablaRetencion" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tipo de Retencion</th>
                        <th>Concepto</th>
                        <th>Base</th>
                        <th>IVA</th>
                        <th>% de Retencion</th>
                        <th>Vr.Retenido</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="bodyt">
                    @foreach($retenciones as $item)
                        <tr id="tds">
                            <td class="tdss">{{$item->tipoRetencion}}</td>
                            <td class="tds"><input class="concepto " type="text" disabled="disabled" name="concepto" id="concepto" value="{{$item->concepto}}"/></td>
                            <td class="tds"><input  style="width: 143px; " class="base baseFinal"  type="number" name="base" id="base"/></td>
                            <td class="tds"><input type="number" disabled="disabled" name="iva" id="iva" value="{{$item->iva}}"/></td>
                            <td class="tds"><input type="number" name="porcentaje" id="porcentaje" class="porcentaje" value="{{$item->porcentaje}}"/></td>
                            <td class="tdss"><input  style="width: 143px;" disabled="disabled" type="text" class="valorRetenido valorR" name="valorRetenido"  id="valorRetenido"></td>
                            <input type="hidden" class="retecionesDescuentos_id"   value="{{$item->id}}"/>
                            <input  type="hidden" name="codigoCuenta" id="codigoCuenta" class="codigoCuenta" value="{{$item->codigoCuenta}} - {{$item->nombreCuenta}}"/>
                            <input  type="hidden" name="codigoNiff" id="codigoNiff" class="codigoNiff" value="{{$item->codigoNiff}}"/>
                            <td>
                                <button class="btn btn-primary agregarPlan" id="agregarPlan"><i class="fa fa-save"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Descuentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 125%;!important;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Descuentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>% Dcto</th>
                        {{--<th>IVA</th>
                        <th>Base</th>--}}
                        <th>Vr.Retenido</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($descuentos as $itemDescuento )
                        <tr>
                            <td class="nameConcept">{{$itemDescuento->concepto}}</td>
                            <td><input  style="width: 40px;" type="text" class="porcentaje" value="{{$itemDescuento->porcentaje}}"></td>
                            <td><input  style="width: 143px;"  type="text" class="valorRetenido" name="valorRetenido"  id="valorRetenido"></td>
                            <input type="hidden" class="retecionesDescuentos_id"   value="{{$itemDescuento->id}}"/>
                            <input  type="hidden" name="codigoCuenta" id="codigoCuenta" class="codigoCuenta" value="{{$itemDescuento->codigoCuenta}} - {{$itemDescuento->nombreCuenta}}"/>
                            <input  type="hidden" name="codigoNiff" id="codigoNiff" class="codigoNiff" value="{{$itemDescuento->codigoNiff}}"/><td>
                            <input type="hidden" class="retecionesDescuentos_id" value="{{$itemDescuento->id}}"/>
                            <td>
                                <button class="btn btn-primary agregarPlan" id="agregarPlan"><i class="fa fa-save"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script>

    document.getElementById("valortransaccion").addEventListener("keyup",function(e){
        document.getElementById("valortransaccionLetras").value=NumeroALetras(this.value);
    });

    function Unidades(num){
        switch(num)
        {
            case 1: return "UN";

            case 2: return "DOS";

            case 3: return "TRES";

            case 4: return "CUATRO";

            case 5: return "CINCO";

            case 6: return "SEIS";

            case 7: return "SIETE";

            case 8: return "OCHO";

            case 9: return "NUEVE";

        }
        return "";

    }

    function Decenas(num){

        decena = Math.floor(num/10);

        unidad = num - (decena * 10);
        
        switch(decena)
        {
            case 1:
                switch(unidad)
                {
                    case 0: return "DIEZ";

                    case 1: return "ONCE";

                    case 2: return "DOCE";

                    case 3: return "TRECE";

                    case 4: return "CATORCE";

                    case 5: return "QUINCE";

                    default: return "DIECI" + Unidades(unidad);
                }
                
            case 2:
                switch(unidad)
                {
                    case 0: return "VEINTE";
                    default: return "VEINTI" + Unidades(unidad);
                }

            case 3: return DecenasY("TREINTA", unidad);

            case 4: return DecenasY("CUARENTA", unidad);

            case 5: return DecenasY("CINCUENTA", unidad);

            case 6: return DecenasY("SESENTA", unidad);

            case 7: return DecenasY("SETENTA", unidad);

            case 8: return DecenasY("OCHENTA", unidad);

            case 9: return DecenasY("NOVENTA", unidad);

            case 0: return Unidades(unidad);
        }
    }//Unidades()

    function DecenasY(strSin, numUnidades){
        if (numUnidades > 0)

            return strSin + " Y " + Unidades(numUnidades)
        return strSin;
    }//DecenasY()

    function Centenas(num){

        centenas = Math.floor(num / 100);

        decenas = num - (centenas * 100);

        switch(centenas)
        {
            case 1:

                if (decenas > 0)

                    return "CIENTO " + Decenas(decenas);

                return "CIEN";

            case 2: return "DOSCIENTOS " + Decenas(decenas);

            case 3: return "TRESCIENTOS " + Decenas(decenas);

            case 4: return "CUATROCIENTOS " + Decenas(decenas);

            case 5: return "QUINIENTOS " + Decenas(decenas);

            case 6: return "SEISCIENTOS " + Decenas(decenas);

            case 7: return "SETECIENTOS " + Decenas(decenas);

            case 8: return "OCHOCIENTOS " + Decenas(decenas);

            case 9: return "NOVECIENTOS " + Decenas(decenas);

        }

        return Decenas(decenas);

    }//Centenas()

    function Seccion(num, divisor, strSingular, strPlural){

        cientos = Math.floor(num / divisor)

        resto = num - (cientos * divisor)

        letras = "";

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + " " + strPlural;
            else
                letras = strSingular;

        if (resto > 0)

            letras += "";

        return letras;
    }//Seccion()

    function Miles(num){

        divisor = 1000;

        cientos = Math.floor(num / divisor)

        resto = num - (cientos * divisor)

        strMiles = Seccion(num, divisor, "MIL", "MIL");

        strCentenas = Centenas(resto);

        if(strMiles == "")

            return strCentenas;

        return strMiles + " " + strCentenas;

        //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);

    }//Miles()

    function Millones(num){

        divisor = 1000000;

        cientos = Math.floor(num / divisor)

        resto = num - (cientos * divisor)

        strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");

        strMiles = Miles(resto);

        if(strMillones == "")

            return strMiles;

        return strMillones + " " + strMiles;

    }//Millones()

    function NumeroALetras(num,pesos){

        var data = {

            numero: num,

            enteros: Math.floor(num),

            pesos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),

            letraspesos: "",

        };

        if(pesos == undefined || pesos==false) {

            data.letrasMonedaPlural="PESOS";

            data.letrasMonedaSingular="PESOS";

        }else{

            data.letrasMonedaPlural="PESOS";

            data.letrasMonedaSingular="PESOS";

        }

        if (data.pesos > 0)

            data.letraspesos = "CON " + NumeroALetras(data.pesos,true);

        if(data.enteros == 0)

            return "CERO " + data.letrasMonedaPlural + " " + data.letraspesos;

        if (data.enteros == 1)

            return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letraspesos;

        else

            return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letraspesos;

    }//NumeroALetras()
</script>
<script>
    function sum(){
        let total = 0;
        $('.debitos').each(function() {
            let value = parseFloat($(this).val());
            if (!isNaN(value)) {
                total += value;
            }
        });
        $('#totalDebito').val(total);
    }
    function sumC(){
        let totalC = 0;
        $('.credito').each(function() {
            let value = parseFloat($(this).val());
            console.log('credito '+value);
            if (!isNaN(value)) {
                totalC += value;
            }
        });
        $('#totalCredito').val(totalC);
    }
    function resta() {
        var debito = $('#totalDebito').val();
        var credito= $('#totalCredito').val();
        var direfencia= debito-credito;
        $('#direfencia').val(direfencia);
        var dif=$('#direfencia').val();
        if (dif!=0){
            $('.enviar').prop("disabled", true)
        }else{
            $('.enviar').prop("disabled", false)
        }
    }

    $('.botonesDesRet').click(function(){
            var base = $(this).parents("tr").find("#base").val();
            var porcentaje = $(this).parents("tr").find("#porcentaje").val();
            var total = parseFloat(base * porcentaje) / 100;
            $(this).parents("tr").find(".valorR").val(total.toFixed(2));
    });
    $('.mesBisiesto').click(function () {
        var anio=$('#anio').val();
        if (((anio % 4 == 0) && (anio % 100 != 0 )) || (anio % 400 == 0)){
            $('#dia').empty();
            $('#dia').append('<option value="1" >1</option>' +
                '<option value="2" >2</option>'+
                '<option value="3" >3</option>'+
                '<option value="4" >4</option>'+
                '<option value="5" >5</option>'+
                '<option value="6" >6</option>'+
                '<option value="7" >7</option>'+
                '<option value="8" >8</option>'+
                '<option value="9" >9</option>'+
                '<option value="10" >10</option>'+
                '<option value="11" >11</option>'+
                '<option value="12" >12</option>'+
                '<option value="13" >13</option>'+
                '<option value="14" >14</option>'+
                '<option value="15" >15</option>'+
                '<option value="16" >16</option>'+
                '<option value="17" >17</option>'+
                '<option value="18" >18</option>'+
                '<option value="19" >19</option>'+
                '<option value="20" >20</option>'+
                '<option value="21" >21</option>'+
                '<option value="22" >22</option>'+
                '<option value="23" >23</option>'+
                '<option value="24" >24</option>'+
                '<option value="25" >25</option>'+
                '<option value="26" >26</option>'+
                '<option value="27" >27</option>'+
                '<option value="28" >28</option>'+
                '<option value="29" >29</option>')
        }else{
            $('#dia').empty();
            $('#dia').append('<option value="1" >1</option>' +
                '<option value="2" >2</option>'+
                '<option value="3" >3</option>'+
                '<option value="4" >4</option>'+
                '<option value="5" >5</option>'+
                '<option value="6" >6</option>'+
                '<option value="7" >7</option>'+
                '<option value="8" >8</option>'+
                '<option value="9" >9</option>'+
                '<option value="10" >10</option>'+
                '<option value="11" >11</option>'+
                '<option value="12" >12</option>'+
                '<option value="13" >13</option>'+
                '<option value="14" >14</option>'+
                '<option value="15" >15</option>'+
                '<option value="16" >16</option>'+
                '<option value="17" >17</option>'+
                '<option value="18" >18</option>'+
                '<option value="19" >19</option>'+
                '<option value="20" >20</option>'+
                '<option value="21" >21</option>'+
                '<option value="22" >22</option>'+
                '<option value="23" >23</option>'+
                '<option value="24" >24</option>'+
                '<option value="25" >25</option>'+
                '<option value="26" >26</option>'+
                '<option value="27" >27</option>'+
                '<option value="28" >28</option>')
        }
    })
    $('.mes30').click(function(){
        $('#dia').empty();
        $('#dia').append('<option value="1" >1</option>' +
            '<option value="2" >2</option>'+
            '<option value="3" >3</option>'+
            '<option value="4" >4</option>'+
            '<option value="5" >5</option>'+
            '<option value="6" >6</option>'+
            '<option value="7" >7</option>'+
            '<option value="8" >8</option>'+
            '<option value="9" >9</option>'+
            '<option value="10" >10</option>'+
            '<option value="11" >11</option>'+
            '<option value="12" >12</option>'+
            '<option value="13" >13</option>'+
            '<option value="14" >14</option>'+
            '<option value="15" >15</option>'+
            '<option value="16" >16</option>'+
            '<option value="17" >17</option>'+
            '<option value="18" >18</option>'+
            '<option value="19" >19</option>'+
            '<option value="20" >20</option>'+
            '<option value="21" >21</option>'+
            '<option value="22" >22</option>'+
            '<option value="23" >23</option>'+
            '<option value="24" >24</option>'+
            '<option value="25" >25</option>'+
            '<option value="26" >26</option>'+
            '<option value="27" >27</option>'+
            '<option value="28" >28</option>'+
            '<option value="29" >29</option>'+
            '<option value="30" >30</option>'+
            '<option value="31" >31</option>');
    })
    $('.mes31').click(function(){
        $('#dia').empty();
        $('#dia').append('<option value="1" >1</option>' +
            '<option value="2" >2</option>'+
            '<option value="3" >3</option>'+
            '<option value="4" >4</option>'+
            '<option value="5" >5</option>'+
            '<option value="6" >6</option>'+
            '<option value="7" >7</option>'+
            '<option value="8" >8</option>'+
            '<option value="9" >9</option>'+
            '<option value="10" >10</option>'+
            '<option value="11" >11</option>'+
            '<option value="12" >12</option>'+
            '<option value="13" >13</option>'+
            '<option value="14" >14</option>'+
            '<option value="15" >15</option>'+
            '<option value="16" >16</option>'+
            '<option value="17" >17</option>'+
            '<option value="18" >18</option>'+
            '<option value="19" >19</option>'+
            '<option value="20" >20</option>'+
            '<option value="21" >21</option>'+
            '<option value="22" >22</option>'+
            '<option value="23" >23</option>'+
            '<option value="24" >24</option>'+
            '<option value="25" >25</option>'+
            '<option value="26" >26</option>'+
            '<option value="27" >27</option>'+
            '<option value="28" >28</option>'+
            '<option value="29" >29</option>'+
            '<option value="30" >30</option>');
    })
    $('.agregarPlan').click(function(){
        var base=  $(this).parents("tr").find("#base").val();
        var porcentaje  =  $(this).parents("tr").find("#porcentaje").val();
        //var base= $('.baseFinal').val();
        //var porcentaje  =  $('.porcentaje').val();
        console.log(porcentaje);
        var total=parseFloat(base*porcentaje)/100;
        $(this).parents("tr").find(".valorR").val(total.toFixed(2));
    });

    $(document).ready(function() {
        $(document).on('change keyup','.base',function(){
            var tr= $(this).parent().parent();//primer parent td segundo tr
            var porcentaje=($(tr).find('#porcentaje').val());
            var base=($(tr).find('#base').val());
            if(isNaN(porcentaje)){
                porcentaje=0;
            }
            if(isNaN(base)){
                base=0;
            }
            var total=parseFloat(porcentaje*base)/100;
            $(tr).find('#valorRetenido').val(total.toFixed(2));
        });

        $(document).on('change keyup','.porcentaje',function(){
            var tr= $(this).parent().parent();//primer parent td segundo tr
            var porcentaje=($(tr).find('#porcentaje').val());
            var base=($(tr).find('#base').val());
            if(isNaN(porcentaje)){
                porcentaje=0;
            }
            if(isNaN(base)){
                base=0;
            }
            var total=parseFloat(porcentaje*base)/100;
            $(tr).find('#valorRetenido').val(total.toFixed(2));
        });

        $('.agregarPlan').click(function(){
            var codigoPUC =  $(this).parent().parent().find('.codigoCuenta').val();
            var base =  $(this).parent().parent().find('.baseFinal').val();
            var retenido =  $(this).parent().parent().find('.valorRetenido').val();
            var codigoNiff =  $(this).parent().parent().find('.codigoNiff').val();
            var sel2 = $(this).parent().parent().find('.retecionesDescuentos_id').val();
            //alert(codigoPUC)
            //var debito =  $(this).parent().parent().find('.baseFinal').val();
            $('.debitos').keyup(function(){
                let inps = $('.debitos');
                let disabled = false;
                let totalDebito=0;
                for(i = 0; i < inps.length; i++) {
                    let valor=$(this).val();
                    totalDebito += valor;
                    inp = inps[i].value;
                    if(inp > 0){
                        disabled = true;
                    }
                }
                // Habilitar y deshabilitar el input
                if(disabled == true){
                    $(this).parent().parent().find('.credito').css('display','none');
                    $(this).css('display','block')
                }
                else{
                    $(this).parent().parent().find('.credito').css('display','block');
                    $(this).css('display','none')
                }
                sum();
                resta();
            });
            $('.credito').keyup(function(){
                let inps = $('.credito');
                let disabled = false;
                for(i = 0; i < inps.length; i++) {
                    inp = inps[i].value;
                    if(inp > 0){
                        disabled = true;
                    }
                }
                // Habilitar y deshabilitar el boton #send
                if(disabled == true){
                    $(this).parent().parent().find('.debitos').css('display','none');
                    $(this).css('display','block')
                }
                else{
                    $(this).parent().parent().find('.debitos').css('display','block');
                    $(this).css('display','none')
                }
                sumC();
                resta();
            });
            $.ajax({
                type: 'GET',
                url: '/puc/loadPuc',
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    data.forEach(element=>{
                        $('.puc_idD').append($('<option>',{class:'pucs', value: element.id, text:element.codigoCuenta+'-'+ element.nombreCuenta}))
                    });
                },error:function(){
                    console.log(data);
                }
            });
            //console.log($("#puc_id").val())
            $(document).change(function(){
                var id= $("#puc_id").val()
                $.ajax({
                    type: 'GET',
                    url: '/puc/loadPucPrueba/'+id,
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(element=>{
                            if (element.tipoCuenta_id===1){
                                alert('esta cuenta es tipo Superior, por favor selecciona otra')
                            }
                        });
                        //console.log(data);
                    },error:function(){
                        console.log(data);
                    }
                });
                //console.log($("#puc_id").val())
            });
            $('#ProSelected').append('<tr class="active">'+
                '<input type="hidden" name="transacciones_id[]" />'+
                '<input type="hidden" name="retecionesDescuentos_id[]"  data-id="'+sel2+'" />'+
                '<input type="hidden"  class="form-control" style="width:100px;" name="valorRetenido[]" id="valorRetenido" value="'+retenido+'" />'+
                '<td><span>'+codigoPUC+'</span> </td>'+
                '<td>' +
                '<select style="width: 28pc;" onchange="niif()" name="puc_id[]" id="puc_id" class="selectPuc puc_idD select2 form-control custom-select puc_id">'+
                '</select>'+
                '<td><input  type="text" class="form-control" style="width:100px;" name="docReferencia[]" id="docReferencia"/></td>'+
                '<td> <select style="width:8pc;" name="centroCosto_id[]" id="centroCosto_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">'+
                '<option value="1">[Seleccione un Opcion]</option>'+
                '    @foreach($centroCosto as $item)'+
                '<option value="{{$item->id}}" {{ old('centroCosto_id') == $item->id ? 'selected' : '' }} >{{$item->codigoCC}}-{{$item->NombreCC}}</option>'+
                '    @endforeach'+
                '</select></td>' +
                '<td ><input style="display: none" type="text" class="form-control debitos" style="width:100px;" name="debito[]" id="debito"/></td>'+
                '<td><input  type="text"  class="form-control credito" style="width:100px;" name="credito[]" id="credito" value="'+retenido+'"/></td>'+
                '<td><input  type="number" class="form-control" style="width:100px;" name="base[]" id="base"  value="'+base+'"/></td>'+
                '<td><input  type="number" class="form-control" style="width:100px;" name="codigoNIIIF[]" id="codigoNIIIF"  value="'+codigoNiff+'"/></td>' +
                '<td><input  type="text" class="form-control" style="width:100px;" name="nota[]" id="nota"/></td>'+
                '<td><button type="button" class="btn btn-link btn-danger remove borrar"><i class="fa fa-times"></i></button></td>'+
                '</tr>');
            $(function () {
                $(document).on('click', '.borrar', function (event) {
                    var debito =  $(this).parent().parent().find('.debitos').val();
                    var credito =  $(this).parent().parent().find('.credito').val();
                    var totalDebito =$('#totalDebito').val();
                    var totalCredito =$(this).parent().parent().find('#totalCredito').val();
                    var direfencia =$(this).parent().parent().find('#direfencia').val();
                    var restaDebito=debito-totalDebito;
                    var restaCredito=debito-totalCredito;
                    $('#totalDebito').val(restaDebito);
                    $('#totalCredito').val(restaCredito);
                    event.preventDefault();
                    $(this).closest('tr').remove();
                });
            });
            $('.selectPuc').select2({
            });
        });
        $('.agregarPlanBasico').click(function () {
            var codigoPUC =  $(this).parent().parent().find('.codigoCuenta').val();
            var base =  $(this).parent().parent().find('.baseFinal').val();
            var retenido =  $(this).parent().parent().find('.valorRetenido').val();
            var codigoNiff =  $(this).parent().parent().find('.codigoNiff').val();
            var sel2 = $(this).parent().parent().find('.retecionesDescuentos_id').val();
            var sel3 = $(this).parent().parent().find('.transacciones_id').val();
            //alert(sel2)
            $.ajax({
                type: 'GET',
                url: '/puc/loadPuc',
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    data.forEach(element=>{
                        $('.puc_idD').append($('<option>',{class:'pucs', value: element.id, text:element.codigoCuenta+'-'+ element.nombreCuenta}))
                    });
                },error:function(){
                    console.log(data);
                }
            });
            //console.log($("#puc_id").val())
            $(document).change(function(){
                var id= $("#puc_id").val()
                $.ajax({
                    type: 'GET',
                    url: '/puc/loadPucPrueba/'+id,
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(element=>{
                            if (element.tipoCuenta_id===1){
                                alert('esta cuenta es tipo Superior, por favor selecciona otra')
                            }
                        });
                        //console.log(data);
                    },error:function(){
                        console.log(data);
                    }
                });
                //console.log($("#puc_id").val())
            });
            $('#ProSelected').append('<tr class="active">'+
                '<input type="hidden" name="transacciones_id[]" data-id="'+sel3+'" />' +
                '<input type="hidden" name="retecionesDescuentos_id[]"  data-id="'+sel2+'" />'+
                '<td><span></span> </td>'+
                '<td>' +
                '<select style="width: 28pc;" onchange="niif()" name="puc_id[]" id="puc_id" class="selectPuc puc_idD select2 form-control custom-select puc_id">'+
                '</select>'+
                '</td>'+
                '<td><input  type="text" class="form-control " style="width:100px;" name="docReferencia[]" id="docReferencia"/></td>' +
                '<td> ' +
                '<select style="width:8pc;" name="centroCosto_id[]" id="centroCosto_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">'+
                '<option value="1">[Seleccione un Opcion]</option>'+
                '    @foreach($centroCosto as $item)'+
                '<option value="{{$item->id}}" {{ old('centroCosto_id') == $item->id ? 'selected' : '' }} >{{$item->codigoCC}}-{{$item->NombreCC}}</option>'+
                '    @endforeach'+
                '</select></td>' +
                '<input  type="hidden" class="form-control " style="width:100px;" name="codigoPUC[]" id="codigoPUC"/>' +
                '<td><input  type="text" class="form-control debitos" style="width:100px;"  name="debito[]" id="debito"/></td>' +
                '<td><input  type="text"  class="form-control credito" style="width:100px;"  name="credito[]" id="credito"/></td>' +
                '<td><input  type="number" class="form-control" style="width:100px;" name="base[]" id="base"/></td>' +
                '<td><select style="width:100px;" name= "codigoNIIIF[]" id="codigoNIIIF" class="codigoNIIIFD select2 form-control custom-select" >' +
                '   @foreach($niif as $item)'+
                '       <option value="{{$item->codigoNIIIF}}" {{ old('codigoNIIIF') == $item->codigoNIIIF ? 'selected' : '' }} >{{$item->codigoNiff}}</option>'+
                '   @endforeach'+
                '</select>'+
                '</td>' +
                '<td><input  type="text" class="form-control" style="width:100px;" name="nota[]" id="nota"/></td>'+
                '<td style="display: none"><input  type="number"  class="form-control" style="width:100px;" name="valorRetenido[]" id="valorRetenido"/></td>' +
                '<td><button type="button" class="btn btn-link btn-danger remove borrar"><i class="fa fa-times"></i></button></td>'+
                '</tr>');
            $('.selectPuc').select2({
            });
            $(function () {
                $(".puc_id").change(function () {
                    var nFilas = $("#TablaPro tr").length;
                    if (nFilas < 4 ){
                        $('.enviar').prop("disabled", true)
                    }else{
                        $('.enviar').prop("disabled", false)
                    }

                });
            });
            $('.debitos').keyup(function(){
                let inps = $('.debitos');
                let disabled = false;
                let totalDebito=0;
                for(i = 0; i < inps.length; i++) {
                    let valor=$(this).val();
                    totalDebito += valor;
                    inp = inps[i].value;
                    if(inp > 0){
                        disabled = true;
                    }
                }
                // Habilitar y deshabilitar el input
                if(disabled == true){
                    $(this).parent().parent().find('.credito').css('display','none');
                    $(this).css('display','block')
                }
                else{
                    $(this).parent().parent().find('.credito').css('display','block');
                    $(this).css('display','none')
                }
                sum();
                resta();
            });
            $('.credito').keyup(function(){
                let inps = $('.credito');
                let disabled = false;
                for(i = 0; i < inps.length; i++) {
                    inp = inps[i].value;
                    if(inp > 0){
                        disabled = true;
                    }
                }
                // Habilitar y deshabilitar el boton #send
                if(disabled == true){
                    $(this).parent().parent().find('.debitos').css('display','none');
                    $(this).css('display','block')
                }
                else{
                    $(this).parent().parent().find('.debitos').css('display','block');
                    $(this).css('display','none')
                }
                sumC();
                resta();
            });
        });
        $(function () {
            $(document).on('click', '.borrar', function (event) {
                var nFilas = $("#TablaPro tr").length-1;
                if (nFilas < 4 ){
                    $('.enviar').prop("disabled", true)
                }else{
                    $('.enviar').prop("disabled", false)
                }
                event.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    });
</script>
<script>
    function obtenerBase() {
        var valorBase = $('#valorBase').val();
        //console.log(valorBase)
        $('.baseFinal').val(valorBase)
    }
    $(document).ready(function() {
        $('.select2').select2();

    });
</script>
<script>
    function format(input)
    {
        var num = input.value.replace(/\./g,'');
        if(!isNaN(num)){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            input.value = num;
        }

    }
        $(function() {
            $( "#puc" ).validate({
                rules: {
                    anio:{
                        required: true,
                    },
                    mes:{
                        required: true,
                    },
                    dia:{
                        required: true,
                    },
                    tercero_id:{
                        required: true,
                    },
                    comprobante_id:{
                        required: true,
                    },
                    tipoPresupuesto_id:{
                        required: true,
                    },
                    numeroDoc:{
                        required: true,
                    },
                    tipoPago:{
                        required: true,
                    },
                    detalle:{
                        required: true,
                    },
                    codigoPresupuesto:{
                        required:true,
                        digits:true,
                    },
                    valortransaccion:{
                        required:true,
                        //digits:true,
                    },
                    valorBase:{
                        required:true,
                        //digits:true,
                    }
                },
                messages: {
                    anio:{
                        required: "Este campo es Obligatorio",
                    },
                    tipoPago:{
                        required: "Este campo es Obligatorio",
                    },
                    mes:{
                        required: "Este campo es Obligatorio",
                    },
                    dia:{
                        required: "Este campo es Obligatorio",
                    },
                    tercero_id:{
                        required: "Este campo es Obligatorio",
                    },
                    codigoPresupuesto:{
                        digits: "Este campo solo recive digitos",
                        required: "Este campo es Obligatorio",
                    },
                    numeroDoc:{
                        required: "Este campo es Obligatorio",
                    },
                    comprobante_id:{
                        required: "Este campo es Obligatorio",
                    },
                    tipoPresupuesto_id:{
                        required: "Este campo es Obligatorio",
                    },
                    valortransaccion:{
                        required: "Este campo es Obligatorio",
                        //digits: "Este campo solo recive digitos",
                    },
                    valorBase:{
                        required: "Este campo es Obligatorio",
                        //digits: "Este campo solo recive digitos",
                    },
                    detalle: {
                        required: "Este campo es Obligatorio",
                    }
                }
            });
        });
        $('#enero').on("click", function(){
            $('#mes').val("Enero");
        });
        $('#febrero').on("click", function(){
            $('#mes').val("Febrero");
        });
        $('#marzo').on("click", function(){
            $('#mes').val("Marzo");
        });
        $('#abril').on("click", function(){
            $('#mes').val("Abril");
        });
        $('#mayo').on("click", function(){
            $('#mes').val("Mayo");
        });
        $('#junio').on("click", function(){
            $('#mes').val("Junio");
        });
        $('#julio').on("click", function(){
            $('#mes').val("Julio");
        });
        $('#agosto').on("click", function(){
            $('#mes').val("Agosto");
        });
        $('#septiembre').on("click", function(){
            $('#mes').val("Septiembre");
        });
        $('#octubre').on("click", function(){
            $('#mes').val("Octubre");
        });
        $('#noviembre').on("click", function(){
            $('#mes').val("Noviembre");
        });
        $('#diciembre').on("click", function(){
            $('#mes').val("Diciembre");
        });
    </script>
@endsection

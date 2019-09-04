@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
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
                                <button class="btn btn-primary btn-sm btn-block" id="enero">ENERO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="febrero">FEBRERO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="marzo">MARZO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="abril">ABRIL</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="mayo">MAYO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="junio">JUNIO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="julio">JULIO</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="agosto">AGOS</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="septiembre">SEPTI</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm btn-block" id="octubre">OCTUB</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm" id="noviembre">NOVIE</button>
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <button class="btn btn-primary btn-sm" id="diciembre">DICIEM</button>
                            </div>
                        </div>
                    </div>
                    <form class="user"  action="{{route('transaccion.store',$trasacciones->id)}}" method="post" id="puc"  name="puc">
                        {{csrf_field()}}
                        <div class="card-body">
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Año</label>
                                    <input type="text"  class="form-control form-control-user"  id="anio" name="anio" value="{{$trasacciones->anio}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Mes</label>
                                    <input type="text"  class="form-control form-control-user" id="mes" name="mes" value="{{$trasacciones->mes}}">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Día</label>
                                    <select  name= "dia" id="dia" class="select2 form-control custom-select" >
                                            <option {{ old('dia', $trasacciones->dia) == $trasacciones->dia ? 'selected' : '' }} value="{{$trasacciones->dia}}">{{$trasacciones->dia}}</option>
                                            <option value="1" {{ old('dia') }}>1</option>
                                            <option value="2" {{ old('dia') }}>2</option>
                                            <option value="3" {{ old('dia') }}>3</option>
                                            <option value="4" {{ old('dia') }}>4</option>
                                            <option value="5" {{ old('dia') }}>5</option>
                                            <option value="6" {{ old('dia') }}>6</option>
                                            <option value="7" {{ old('dia') }}>7</option>
                                            <option value="8" {{ old('dia') }}>8</option>
                                            <option value="9" {{ old('dia') }}>9</option>
                                            <option value="10" {{ old('dia') }}>10</option>
                                            <option value="11" {{ old('dia') }}>11</option>
                                            <option value="12" {{ old('dia') }}>12</option>
                                            <option value="13" {{ old('dia') }}>13</option>
                                            <option value="14" {{ old('dia') }}>14</option>
                                            <option value="15" {{ old('dia') }}>15</option>
                                            <option value="16" {{ old('dia') }}>16</option>
                                            <option value="17" {{ old('dia') }}>17</option>
                                            <option value="18" {{ old('dia') }}>18</option>
                                            <option value="19" {{ old('dia') }}>19</option>
                                            <option value="20" {{ old('dia') }}>20</option>
                                            <option value="21" {{ old('dia') }}>21</option>
                                            <option value="22" {{ old('dia') }}>22</option>
                                            <option value="23" {{ old('dia') }}>23</option>
                                            <option value="24" {{ old('dia') }}>24</option>
                                            <option value="25" {{ old('dia') }}>25</option>
                                            <option value="26" {{ old('dia') }}>26</option>
                                            <option value="27" {{ old('dia') }}>27</option>
                                            <option value="28" {{ old('dia') }}>28</option>
                                            <option value="29" {{ old('dia') }}>29</option>
                                            <option value="30" {{ old('dia') }}>30</option>
                                            <option value="31" {{ old('dia') }}>31</option>
                                        </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Comprobantes</label>
                                    <select  onchange="tipoPresupuesto()" name= "comprobante_id" id="comprobante_id" class="select2 form-control custom-select" >
                                        <option value="" >[Seleccione una Opción]</option>
                                        @foreach($comprobante as $item)
                                            <option {{ old('comprobante_id', $trasacciones->comprobante_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombreSoporte}}</option>
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
                                            <option {{ old('tercero_id', $trasacciones->tercero_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombre1}} - {{$item->natural()->pluck('numeroDocumento')->implode(' / ')}} {{$item->empleado()->pluck('numeroDocumento')->implode(' / ')}} {{$item->juridica()->pluck('nit')->implode(' / ')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipo de Presupuestos</label>
                                    <select  name="tipoPresupuesto_id" id="tipoPresupuesto_id" class=" form-control custom-select" >
                                        @foreach($tipoPresupuestos as $item)
                                             <option {{ old('tipoPresupuesto_id', $trasacciones->tipoPresupuesto_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombrePresupuesto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">No Documento</label>
                                    <input type="text"  id="numeroDoc" class="form-control form-control-user" name="numeroDoc"  value="{{ old('numeroDoc'). $trasacciones->numeroDoc }}">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" style="margin-top: 40px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        Número de documentos previos
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tipo de Pago</label>
                                    <select  name= "tipoPago" id="tipoPago" class="select2 form-control custom-select" >
                                        <option {{ old('tipoPago', $trasacciones->tipoPago) == $trasacciones->tipoPago ? 'selected' : '[Seleccione una Opción]' }} value="{{$trasacciones->tipoPago}}">{{$trasacciones->tipoPago}}</option>
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
                                    <label for="">Revelaciones</label>
                                    <textarea name="revelacion" id="revelacion" class="form-control form-control-user" cols="1"  rows="1" style="resize: none;">{{$trasacciones->revelacion}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Detalle</label>
                                    <textarea name="detalle" id="detalle" class="form-control form-control-user" cols="1"  rows="1" style="resize: none;">{{$trasacciones->detalle}}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Código de Presupuesto</label>
                                    <input type="text"  class="form-control form-control-user"  value="{{$trasacciones->codigoPresupuesto}}" id="codigoPresupuesto" name="codigoPresupuesto"  placeholder="Codigo  Presupuesto...">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Valor de transacción</label>
                                    <input type="text"  class="form-control form-control-user"  value="{{$trasacciones->valortransaccion}}" id="valortransaccion" name="valortransaccion"  placeholder="valor de transaccion...">
                                    <input type="hidden"  class="form-control form-control-user"  id="valortransaccionLetras" value="{{old('valortransaccionLetras')}}" name="valortransaccionLetras">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Valor Base</label>
                                    <input type="text"  class="form-control form-control-user"  value="{{$trasacciones->valorBase}}" id="valorBase" name="valorBase"  placeholder="Valor Base...">
                                    <input type="hidden"  class="form-control form-control-user"  value="{{$trasacciones->plantilla}}" id="plantilla" name="plantilla" >
                                </div>
                                <div class="col-md-3">
                                    <button type="button" style="margin-top: 40px;" class="btn btn-primary " data-toggle="modal" data-target="#Revelaciones">
                                        Retenciones
                                    </button>
                                    <button type="button" style="margin-top: 40px;" class="btn btn-primary " data-toggle="modal" data-target="#Descuentos">
                                        Descuentos
                                    </button>
                                </div>
                            </div>
                            &nbsp
                            <h2>Plantilla Contable</h2>
                            <button style="margin-top: -43px;float: right;" type="button"  class="btn btn-primary agregarPlanBasico" id="agregarPlan"><i class="fa fa-plus"></i></button>
                            <div class="row"  id="numeroDocumentos"readonly="readonly" >
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
                            <button class="btn btn-primary btn-user btn-block enviar" type="submit">EDITAR</button>
                        </div>
                        &nbsp
                </form>
                </div>
                <div class="row ">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                Plantilla Contable
                            </div>
                            <div class="card-body" style="overflow:scroll;
                                         height:330px;">
                                <table id="TablaPro" class="table">
                                    <thead>
                                    <tr>
                                        <th>DOC REF</th>
                                        <th>CENTRO DE COSTO</th>
                                        <th>DEBITO</th>
                                        <th>CREDITO</th>
                                        <th>BASE</th>
                                        <th>NOTA</th>
                                    </tr>
                                    </thead>
                                    @foreach($plantillaRetenciones as $item)
                                        <tbody>
                                        <form class="user"  action="{{route('transaccion.updatePlantilla',$item->id)}}" method="post" id="puc"  name="puc">
                                            {{csrf_field()}}
                                            {{ method_field('put') }}
                                            <input  type="hidden" style="width: 124px;"  value="{{$item->totalDebito}}" name="totalDebito">
                                            <input  type="hidden" style="width: 124px;"  value="{{$item->totalCredito}}" name="totalCredito">
                                            <input  type="hidden" style="width: 124px;"  value="{{$item->diferencia}}" name="diferencia">
                                            <input  type="hidden" style="width: 124px;"  value="{{$item->codigoPUC}}" name="codigoPUC">
                                            <input  type="hidden" style="width: 124px;"  value="{{$item->puc_id}}" name="puc_id">
                                            <input  type="hidden" value="{{$item->retecionesDescuentos_id}}" name="retecionesDescuentos_id">
                                            <input  type="hidden" value="{{$item->transacciones_id}}" name="transacciones_id">
                                            <input  type="hidden" value="{{$item->valorRetenido}}" name="valorRetenido">
                                            <td><input  style="width: 124px;" type="text" value="{{$item->docReferencia}}" name="docReferencia"></td>
                                            <td>
                                                <select style="width:124px;" name="centroCosto_id" id="centroCosto_id" class="select2 form-control custom-select" >
                                                    <option value="">[Seleccione una opcion]</option>

                                                    @foreach($centroCosto as $centro)
                                                        <option {{ old('tipoDocumento_id', $item->centroCosto_id) == $centro->id ? 'selected' : '' }} value="{{$centro->id}}">{{$centro->codigoCC}} - {{$centro->NombreCC}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input  style="width: 124px;" type="text" value="{{$item->debito}}" name="debito"></td>
                                            <td><input  style="width: 124px;" type="text" value="{{$item->credito}}" name="credito"></td>
                                            <td><input  style="width: 124px;" type="text" value="{{$item->base}}" name="base"></td>
                                            <td><input  style="width: 124px;" type="text" value="{{$item->nota}}" name="nota"></td>
                                            <td>
                                                <button type="submit" class="btn btn-circle btn-sm btn-warning" ><i class="fa fa-edit"></i></button>
                                            </td>
                                        </form>
                                        <td>
                                            <form method="POST" id="deleteTipoDoc" action="{{route('transaccion.destroyPlantilla',$item->id)}}">
                                                {{method_field('DELETE')}}
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-circle btn-sm btn-danger" ><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--  <div class="col-md-8">
                          @can('transaccion.destroy')
                              <form method="POST" id="deleteTipoDoc"
                                    action="{{route('transaccion.destroy',$trasacciones->id)}}">
                                  {{method_field('DELETE')}}
                                  {{csrf_field()}}
                                  <button type="submit" class="btn btn-danger btn-block">ELIMINAR</button>
                              </form>
                          @endcan
                      </div>--}}
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
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
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
                        <tbody>
                        @foreach($retenciones as $item)
                            <tr>
                                <td>{{$item->tipoRetencion}}</td>
                                <td><input class="concepto " type="text" disabled="disabled" name="concepto" id="concepto" value="{{$item->concepto}}"/></td>
                                <td><input  style="width: 143px; " class="base baseFinal"  type="number" name="base"  id="base" value="{{$item->base}}"/></td>
                                <td><input type="number" disabled="disabled" name="iva" id="iva" value="{{$item->iva}}"/></td>
                                <td><input type="number" name="porcentaje" id="porcentaje" class="base" value="{{$item->porcentaje}}"/></td>
                                <td><input  style="width: 143px;" disabled="disabled" type="text" class="valorRetenido" name="valorRetenido" id="valorRetenido"></td>
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
                                <td><input  style="width: 80px;"  type="text" class="valorRetenido"></td>
                                <input  type="hidden" class="base baseFinal" name="base"  id="base" value="{{$itemDescuento->base}}"/>
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

    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
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
            console.log(dif);
            if (dif!=0){
                $('.enviar').prop("disabled", true)
            }else{
                $('.enviar').prop("disabled", false)
            }

        }
        var productsId = [];
        $(document).ready(function() {
            $(document).on('change keyup','.base',function(){
                var tr= $(this).parent().parent();//primer parent td segundo tr
                var porcentaje=($(tr).find('#porcentaje').val());
                var base=($(tr).find('#base').val());
                console.log(porcentaje,base);
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

                $('#ProSelected').append('<tr class="active">'+
                    '<input type="hidden" name="transacciones_id[]" />'+
                    '<input type="hidden" name="retecionesDescuentos_id[]"  data-id="'+sel2+'" />'+
                    '<input type="hidden" name="puc_id[]"/>'+
                    '<td><input style="width: 28pc;" type="text" class="form-control" style="width:100px;" name="codigoPUC[]" id="codigoPUC"  value="'+codigoPUC+'" /></td>'+
                    '<td><input  type="text" class="form-control" style="width:100px;" name="docReferencia[]" id="docReferencia"/></td>'+
                    '<td> <select style="width:20pc;" name="centroCosto_id[]" id="centroCosto_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">'+
                    '<option value="999">[Seleccione un Opcion]</option>'+
                    '    @foreach($centroCosto as $item)'+
                    '<option value="{{$item->id}}" {{ old('centroCosto_id') == $item->id ? 'selected' : '' }} >{{$item->codigoCC}}-{{$item->NombreCC}}</option>'+
                    '    @endforeach'+
                    '</select></td>' +
                    '<td><input  type="number" class="form-control debitos" style="width:100px;" name="debito[]" id="debito"/></td>'+
                    '<td><input  type="number"  class="form-control credito" style="width:100px;" name="credito[]" id="credito"/></td>'+
                    '<td><input  type="text" class="form-control" style="width:100px;" name="base[]" id="base"  value="'+base+'"/></td>'+
                    '<td><input  type="text" class="form-control" style="width:100px;" name="codigoNIIIF[]" id="codigoNIIIF"  value="'+codigoNiff+'"/></td>' +
                    '<td><input  type="text" class="form-control" style="width:100px;" name="nota[]" id="nota"/></td>'+
                    '<td style="display: none"><input  type="number"  class="form-control" style="width:100px;" name="valorRetenido[]" id="valorRetenido" value="'+retenido+'" /></td>' +
                    '<td><button type="button" class="btn btn-link btn-danger remove borrar"><i class="fa fa-times"></i></button></td>'+
                    '</tr>');

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
                        console.log(data);
                        data.forEach(element=>{
                            $('.puc_idD').append($('<option>',{id:element.puc, value: element.id, text:element.codigoCuenta+'-'+ element.nombreCuenta}))
                        });

                    },error:function(){
                        console.log(data);
                    }
                });
                $('#ProSelected').append('<tr class="active">'+
                    '<input type="hidden" name="transacciones_id[]" data-id="'+sel3+'" />' +
                    '<input type="hidden" name="retecionesDescuentos_id[]"  data-id="'+sel2+'" />'+
                    '<td>' +
                    '<select onchange="niif()" style="width: 28pc;" name="puc_id[]" id="puc_id" class="selectPuc puc_idD form-control custom-select puc_id">'+
                    '</select></td>'+
                    '<td><input  type="text" class="form-control " style="width:100px;" name="docReferencia[]" id="docReferencia"/></td>' +
                    '<td> <select style="width:20pc;" name="centroCosto_id[]" id="centroCosto_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">'+
                    '<option value="999">[Seleccione un Opcion]</option>'+
                    '    @foreach($centroCosto as $item)'+
                    '<option value="{{$item->id}}" {{ old('centroCosto_id') == $item->id ? 'selected' : '' }} >{{$item->codigoCC}}-{{$item->NombreCC}}</option>'+
                    '    @endforeach'+
                    '</select></td>' +
                    '<input  type="hidden" class="form-control " style="width:100px;" name="codigoPUC[]" id="codigoPUC"/>' +
                    '<td><input  type="number" class="form-control debitos" style="width:100px;" name="debito[]" id="debito"/></td>' +
                    '<td><input  type="number"  class="form-control credito" style="width:100px;" name="credito[]" id="credito"/></td>' +
                    '<td><input  type="text" class="form-control" style="width:100px;" name="base[]" id="base"/></td>' +
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
                    event.preventDefault();

                    $(this).closest('tr').remove();
                });
            });

            $( "#puc_id" ).change(function() {
                var tipoCuenta=  $('select[name="puc_id"] option:selected').text();
                var cadena=tipoCuenta.indexOf('DETALLE')
                if (cadena == -1){
                    alert('Esta cuenta es de tipo Superior, no puede ser elejida');
                    $('.btnEnviar').attr('disabled',true)
                }else {
                    $('.btnEnviar').attr('disabled',false)
                }
                //console.log(tipoCuenta);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

        });
    </script>
    <script>
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
                        digits:true,
                        maxlength:2,
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
                    detalle:{
                        required: true,
                    },
                    codigoPresupuesto:{
                        required:true,
                        digits:true,
                    },
                    valortransaccion:{
                        required:true,
                        digits:true,
                    },
                    valorBase:{
                        required:true,
                        digits:true,
                    }
                },
                messages: {
                    anio:{
                        required: "Este campo es Obligatorio",
                    },
                    mes:{
                        required: "Este campo es Obligatorio",
                    },
                    dia:{
                        digits: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 2 digitos"
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
                        digits: "Este campo solo recive digitos",
                    },
                    valorBase:{
                        required: "Este campo es Obligatorio",
                        digits: "Este campo solo recive digitos",
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

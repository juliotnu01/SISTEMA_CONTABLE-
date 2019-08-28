@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @if (Session::has('message'))
                        <div class="alert alert-warning">{{ Session::get('message') }}</div>
                    @endif
                    <div class="card-body">
                        <form class="user"  action="{{route('subSede.update',$subsede->id)}}" method="post" id="terceros" name="terceros">
                            {{ method_field('put') }}
                            {{csrf_field()}}
                            <div class="card shadow mb-4" id="datosBasicos" >
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">SUB SEDE / Centro de Costo</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Sede</label>
                                            <select  name= "sede_id" id="sede_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                                <option value="">[Seleccione una Sede]</option>
                                                @foreach($sede as $item)
                                                    <option {{ old('sede_id', $subsede->sede_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->NombreCC}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    &nbsp
                                    <div class="row"  id="tipoDocumentos">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="codigoCC">Código del Centro de Costo</label>
                                                <input type="text"  class="form-control form-control-user" value="{{old('codigoCC'). $subsede->codigoCC}}" id="codigoCC" name="codigoCC"  placeholder="codigo CC...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Nombre Grupo el Centro de Costo</label>
                                            <input type="text"  class="form-control form-control-user" value="{{old('nombreGrupoCC'). $subsede->nombreGrupoCC}}" id="nombreGrupoCC" name="nombreGrupoCC"  placeholder="Nombre Grupo CC...">
                                        </div>
                                    </div>
                                    &nbsp
                                    <div class="row"  id="nombre1s">
                                        <div class="col-md-6">
                                            <label for="NombreCC">Nombre del Centro de Costo</label>
                                            <input type="text"  class="form-control form-control-user" value="{{old('NombreCC'). $subsede->NombreCC}}" id="NombreCC" name="NombreCC"  placeholder="Nombre CC...">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="NombreCorto">Nombre Corto del Centro de Costo</label>
                                            <input type="text"  class="form-control form-control-user" value="{{old('NombreCorto'). $subsede->NombreCorto}}" id="NombreCorto" name="NombreCorto"  placeholder="Nombre Corto CC...">
                                        </div>
                                    </div>
                                    &nbsp
                                    <div class="row" >
                                        <div class="col-md-6">
                                            <label for="">Tercero Responsable</label>
                                            <select  name= "tercero_id" id="tercero_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                                <option value="">[Seleccione un Tercero]</option>
                                                @foreach($personas as $item)
                                                    <option {{ old('tercero_id', $subsede->tercero_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombre1}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Aprobar Cuentas</label>
                                            <select  name= "puc_id" id="puc_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                                <option value="">[Seleccione una Cuenta]</option>
                                                @foreach($puc as $item)
                                                    {{ $style = $item->tipoCuenta_id == 1 ? '' :  'disabled="disabled"' }}
                                                    <option   {{ $style }} {{old('puc_id', $subsede->puc_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">
                                                        {{$item->codigoCuenta}} - {{$item->nombreCuenta}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    &nbsp
                                    <div class="row"  id="id_clases">
                                        <div class="col-md-6">
                                            <label for="">Vigencia Inicio</label>
                                            <input type="date"  class="form-control form-control-user" value="{{old('vigenciaInicio'). $subsede->vigenciaInicio}}" id="vigenciaInicio" name="vigenciaInicio"  placeholder="Nombre Grupo CC...">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Vigencia Final</label>
                                            <input type="date"  class="form-control form-control-user" value="{{old('vigenciaFin'). $subsede->vigenciaFin}}" id="vigenciaFin" name="vigenciaFin"  placeholder="Nombre Grupo CC...">
                                        </div>
                                    </div>
                                    <input type="hidden" value="BASICO" name="claseCC" id="claseCC">
                                    &nbsp
                                    <div class="row" id="departamento_ids">
                                        <div class="col-md-6">
                                            <label for="">Prorrateo</label>
                                            <input type="text" maxlength="3" min="0" max="100" title="El limite de este campo esta entre 1 a 100" class="form-control form-control-user" value="{{old('prorrateo'). $subsede->prorrateo}}" id="prorrateo" name="prorrateo"  placeholder="Prorrateo...">
                                        </div>
                                    </div>
                                    &nbsp
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                                &nbsp
                            </div>
                        </form>
                        @can('subSede.destroy')
                        <form method="POST" id="deleteTipoDoc"
                              action="{{route('subSede.destroy',$subsede->id)}}">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger btnEnviar" style="width: 20%;margin-left: 80%;">ELIMINAR</button>
                        </form>
                            @endcan
                    </div>
            </div>
        </div>
    </div>
@endsection
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script !src="">
    $(document).ready(function() {
        var disabledResults = $(".select2");
        disabledResults.select2();
    });
</script>
<script !src="">
    $(function() {
        $.validator.addMethod('decimal', function(value, element) {
            return this.optional(element) || /^((\d+(\\.\d{2,2})?)|((\d*(\.\d{2,2}))))$/.test(value);
        }, "Este campo solo recive 2 decimales 0.00");
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
        $( "#terceros" ).validate({
            rules: {
                sede_id: {
                    required: true,
                },
                codigoCC: {
                    digits: true,
                },
                prorrateo: {
                    decimal: true,
                },
                tercero_id:{
                    required: true,
                },
                puc_id:{
                    required: true,
                }

            },
            messages: {
                sede_id: {
                    required: "Este campo es Obligatorio",
                },
                codigoCC: {
                    digits: "Este campo solo recive numeros",
                },
                tercero_id:{
                    required: "Este campo es obligatorio",

                },
                puc_id:{
                    required: "Este campo es obligatorio",

                }

            }
        });

    });
</script>
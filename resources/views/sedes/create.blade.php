@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('sede.store')}}" method="post" id="terceros" name="terceros">
                        {{csrf_field()}}
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">SEDES / Centro de Costo</h6>
                        </div>
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
                        </div>
                        <div class="row"  id="tipoDocumentos">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigoCC">Código del Centro de Costo</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('codigoCC')}}" id="codigoCC" name="codigoCC"  placeholder="codigo CC...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre Grupo el Centro de Costo</label>
                                <input type="text"  class="form-control form-control-user" value="{{old('nombreGrupoCC')}}" id="nombreGrupoCC" name="nombreGrupoCC"  placeholder="Nombre Grupo CC...">
                            </div>
                        </div>
                        &nbsp
                        <div class="row"  id="nombre1s">
                            <div class="col-md-6">
                                <label for="NombreCC">Nombre del Centro de Costo</label>
                                <input type="text"  class="form-control form-control-user" value="{{old('NombreCC')}}" id="NombreCC" name="NombreCC"  placeholder="Nombre CC...">
                            </div>
                            <div class="col-md-6">
                                <label for="NombreCorto">Nombre Corto del Centro de Costo</label>
                                <input type="text"  class="form-control form-control-user" value="{{old('NombreCorto')}}" id="NombreCorto" name="NombreCorto"  placeholder="Nombre Corto CC...">
                            </div>
                        </div>
                        &nbsp
                        <div class="row" >
                            <div class="col-md-6">
                                <label for="">Tercero Responsable</label>
                                <select  name= "tercero_id" id="tercero_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                    <option value="">[Seleccione un Tercero]</option>
                                    @foreach($personas as $item)
                                        <option value="{{$item->id}}" {{ old('tercero_id') == $item->id ? 'selected' : '' }} >{{$item->nombre1}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Aprobar Cuentas</label>
                                <select  name= "puc_id" id="puc_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                    <option value="">[Seleccione una Cuenta]</option>
                                    @foreach($puc as $item)
                                        {{ $style = $item->tipoCuenta_id == 1 ? '' :  'disabled="disabled"' }}
                                        <option   {{ $style }} value="{{$item->id}}" {{ old('puc_id') == $item->id ? 'selected' : '' }} >
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
                                <input type="date"  class="form-control form-control-user" value="{{old('vigenciaInicio')}}" id="vigenciaInicio" name="vigenciaInicio"  placeholder="Nombre Grupo CC...">
                            </div>
                            <div class="col-md-6">
                                <label for="">Vigencia Final</label>
                                <input type="date"  class="form-control form-control-user" value="{{old('vigenciaFin')}}" id="vigenciaFin" name="vigenciaFin"  placeholder="Nombre Grupo CC...">
                            </div>
                        </div>
                        <input type="hidden" value="BASICO" name="claseCC" id="claseCC">
                        &nbsp
                        <div class="row" id="departamento_ids">
                            <div class="col-md-6">
                                <label for="">Prorrateo</label>
                                <input type="text" maxlength="3" min="0" max="100" title="El limite de este campo esta entre 1 a 100" class="form-control form-control-user" value="{{old('prorrateo')}}" id="prorrateo" name="prorrateo"  placeholder="0.00">
                            </div>
                        </div>
                        &nbsp
                        @foreach($empresa as $emp)
                            <input type="hidden" value="{{$emp->id}}" name="empresa_id" id="empresa_id">
                        @endforeach
                        <button class="btn btn-primary btn-user btn-block btnEnviar" type="submit">AGEGRAR</button>
                    </form>
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

<script>
    $(document).ready(function() {
        var disabledResults = $(".select2");
        disabledResults.select2();
        $(function() {
            $('#dependencia').hide();
            $('#Subclases').hide();
            $('#id_clase').change(function(){
                if($('#id_clase').val() == 2) {
                    $('#dependencia').show();
                    $('#Subclases').show();
                } else {
                    $('#dependencia').hide();
                    $('#Subclases').hide();
                }
            });
        });
        /*$( "#puc_id" ).change(function() {
            var tipoCuenta=  $('select[name="puc_id"] option:selected').text();
            var cadena=tipoCuenta.indexOf('DETALLE')
            if (cadena == -1){
                alert('Esta cuenta es de tipo Superior, no puede ser elejida');
                $('.btnEnviar').attr('disabled',true)
            }else {
                $('.btnEnviar').attr('disabled',false)
            }
            //console.log(tipoCuenta);
        });*/

    });
</script>
<script !src="">
    $(function() {
        $("#terceros").validate({
            rules: {
                codigoCC: {
                    digits: true,
                    required: true,
                },
                prorrateo:{
                    digits: true,
                    maxlength:20,
                },
                puc_id:{
                    required: true,
                }
            },
            messages: {
                codigoCC: {
                    digits: "Este campo solo resive numeros",
                    required: "Este campo es obligatorio",
                },
                prorrateo:{
                    digits:"Este campo solo revise digitos",
                },
                puc_id:{
                    required: "Este campo es obligatorio",
                }
            }
        });

    });
</script>

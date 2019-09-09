@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('retenciones.update',$retencion->id)}}" method="post" id="puc"  name="puc">
                        {{ method_field('put') }}
                        {{csrf_field()}}
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Editar Retención {{$retencion->concepto}}</h6>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach($empresa as $e)
                                            @if ($e->marco_normativo =='EMPRESA PUBLICA' || $e->marco_normativo =='ENTIDADES DEL GOBIERNO')
                                                <label for="">Tipo de Retención</label>
                                                <select  name="tipoRetencion" id="tipoRetencion" class="select2 form-control custom-select" >
                                                    <option value="{{$retencion->tipoRetencion}}">{{$retencion->tipoRetencion}}</option>
                                                    <option value="Retención en la Fuente" {{old('Retención en Fuente')}}>Retención en la Fuente</option>
                                                    <option value="Retención de IVA" {{old('Retención de IVA')}}>Retención de IVA</option>
                                                    <option value="Estampillas" {{old('Estampillas')}}>Estampillas</option>
                                                    <option value="Retención del ICA" {{old('Retención del ICA')}}>Retención del ICA</option>
                                                    <option value="Fondo de Seguridad" {{ old('Fondo de Seguridad') }} >Fondo de Seguridad</option>
                                                    <option value="Publicaciones" {{ old('Publicaciones') }}>Publicaciones</option>
                                                    <option value="Papeleria" {{ old('Papeleria') }}>Papeleria</option>
                                                    <option value="Otros" {{ old('Otros') }} > Otros</option>
                                                </select>
                                            @elseif($e->marco_normativo =='ENTIDADES PRIVADA')
                                                <label for="">Tipo de Retención</label>
                                                <select  name="tipoRetencion" id="tipoRetencion" class="select2 form-control custom-select" >
                                                    <option value="{{$retencion->tipoRetencion}}">{{$retencion->tipoRetencion}}</option>
                                                    <option value="Retención en la Fuente" {{old('Retención en Fuente')}}>Retención en la Fuente</option>
                                                    <option value="Retención de IVA" {{old('Retención de IVA')}}>Retención de IVA</option>
                                                    <option value="Retención del ICA" {{old('Retención del ICA')}}>Retención del ICA</option>
                                                    <option value="Retención del CRE" {{old('Retención del CRE')}}>Retención del CRE</option>
                                                </select>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Concepto</label>
                                        <input type="text"  class="form-control form-control-user"  value="{{$retencion->concepto}}" id="concepto" name="concepto"  placeholder="Concepto...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Año</label>
                                        <input type="text"  class="form-control form-control-user"  value="{{$retencion->anio}}" id="anio" name="anio"  placeholder="Año...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Porcentaje</label>
                                        <code>Este campo recive 0.00</code>
                                        <input type="text"  class="form-control form-control-user" value="{{$retencion->porcentaje}}" maxlength="4" min="0" max="100" title="El limite de este campo esta entre 1 a 100"   id="puc_id" name="porcentaje"  placeholder="0.00">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Base</label>
                                        <input type="text"  class="form-control form-control-user" value="{{$retencion->base}}" maxlength="3" min="0" max="100" title="El limite de este campo esta entre 1 a 100"   id="porcentaje" name="base"  placeholder="Base...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Monto Minimo</label>
                                        <input type="text"  class="form-control form-control-user"  onkeyup="format(this)" onchange="format(this)" value="{{$retencion->montoMinimo}}" id="montoMinimo" name="montoMinimo"  placeholder="Monto Minimo...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">IVA</label>
                                        <code>Este campo recive 0.00</code>
                                        <input type="text"  class="form-control form-control-user" value="{{$retencion->iva}}" maxlength="4" min="0" max="100" title="El limite de este campo esta entre 1 a 100"   id="iva" name="iva"  placeholder=IVA...">
                                    </div>
                                    <div class="col-md-9">
                                        <label for="">Cuenta CGC</label>
                                        <select  name= "puc_id" id="puc_id" class="select2 form-control custom-select" >
                                            <option value="" >[Seleccione una Cuenta]</option>
                                            @foreach($puc as $item)
                                                {{ $style = $item->tipoCuenta_id == 1 ? '' :  'disabled="disabled"' }}
                                                <option   {{ $style }} {{old('puc_id', $retencion->puc_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">
                                                    {{$item->codigoCuenta}} - {{$item->nombreCuenta}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Activo</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="activo" {{ $retencion->activo=="1" ? 'checked':''}} {{old('activo')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} name="activo" value="1">SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="activo" {{ $retencion->activo=="2" ? 'checked':''}} {{old('activo')=="2" ? 'checked='.'"'.'checked'.'"' : '' }} name="activo" value="2">NO</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Automatico</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="automatico" {{ $retencion->automatico=="1" ? 'checked':''}} {{old('automatico')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} name="automatico" value="1">SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="automatico" {{ $retencion->automatico=="2" ? 'checked':''}} {{old('automatico')=="2" ? 'checked='.'"'.'checked'.'"' : '' }} name="automatico" value="2">NO</label>
                                    </div>
                                </div>
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                            </div>
                            &nbsp
                        </div>

                    </form>
                    @can('retenciones.destroy')
                        <form method="POST" id="deleteTipoDoc"
                              action="{{route('retenciones.destroy',$retencion->id)}}">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger btnEnviar" style="width: 20%;margin-left: 80%;">ELIMINAR</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script>

        function format(input)
        {
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                input.value = num;
            }

            else{ alert('Solo se permiten numeros');
                input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }
        $(document).ready(function() {
            var disabledResults = $(".select2");
            disabledResults.select2();
        });
    </script>
    <script>
        $(function() {
            $( "#puc" ).validate({
                rules: {
                    tipoRetencion:{
                        required: true,
                    },
                    concepto:{
                        required: true,
                    },
                    anio:{
                        digits:true,
                        maxlength:4,
                    },
                    porcentaje:{
                        number:true,
                        maxlength:4,
                    },
                    base:{
                        digits:true,
                        maxlength:4,
                    },
                    montoMinimo:{
                        digits:true,
                        maxlength:20,
                    },
                    iva:{
                        number:true,
                        maxlength:4,
                    },
                    puc_id:{
                        required: true,
                    }
                },
                messages: {
                    tipoRetencion:{
                        required: "Este campo es Obligatorio",
                    },
                    concepto:{
                        required: "Este campo es Obligatorio",
                    },
                    anio:{
                        digits: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 3"
                    },
                    porcentaje:{
                        number: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 3 digitos"
                    },
                    base:{
                        digits: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 3 digitos"
                    },
                    montoMinimo:{
                        digits: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 20 digitos"
                    },
                    iva:{
                        number: "Este campo solo recive digitos",
                        maxlength: "Este campo solo recive hasta 3 digitos"
                    },
                    puc_id:{
                        required: "Este campo es Obligatorio",
                    }
                }
            });
        });

        function todos1(){
            $('#iva').prop("disabled",true);
            $('#iva').val('');
        }
        function todos2() {
            $('#iva').prop("disabled",false);
        }
    </script>
    <script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

@endsection

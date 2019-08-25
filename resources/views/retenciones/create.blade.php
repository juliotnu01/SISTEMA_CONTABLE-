@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('retenciones.store')}}" method="post" id="puc"  name="puc">
                        {{csrf_field()}}
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Crear Retención</h6>
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
                                    <div class="col-md-2">
                                        <label for="">Descuento</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="descuento" onclick="todos1()" name="descuento" value="1" {{ old('descuento')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="descuento" checked="checked" onclick="todos2()" name="descuento" value="2"  {{ old('descuento')=="2" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach($empresa as $e)
                                            @if ($e->marco_normativo =='EMPRESA PUBLICA' || $e->marco_normativo =='ENTIDADES DEL GOBIERNO')
                                                <label for="">Tipo de Retención</label>
                                                <select  name="tipoRetencion" id="tipoRetencion" class="select2 form-control custom-select" >
                                                    <option value=""></option>
                                                    <option value="Retención en la Fuente" {{old('Retención en Fuente')}}>Retención en la Fuente</option>
                                                    <option value="Retención de IVA" {{old('Retención de IVA')}}>Retención de IVA</option>
                                                    <option value="Estampillas" {{old('Estampillas')}}>Estampillas</option>
                                                    <option value="Retención del ICA" {{old('Retención del ICA')}}>Retención del ICA</option>
                                                    <option value="Fondo de Seguridad" {{ old('Fondo de Seguridad') }} >Fondo de Seguridad</option>
                                                    <option value="Publicaciones" {{ old('Publicaciones') }}>Publicaciones</option>
                                                    <option value="Papeleria" {{ old('Papeleria') }}>Papeleria</option>
                                                    <option value="Otros" {{ old('Otros') }} > Otros</option>
                                                {{--    <option value="Otras Deducciones en Gastos">Otras Deducciones en Gastos</option>
                                                    <option value="Otros RetencionesDescuentos en Ingresos">Otros RetencionesDescuentos en Ingresos</option>
                                              --}}  </select>
                                            @elseif($e->marco_normativo =='ENTIDADES PRIVADA')
                                                <label for="">Tipo de Retención</label>
                                                <select  name="tipoRetencion" id="tipoRetencion" class="select2 form-control custom-select" >
                                                    <option value="Retención en la Fuente" {{old('Retención en Fuente')}}>Retención en la Fuente</option>
                                                    <option value="Retención de IVA" {{old('Retención de IVA')}}>Retención de IVA</option>
                                                    <option value="Retención del ICA" {{old('Retención del ICA')}}>Retención del ICA</option>
                                                    <option value="Retención del CRE" {{old('Retención del CRE')}}>Retención del CRE</option>
                                               {{--     <option value="Otras Deducciones en Gastos">Otras Deducciones en Gastos</option>
                                                    <option value="Otros RetencionesDescuentos en Ingresos">Otros RetencionesDescuentos en Ingresos</option>
                                               --}} </select>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Concepto</label>
                                        <input type="text"  class="form-control form-control-user"  id="concepto" name="concepto"  placeholder="Concepto...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Año</label>
                                        <select  name= "anio" id="anio" class="select2 form-control custom-select" >
                                            <option value="">[Seleccione un Año]</option>
                                            <option value="2018">2018</option>
                                               <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Porcentaje</label>
                                        <code>Este campo recive 0.00</code>
                                        <input type="text"  class="form-control form-control-user" maxlength="4" min="0" max="100" title="El limite de este campo esta entre 1 a 100"   id="porcentaje" name="porcentaje"  placeholder="0.00">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Base</label>
                                        <input type="text"  class="form-control form-control-user"  id="base" name="base"  placeholder="Base...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Monto Minimo</label>
                                        <input type="text"  class="form-control form-control-user"  id="montoMinimo" name="montoMinimo"  placeholder="Monto Minimo...">
                                    </div>
                                </div>
                                &nbsp
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">IVA</label>
                                        <code>Este campo recive 0.00</code>
                                        <input type="text"  class="form-control form-control-user" maxlength="4" min="0" max="100" title="El limite de este campo esta entre 1 a 100"   id="iva" name="iva"  placeholder="0.00">
                                    </div>
                                    <div class="col-md-9">
                                        <label for="">Cuenta CGC</label>
                                        <select  name= "puc_id" id="puc_id" class="select2 form-control custom-select" >
                                            <option value="" >[Seleccione una Cuenta]</option>
                                            @foreach($puc as $item)
                                                {{ $style = $item->tipoCuenta_id == 2 ? '' :  'disabled' }}
                                                <option   {{ $style }} value="{{$item->id}}" {{ old('puc_id') == $item->id ? 'selected' : '' }} >
                                                    {{$item->codigoCuenta}} - {{$item->nombreCuenta}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-md-2">
                                        <label for="">Consumo</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="consumo" name="consumo" value="1" {{ old('consumo')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="consumo" name="consumo" value="2"  {{ old('consumo')=="2" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Automatico</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="automatico" name="automatico" value="1" {{ old('automatico')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="automatico" name="automatico" value="2"  {{ old('automatico')=="2" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block btnEnviar" type="submit">AGREGAR</button>
                            </div>
                            &nbsp
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var disabledResults = $(".select2");
            disabledResults.select2();
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
@endsection

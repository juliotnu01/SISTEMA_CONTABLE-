
@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('personaJuridica.store')}}" method="post" id="terceros" name="terceros">
                        {{csrf_field()}}
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">PERSONAS JURIDICAS</h6>
                                <code>Asegurate de que todos los campos esten bien diligenciados antes de enivar</code>
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
                        <div class="row" id="nits">
                            <div class="col-md-6">
                                <label for="">NIT</label>
                                <input type="hidden"  id="tipoPersona" name="tipoPersona" value="2">
                                <input type="text"  class="form-control form-control-user" id="nit" name="nit" onchange="calcular()" value="{{ old('nit') }}" placeholder="NIT...">
                                {{--<button type="button" class="btn btn-primary mb-2" id="calcular" onclick="calcular()">Calcular Dígito de Verificación</button>--}}
                            </div>
                            <div class="col-md-6">raz_social
                                <label for="">Digitó de Verificación</label>
                                <input type="text"  class="form-control form-control-user" id="dv"  readonly="readonly" name="dv" {{ old('dv') }}  placeholder="DV...">
                            </div>
                        </div>
                        &nbsp
                        <div class="row" id="raz_socials">
                            <div class="col-md-6">
                                <label for="">Razón Social</label>
                                <input type="text"  class="form-control form-control-user" id="raz_social" name="raz_social" value="{{ old('raz_social') }}" placeholder="RAZON SOCIAL O NOMBRE DE LA EMPRESA...">
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombre Comercial</label>
                                <input type="text"  class="form-control form-control-user"  id="nomComercial" name="nomComercial" value="{{ old('nomComercial') }}" placeholder="NOMBRE COMERCIAL...">
                            </div>
                        </div>
                        &nbsp
                        <div class="row" id="id_regimenTributario">
                            <div class="col-md-12">
                                <label for="">Régimen Tributario</label>
                                <select  name= "id_regimenTributario" id="id_regimenTributario" class="form-control ">
                                    <option value="6">[Seleccione un Régimen]</option>
                                    @foreach($regimenTribuario as $regimen)
                                        <option value="{{$regimen->id}}"  {{ old('id_regimenTributario') == $regimen->id ? 'selected' : '' }}>{{$regimen->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        &nbsp
                        <div class="row" id="departamento_ids">
                            <div class="col-md-6">
                                <label for="">Departamento</label>
                                <select  name= "idDepartamento" id="idDepartamento" class="select2 form-control custom-select" style="width: 100%; height:36px;" onchange="municipios()">
                                    <option value="34">[Seleccione un Departamento]</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}" {{ old('idDepartamento') == $departamento->id ? 'selected' : '' }}>{{$departamento->nameDepartamento}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Ciudad</label>
                                <select  name= "ciudad_id" id="ciudad_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                    <option value="2">[Seleccione un Municipio]</option>
                                    @foreach($ciudad as $ciu)
                                        <option value="{{$ciu->id}}" {{ old('idCiudad') == $ciu->id ? 'selected' : '' }} >{{$ciu->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        &nbsp
                        <div class="row" id="idActividads">
                            <div class="col-md-6">
                                <label for="">Descriptores CIIU</label>
                                <select  name= "descritores_id" id="descritores_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" onchange="codigoCiiu()">
                                    <option value="5">[Seleccione uno]</option>
                                    @foreach($descriptoresnCiiu as $descriptores)
                                        <option value="{{$descriptores->id}}" {{ old('descritores_id') == $descriptores->id ? 'selected' : '' }}>{{$descriptores->actividad}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Actividades CIIU</label>
                                <select  name= "id_actividadesCiiu" id="id_actividadesCiiu" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                    <option value="481">[Seleccione una Actividad]</option>
                                    @foreach($actividadesCiiu as $actividad)
                                        <option value="{{$actividad->id}}"{{ old('id_actividadesCiiu') == $actividad->id ? 'selected' : '' }}>{{$actividad->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        &nbsp
                            <div class="row"  id="nombre1s">
                                <div class="col-md-6">
                                    <label for="">Primer Nombre Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('nombre1')}}" id="nombre1" name="nombre1"  placeholder="Primer Nombre...">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Segundo Nombre Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('nombre2')}}" id="nombre2" name="nombre2"  placeholder="Segundo Nombre...">
                                </div>
                            </div>
                            &nbsp
                            <div class="row"  id="apellido1s">
                                <div class="col-md-6">
                                    <label for="">Primer Apellido Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('apellido')}}" id="apellido1" name="apellido"  placeholder="Primer Apellido...">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Segundo Apellido Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('apellido2')}}" id="apellido2" name="apellido2"  placeholder="Segundo Apellido...">
                                </div>
                            </div>
                            &nbsp
                            <div class="row"  id="direccions">
                                <div class="col-md-6">
                                    <label for="">Dirección Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('direccion')}}" id="direccion" name="direccion"  placeholder="Dirección...">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Teléfono Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('telefono')}}" id="telefono" name="telefono"  placeholder="Número de Teléfono...">
                                </div>
                            </div>
                            &nbsp
                            <div class="row"  id="celulars">
                                <div class="col-md-6">
                                    <label for="">Celular Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('celular')}}" id="celular" name="celular"  placeholder="Celular...">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Correo Representante Legal</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('correo')}}" id="correo" name="correo"  placeholder="Correo Electrónico...">
                                </div>
                            </div>
                            &nbsp
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label for="">Responsable de IVA</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="responsableIVA" name="responsableIVA" checked="checked" value="SI" {{ old('responsableIVA')=="SI" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="responsableIVA" name="responsableIVA" value="NO" {{ old('responsableIVA')=="NO" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Régimen Simple</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="regimenSimple" name="regimenSimple" checked="checked" value="SI" {{ old('regimenSimple')=="SI" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="regimenSimple" name="regimenSimple" value="NO" {{ old('regimenSimple')=="NO" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Auto Retenedor</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="autoRetenedor" name="autoRetenedor" checked="checked" value="SI" {{ old('autoRetenedor')=="SI" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="autoRetenedor" name="autoRetenedor" value="NO" {{ old('autoRetenedor')=="NO" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label for="">Tipo de Persona </label>--}}
                                    {{--<select  name= "tipoPersona" id="tipoPersona" class="form-control ">--}}
                                        {{--<option value="">[Seleccione una opción]</option>--}}
                                        {{--<option value="1">PERSONA NATURAL</option>--}}
                                        {{--<option value="2">PERSONA JURIDICA</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            &nbsp
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sector Financiero - Banco</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="banco" name="banco" value="SI" {{ old('banco')=="SI" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="banco" name="banco" value="NO" {{ old('banco')=="NO" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Información Bancaria</label>
                                        <label class="radio-inline">
                                            <input type="radio"  id="SiInfo"  onclick="show1()" name="infoBanco" value="1"  {{ old('infoBanco')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}>SI</label>
                                        <label class="radio-inline">
                                            <input type="radio" id="NoInfo" onclick="show2()" name="infoBanco" checked value="2" {{ old('infoBanco')=="2" ? 'checked='.'"'.'checked'.'"' : '' }}>NO</label>
                                    </div>
                                </div>
                            </div>
                            &nbsp
                            <div id="bancos" style="display:none;">
                            <div class="row"  id="">
                                <div class="col-md-12">
                                    <label for="">Entidad Bancaria</label>
                                    <select  name="entidadBancaria_id" id="entidadBancaria_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option value="1">[SELECCIONES UNA OPCIÓN]</option>
                                        @foreach($entidadBancaria as $entidad)
                                            <option value="{{$entidad->id}}" {{ old('entidadBancaria_id') == $entidad->id ? 'selected' : '' }}>{{$entidad->CodigoSuperbancaria}} {{$entidad->DenominacionSocialEntidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            &nbsp
                            <div class="row"  id="">
                                <div class="col-md-6">
                                    <label for="">Número de Cuenta</label>
                                    <input type="text"  class="form-control form-control-user" value="{{old('numeroCuenta')}}" id="numeroCuenta" name="numeroCuenta"  placeholder="Número de Cuenta...">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Estado Actual</label>
                                        <select  name= "estadoCuenta"  id="estadoCuenta" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option value="">[Seleccione una opción]</option>
                                            <option value="Registro previo">Registro previo </option>
                                            <option value="Inválida">Inválida</option>
                                            <option value="Activa">Activa</option>
                                            <option value="Cancelada">Cancelada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row"  id="">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tipo Cuenta Bancaria</label>
                                        <label class="radio-">
                                            <input type="radio"  id="TipocuentaBancaria" name="TipocuentaBancaria" value="1"  {{ old('TipocuentaBancaria')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}>Ahorros</label>
                                        <label class="radio-">
                                            <input type="radio" id="TipocuentaBancaria" name="TipocuentaBancaria"  value="2" {{ old('TipocuentaBancaria')=="2" ? 'checked='.'"'.'checked'.'"' : '' }}>Corriente</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <code>Asegurate de que todos los campos esten bien diligenciados antes de enivar</code>
                        <button class="btn btn-primary btn-user btn-block" type="submit">AGEGRAR</button>
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
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script !src="">
    $(function() {
        $( "#terceros" ).validate({
            rules: {
                nit: {
                    required: true,
                    digits: true,
                    maxlength:20,
                    minLength:5,
                },
                numeroCuenta:{
                    digits: true,
                    maxlength:20,
                },
                raz_social : {
                    required: true,
                },
                correo_rl:{
                    email: true,
                },
                celular_rl:{
                    digits: true,
                },

            },
            messages: {
                nit: {
                    required: "Este campo es Obligatorio",
                    digits:"Este campo solo revise digitos",
                    maxlength:"Este campo debe tener maximo 20 numeros",
                    minLength:"Este campo debe tener minimo 5 numeros",
                },
                raz_social: {
                    required: "Este campo es Obligatorio",
                },
                correo_rl:{
                    email: "El formato de correo electrónico no es valido",
                },
                celular_rl:{
                    required: "Este campo es Obligatorio",

                },
                numeroCuenta: {
                    digits:"Este campo solo revise digitos",
                    maxlength:"El limite es de 20 números"
                },

            }
        });

    });
</script>
<script !src="">
    function show1(){
        document.getElementById('bancos').style.display ='block';

    }
    function show2() {
        document.getElementById('bancos').style.display = 'none';
    }
</script>
<script>
    $(document).ready(function() {
        $(function() {
            $('#tipoPersona').change(function(){
                if($('#tipoPersona').val() == 1) {
                    $('#juridica').hide();
                    $('#naturales').show();

                } else {
                    $('#juridica').show();
                    $('#naturales').hide();

                }
            });
        });

    });
</script>
<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

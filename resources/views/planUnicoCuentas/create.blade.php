@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('puc.store')}}" method="post" id="puc"  name="puc">
                        {{csrf_field()}}
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">NUEVA CUENTA {{strtoupper($cuenta->nombreCuenta)}}</h6>
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
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label for="Formato " title="USA ESTA OPCION PARA COMPLETAR EL CAMPO SIGIENTE">Buscar Cuentas Creadas <i class="fa fa-search"></i></label>
                                            <select   name="puc" id="puc" class="select2 form-control ">
                                                @foreach($pucs as $item)
                                                    <option value="{{$item->codigoCuenta}}">{{$item->codigoCuenta}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  id="tipoDocumentos">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Código Cuenta</label>
                                            <div class="input-group">

                                               {{-- <div class="input-group-prepend">
                                                    <div class="input-group-text">{{$cuenta->codigoCuenta}}</div>
                                                </div>--}}
                                                <input type="text" onchange="claseCuenta()" class="codigoCuenta form-control form-control-user" id="codigoCuenta" name="codigoCuenta"  value="{{old('codigoCuenta', $cuenta->codigoCuenta)}}" placeholder="Codigo...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="">Cuenta Superior</label>
                                            <input type="text"  class="form-control-plaintext" id="codigoSuperior" name="codigoSuperior"  value="{{$cuenta->codigoCuenta}}" placeholder="Cuenta dependiente..." readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  id="tipoDocumentos">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre de Cuenta</label>
                                            <input type="text"  class="form-control form-control-user" id="nombreCuenta" name="nombreCuenta"  value="{{$cuenta->nombreCuenta}}" placeholder="Nombre de Cuenta...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tipo de Cuenta</label>
                                            <select  onChange="tipoCuentas()" name= "tipoCuenta_id" id="tipoCuenta" class="form-control ">
                                                <option value="">[Seleccione una opción]</option>
                                                @foreach($tipoCuentas as $item)
                                                    <option value="{{$item->id}}" {{ old('tipoCuenta_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Naturaleza</label>
                                            <input type="text" name="naturalezaCuenta" id="naturalezaCuenta" class="form-control form-control-user" value="{{$cuenta->naturalezaCuenta}}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nivel</label>
                                            <input type="text" name="nivel" id="nivel" class="form-control form-control-user" value="{{$cuenta->nivel}}" readonly="readonly">
                                        </div>
                                    </div>
                                 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correriente / No Corriente</label>
                                            <select name="CuentaCoNC" id="CuentaCoNC" class="form-control">
                                                <option value="">SELECCIONE UN OPCION</option>
                                                <option value="Corriente">Corriente</option>
                                                <option value="No Corriente">No Corriente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none;" id="checks" class=" detalle row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Formato DIAN Exógena</label>
                                            <select name="formatoDian_id" id="formatoDian_id" class="form-control " onchange="dian()">
                                                <option value="">[Selecciones una Opcion]</option>
                                                @foreach($formato as $item)
                                                    <option value="{{$item->id}}" {{ old('formatoDian_id') == $item->id ? 'selected' : '' }}>{{$item->nombreFormatoDian}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Concépto Formato DIAN Exógena</label>
                                        <br>
                                        <select name="conceptoDian_id" id="conceptoDian_id" class="form-control">
                                            <option value="">[Seleccione un Formato]</option>
                                            @foreach($concepto as $item)
                                                <option value="{{$item->id}}" {{ old('conceptoDian_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Privilegios</label>
                                        <br>
                                            <select name="opcionesPrivilegios_id" id="opcionesPrivilegios_id" class="form-control">
                                                <option value="8">[Seleccione un privilegio]</option>
                                                @foreach($privilegios as $item)
                                                    <option value="{{$item->id}}" {{ old('opcionesPrivilegios_id') == $item->id ? 'selected' : '' }}>{{$item->nombrePrivilegio}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-6">
                                <label for="">Seleccione una</label>
                                <br>
                                <input class="checked" id="Cuentac" name="cuentaCobrar" type="checkbox" value="1">
                                <label for="Cuentac" >Cuenta por Cobrar</label>
                                <br>
                                <input class="checked" id="Cuentap" name="cuentaPagar" type="checkbox" value="1">
                                <label for="Cuentap" >Cuenta por Pagar</label>
                                <br>
                                <input class="checked" id="Refiere" name="refiereFlujo" type="checkbox" value="1">
                                <label for="Refiere" >Refiere Flujo de Efectivo</label>
                                <br>
                                <input class="checked" id="farmacia" name="exigeTerceros" type="checkbox" value="1">
                                <label for="farmacia" >Exige Terceros</label>
                                <br>
                                <input class="checked" id="exige" name="exigeCentroCostos" type="checkbox" value="1">
                                <label for="exige" >Exige Centro de Costos</label>
                                <br>
                                <input class="checked" id="exigeBase" name="exigeBase" type="checkbox" value="1" onchange="showPorcentaje()">
                                <label for="exigeBase" >Exige Base</label>
                                <br>
                                <input class="checked" id="Activa" name="activa" type="checkbox" value="1">
                                <label for="Activa" >Activa</label>
                                <div class="form-group" id="porcentaje" style="width:20%;display:none;">
                                    <label for="">Porcentaje</label>
                                    <input type="text" maxlength="3" min="0" max="100" name="porcentaje" title="El limite de este campo esta entre 1 a 100" id="porcentaje" class="form-control form-control-user" placeholder="Porcentaje">
                                </div>
                            </div>
                                </div>
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block" type="submit">AGREGAR</button>
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
            crossorigin="anonymous">
    </script>

    <script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            var codigoCuenta = $('#codigoCuenta').val();
            var codigoCuentaLong = codigoCuenta.length;
            var nivel = $('#nivel').val();
            switch (nivel) {
                case '1':
                    //DE 1 NIVEL 2
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong + ' NIVEL ' + nivel)
                        if (nivel <= 2 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong != 2) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 1 DIGITO');
                            }
                        }
                    });
                break;
                case '2': //DE 2 NIVEL 3
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong + ' NIVEL ' + nivel)
                        if (nivel >= 2 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong != 4) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '3': // DE 3 NIVEL 4
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong + ' NIVEL ' + nivel)
                        if (nivel >= 3 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong != 6) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '4': // DE 4 NIVEL 5
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong )
                        if (nivel >= 4 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                        if (codigoCuentaLong !=8) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '5': // DE 5 NIVEL 6
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong )
                        if (nivel >= 5 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong !=10) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '6': // DE 6 NIVEL 7
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong )
                        if (nivel >= 6 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong !=12) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '7': // DE 7 NIVEL 8
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong )
                        if (nivel >= 7 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong !=14) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                case '8': // DE 8 NIVEL 9
                    $('#codigoCuenta').focusout(function() {
                        var nivel = $('#nivel').val();
                        var codigoCuenta = $('#codigoCuenta').val();
                        var codigoCuentaLong = codigoCuenta.length;
                        console.log(' TAMAÑO  ' + codigoCuentaLong )
                        if (nivel >= 8 || nivel === "EL NUMERO ESTA MAL REDACTADO") {
                            if (codigoCuentaLong !=16) {
                                alert('ESTA CUENTA SOLO SE PUEDE AUMENTAR 2 DIGITO');
                            }
                        }
                    });
                break;
                default:
                    alert('ERROR');
            }

        });
    </script>
    <script !src="">
        $(document).ready(function(){
            $("select[name=puc]").change(function(){
                $('input[name=codigoCuenta]').val($(this).val());
            });
        });
    </script>
    <script>
        $(function() {
            $( "#puc" ).validate({
                rules: {
                    codigoCuenta:{
                        required: true,
                        digits: true,
                    },
                    nombreCuenta:{
                        required: true,
                    },
                    porcentaje:{
                        digits: true,
                    },
                    nivel:{
                        digits: true,
                    },
                    tipoCuenta_id:{
                        required: true,
                    }
                },
                messages: {
                    codigoCuenta:{
                        required: "Este campo es Obligatorio",
                        digits:"Este campo solo revise digitos"
                    },
                    nombreCuenta:{
                        required: "Este campo es Obligatorio",
                    },
                    porcentaje:{
                        digits:"Este campo solo revise digitos",
                    },
                    nivel:{
                        digits:"ERROR",
                    },
                    tipoCuenta_id:{
                        required: "Este campo es Obligatorio",
                    }
                }
            });

            $(function() {
                $('#exigeBase').change(function(){
                    if($('#exigeBase').val() == 1) {
                        $('#naturales').show();

                    } else {
                        $('#porcentaje').hide();

                    }
                });
            });


        });
    </script>
    <script type="text/javascript">
        function showPorcentaje() {
            divPorcentaje = document.getElementById("porcentaje");
            check = document.getElementById("exigeBase");
            if (check.checked) {
                divPorcentaje.style.display='block';
            }
            else {
                divPorcentaje.style.display='none';
            }
        }

    </script>
    <script !src="">
        function tipoCuentas() {
            var tipo=$('#tipoCuenta').val();
            if (tipo==='1' ){
                $('#checks').hide();
                console.log(tipo)
            }
            else if(tipo==='2'){
                $('#checks').show(  );
                console.log(tipo)

            }
        }
        function claseCuenta() {
            var codigo= $('#codigoCuenta').val().split('');
            var tamano=codigo.length;
            var pares =tamano%2;
            var primer=codigo[0];
            if (primer==='1' || primer==='5' || primer==='6' || primer==='7' || primer==='8'){
                //console.log('debito')
                primer=$('#naturalezaCuenta').val('Débito');
                primer=$('#naturalezaCuenta').val('Débito');
            }
            if (primer==='2' || primer==='3' || primer==='4' || primer==='9'){
                //console.log('Crédito')
                primer=$('#naturalezaCuenta').val('Crédito');
                primer=$('#naturalezaCuenta').val('Crédito');
            }
            if (tamano===1){
                $('#nivel').val('1')
            }
            if (tamano===2){
                $('#nivel').val('2')
            }
            if (tamano===4){
                $('#nivel').val('3')
            }
            if (tamano===6){
                $('#nivel').val('4')
            }
            if (tamano===8){
                $('#nivel').val('5')
            }
            if (tamano===10){$('#nivel').val('6')}
            if (tamano===12){$('#nivel').val('7')}
            if (tamano===14){$('#nivel').val('8')}
            if (tamano===16){$('#nivel').val('9')}
            if (tamano===18){$('#nivel').val('10')}
            if (tamano===20){$('#nivel').val('10')}
            if (pares!=0){var mal=$('#nivel').val('EL NUMERO ESTA MAL REDACTADO').style.background='red'}

        }

    </script>


@endsection

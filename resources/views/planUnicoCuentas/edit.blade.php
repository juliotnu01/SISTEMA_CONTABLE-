@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('puc.update',$puc->id)}}" method="post" id="puc" name="puc">
                        {{ method_field('put') }}
                        {{csrf_field()}}
                        @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                        @endif
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">PLAN UNICO DE CUENTAS</h6>
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
                                <div class="row"  id="tipoDocumentos">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Código Cuenta</label>
                                            <input type="text" onchange="claseCuenta()"  class="form-control form-control-user" id="codigoCuenta" name="codigoCuenta"  value="{{old('codigoCuenta',$puc->codigoCuenta)}}" placeholder="Codigo...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Cuenta Superior</label>
                                            <input type="text"  class="form-control-plaintext" id="codigoSuperior" name="codigoSuperior"  value="{{$puc->codigoSuperior}}" placeholder="Cuenta dependiente..." readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  id="tipoDocumentos">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre de Cuenta</label>
                                            <input type="text"  class="form-control form-control-user" id="nombreCuenta" name="nombreCuenta"  value="{{old('nombreCuenta',$puc->nombreCuenta)}}" placeholder="Nombre de Cuenta...">
                                        </div>
                                    </div>
                                    {{--@if($puc->tipoCuenta_id==1)--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tipo de Cuenta</label>
                                                <select   onChange="tipoCuentas()"  name="tipoCuenta_id" id="tipoCuenta" class="form-control ">
                                                    @foreach($tipoCuentas as $item)
                                                        <option {{ old('tipoCuenta_id', $puc->tipoCuenta_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                   {{-- @else
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tipo de Cuenta</label>
                                                <select  onChange="tipoCuentas()" name="tipoCuenta_id" id="tipoCuenta" class="form-control ">
                                                    @foreach($tipoCuentas as $item)
                                                        <option {{ old('tipoCuenta_id', $puc->tipoCuenta_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif--}}

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Naturaleza</label>
                                            <input type="text" name="naturalezaCuenta" id="naturalezaCuenta" class="form-control form-control-user" value="{{$puc->naturalezaCuenta}}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nivel</label>
                                            <input type="text" name="nivel" id="nivel" value="{{$puc->nivel}}" class="form-control form-control-user" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correriente / No Corriente</label>
                                            <select name= "CuentaCoNC" id="CuentaCoNC" class="form-control ">
                                                <option value="{{$puc->CuentaCoNC}}">{{$puc->CuentaCoNC}}</option>
                                                <option value="Corriente">Corriente</option>
                                                <option value="No Corriente">No Corriente</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                @if($puc->tipoCuenta_id!=2)
                                    <div class="row" id="checks" style="display: none">
                                        <div class="col-md-6">
                                            <label for="">Privilegios</label>
                                            <br>
                                            <select name="opcionesPrivilegios_id" id="opcionesPrivilegios_id" class="form-control">
                                                <option value="">[Seleccione un privilegio]</option>
                                                @foreach($privilegios as $item)
                                                    <option {{ old('opcionesPrivilegios_id', $puc->opcionesPrivilegios_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombrePrivilegio}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Seleccione una</label>
                                            <br>
                                            <input class="checked" id="Cuentac" name="cuentaCobrar" type="checkbox" value="1" {{ $puc->cuentaCobrar== 1 ? 'checked' : '' }} {{ old('cuentaCobrar')=="cuentaCobrar" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Cuentac" >Cuenta por Cobrar</label>
                                            <br>
                                            <input class="checked" id="Cuentap" name="cuentaPagar" type="checkbox" value="1" {{ $puc->cuentaPagar== 1 ? 'checked' : '' }} {{ old('cuentaPagar')=="cuentaPagar" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Cuentap" >Cuenta por Pagar</label>
                                            <br>
                                            <input class="checked" id="Refiere" name="refiereFlujo" type="checkbox" value="1" {{ $puc->refiereFlujo== 1 ? 'checked' : '' }} {{ old('refiereFlujo')=="refiereFlujo" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Refiere" >Refiere Flujo de Efectivo</label>
                                            <br>
                                            <input class="checked" id="farmacia" name="exigeTerceros" type="checkbox" value="1" {{ $puc->exigeTerceros== 1 ? 'checked' : '' }} {{ old('exigeTerceros')=="exigeTerceros" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="farmacia" >Exige Terceros</label>
                                            <br>
                                            <input class="checked" id="exige" name="exigeCentroCostos" type="checkbox" value="1" {{ $puc->exigeCentroCostos== 1 ? 'checked' : '' }} {{ old('exigeCentroCostos')=="exigeCentroCostos" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="exige" >Exige Centro de Costos</label>
                                            <br>
                                            <input class="checked" id="exigeBase" name="exigeBase" type="checkbox" value="1" {{ $puc->exigeBase== 1 ? 'checked' : '' }} {{ old('exigeBase')==1 ? 'checked='.'"'.'checked'.'"' : '' }} onchange="showPorcentaje()">
                                            <label for="Maneja" >Exige Base</label>
                                            <br>
                                            <input class="checked" id="Activa" name="activa" type="checkbox" value="1" {{ $puc->activa== 1 ? 'checked' : '' }} {{ old('activa')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Activa" >Activa</label>
                                            <div class="form-group" id="porcentaje" style="width:20%;display:none;">
                                                <label for="">Porcentaje</label>
                                                <input type="text" maxlength="3" min="0" max="100"
                                                       name="porcentaje" title="El limite de este campo esta entre 1 a 100"
                                                       id="porcentaje"
                                                       class="form-control form-control-user"
                                                       value="{{$puc->porcentaje}}"
                                                       placeholder="Porcentaje">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row" id="checks">
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="Formato ">Formato DIAN Exógena</label>
                                                <select   name= "formatoDian_id" id="formatoDian_id" class="select2 form-control" onchange="dian()">
                                                    <option value="">[Seleccione un Formato]</option>
                                                    @foreach($formato as $item)
                                                        <option {{ old('formatoDian_id', $puc->formatoDian_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombreFormatoDian}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <label for="Formato ">Concépto Formato DIAN Exógena</label>
                                                <select   name= "conceptoDian_id" id="conceptoDian_id" class="select2 form-control ">
                                                    <option value="">[Seleccione un Formato]</option>
                                                    @foreach($concepto as $item)
                                                        <option {{ old('conceptoDian_id', $puc->conceptoDian_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->codigo.' '.$item->concepto}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Privilegios</label>
                                            <br>
                                            <select name="opcionesPrivilegios_id" id="opcionesPrivilegios_id" class="form-control">
                                                <option value="">[Seleccione un privilegio]</option>
                                                @foreach($privilegios as $item)
                                                    <option {{ old('opcionesPrivilegios_id', $puc->opcionesPrivilegios_id) == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->nombrePrivilegio}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Seleccione una</label>
                                            <br>
                                            <input class="checked" id="Cuentac" name="cuentaCobrar" type="checkbox" value="1" {{ $puc->cuentaCobrar== 1 ? 'checked' : '' }} {{ old('cuentaCobrar')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Cuentac" >Cuenta por Cobrar</label>
                                            <br>
                                            <input class="checked" id="Cuentap" name="cuentaPagar" type="checkbox" value="1" {{ $puc->cuentaPagar== 1 ? 'checked' : '' }} {{ old('cuentaPagar')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Cuentap" >Cuenta por Pagar</label>
                                            <br>
                                            <input class="checked" id="Refiere" name="refiereFlujo" type="checkbox" value="1" {{ $puc->refiereFlujo== 1 ? 'checked' : '' }} {{ old('refiereFlujo')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Refiere" >Refiere Flujo de Efectivo</label>
                                            <br>
                                            <input class="checked" id="exigeTerceros" name="exigeTerceros" type="checkbox" value="1" {{ $puc->exigeTerceros== 1 ? 'checked' : '' }} {{ old('exigeTerceros')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="exigeTerceros" >Exige Terceros</label>
                                            <br>
                                            <input class="checked" id="exige" name="exigeCentroCostos" type="checkbox" value="1" {{ $puc->exigeCentroCostos== 1 ? 'checked' : '' }} {{ old('exigeCentroCostos')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="exige" >Exige Centro de Costos</label>
                                            <br>
                                            <input class="checked" id="exigeBase" name="exigeBase" type="checkbox" value="1" {{ $puc->exigeBase== 1 ? 'checked' : '' }} {{ old('exigeBase')==1 ? 'checked='.'"'.'checked'.'"' : '' }} onchange="showPorcentaje()">
                                            <label for="Maneja" >Exige Base</label>
                                            <br>
                                            <input class="checked" id="Activa" name="activa" type="checkbox" value="1" {{ $puc->activa== 1 ? 'checked' : '' }} {{ old('activa')==1 ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            <label for="Activa" >Activa</label>
                                            @if ($puc->exigeBase=="1")
                                                <div class="form-group" id="porcentaje" style="width:20%;">
                                                    <label for="">Porcentaje</label>
                                                    <input type="text" maxlength="3" min="0" max="100"
                                                           name="porcentaje" title="El limite de este campo esta entre 1 a 100"
                                                           id="porcentaje"
                                                           class="form-control form-control-user"
                                                           value="{{$puc->porcentaje}}"
                                                           placeholder="Porcentaje">
                                                </div>
                                            @else
                                                <div class="form-group" id="porcentaje" style="width:20%;display:none;">
                                                    <label for="">Porcentaje</label>
                                                    <input type="text" maxlength="3" min="0" max="100"
                                                           name="porcentaje" title="El limite de este campo esta entre 1 a 100"
                                                           id="porcentaje"
                                                           class="form-control form-control-user"
                                                           value="{{$puc->porcentaje}}"
                                                           placeholder="Porcentaje">
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                @endif
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                                &nbsp
                            </div>
                            &nbsp
                        </div>
                    </form>
                        @can('puc.destroy')
                            <form method="POST" id="deleteTipoDoc"
                                  action="{{route('puc.destroy',$puc->id)}}">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger " style="width: 20%;margin-left: 80%;">ELIMINAR</button>
                            </form>
                        @endcan

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
            $('.selectpicker').selectpicker();
        });
    </script>
    <script>
        $(function() {
            $( "#puc" ).validate({
                rules: {
                    codigoCuenta:{
                        required: true,
                        digits: true,
                        maxlength:18,
                        minLength:1,
                    },
                    nombreCuenta:{
                        required: true,
                    },
                    CuentaCoNC:{
                        required: true,
                    },
                    opcionesPrivilegios_id:{
                        required:true,
                    }
                },
                messages: {
                    codigoCuenta:{
                        required: "Este campo es Obligatorio",
                        digits:"Este campo solo revise digitos",
                        maxlength:"Este campo debe tener maximo 18 numeros",
                        minLength:"Este campo debe tener minimo 1 numeros",
                    },
                    nombreCuenta:{
                        required: "Este campo es Obligatorio",
                    },
                    CuentaCoNC:{
                        required: "Este campo es Obligatorio",
                    },
                    opcionesPrivilegios_id:{
                        required: "Este campo es Obligatorio",

                    }
                }
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
            if (tipo==='1'){
                $('#checks').hide();
                console.log(tipo)
            }
            else if(tipo==='2'){
                $('#checks').show();
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
                primer=$('#naturalezaCuenta').val('Debito');
                primer=$('#naturalezaCuenta').val('Debito');
            }
            if (primer==='2' || primer==='3' || primer==='4' || primer==='9'){
                //console.log('Credito')
                primer=$('#naturalezaCuenta').val('Credito');
                primer=$('#naturalezaCuenta').val('Credito');
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

        function showCuenta1(){
            document.getElementById('cuentaMaestra_id').style.display ='block';

        }
        function showCuenta2() {
            document.getElementById('cuentaMaestra_id').style.display = 'none';
        }
    </script>
@endsection

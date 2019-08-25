@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3>CREAR USUARIO</h3>
                </div>
                <div class="card-body">
                    <form method="POST" id="terceros" action="{{ route('users.store') }}">
                        @csrf
                            <div class="row" id="idActividads">
                                <div class="form-group">
                                    <div class="form-group" >
                                        <label for="pago1" class="radio-inline">
                                            <input name="pago1" class="tercero" type="radio" value="1"  {{ old(' TERCERO EMPLEADO')=="1" ? 'checked='.'"'.'checked'.'"' : ''}}/> TERCERO EMPLEADO</label>
                                        <label for="tercero" class="radio-inline">
                                            <input class="tercero" name="pago1" type="radio" value="2"  {{ old('TERCERO PERSONA NATURAL')=="2" ? 'checked='.'"'.'checked'.'"' : ''}}/>TERCERO PERSONA NATURAL</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="perNaturales" style="display:none;" >
                                    <div class="form-group" >
                                        <label for="">Personas Natural</label>
                                        <select  name= "personaNatural_id" id="personaNatural_id" class=" form-control">
                                            <option value=""></option>
                                            @foreach($perNatural as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->numeroDocumento}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="perEmpleado" style="display:none;">
                                    <div class="form-group" >
                                        <label for="">Personas Empleados</label>
                                        <select  name= "personaEmpleado_id" id="personaEmpleado_id" class=" form-control select">
                                            <option value=""></option>
                                            @foreach($perEmpleado as $tipos)
                                                <option value="{{$tipos->id}}">{{$tipos->numeroDocumento}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div id="datosExtras" style="display:none;">
                            <div class="row" >
                                <div class="col-md-12">
                                    <label for="email">Correo Electrónico</label>
                                    <input id="email" type="email" value="{{old('email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled">
                                        @foreach($roles as $role)
                                            <li>
                                                <label>
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" >
                                                    <em>{{ $role->name }}</em>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input type="hidden" name="id" id="id" value="{{auth()->user()->id}}">
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">AGREGAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
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
<script !src="">
    $(document).ready(function() {
        $("input[type=radio]").click(function(event){
            var valor = $(event.target).val();
            if(valor =="1"){
                $("#perNaturales").hide();
                $("#perEmpleado").show();
                $("#datosExtras").show();
            } else if (valor == "2") {
                $("#perNaturales").show();
                $("#perEmpleado").hide();
                $("#datosExtras").show();
            } else {
                // Otra cosa
            }
        });
    });

</script>
<script>
$(function() {
    $( "#terceros" ).validate({
        rules: {
            email:{
                email: true,
                required:true,
            },
            password:{
                required:true,
                minlength:4,
                maxlength:10,
            },
        },
        messages: {
            email:{
                email:"Este campo debe ser un correo electronico",
                required: "Este campo es Obligatorio",
            },
            password: {
                required: "Este campo es Obligatorio",
                minlength: "La contraseña debe ser mayor a 4 digitos",
                maxlength: "La contraseña debe ser mayor a 10 digitos",
            },
        }
    });

});
</script>

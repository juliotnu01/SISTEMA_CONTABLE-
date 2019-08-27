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
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                    </div>
                    <form class="user"  action="{{route('cierres.update',$cierres->id)}}" method="post" id="puc"  name="puc">
                        {{csrf_field()}}
                        {{ method_field('put') }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Año</label>
                                    <input type="text" class="form-control form-control-user" id="anio" name="anio" value="{{$cierres->anio}}" placeholder="Año...">
                                    <input type="hidden" name="cierre_id[]"/>
                                </div>
                            </div>
                            <button style="margin-top: -43px;float: right;" type="button" class="btn btn-primary agregarConcepto" id="agregarConcepto"><i class="fa fa-plus"></i></button>
                            <div class="row"  id="numeroDocumentos">
                                <div class="col-md-12" style="overflow:scroll;
                                         height: 330px;">
                                    <table id="TablaPro" class="table">
                                        <tbody id="concepto">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                        </div>
                        &nbsp
                </form>
                </div>
                <div class="row container">
                    <div class="col-md-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                Conceptos
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Conceptos</th>
                                        <th>Cuenta del Concepto</th>
                                        <th>Eliminar</th>
                                    </tr>
                                    </thead>
                                    @foreach($conceptos as $item)
                                        <tbody>
                                        <tr>
                                            <th style="width: 10%;">{{$item->nombreConcepto}}</th>
                                            <th>{{$item->codigoCuenta}}</th>
                                            <th style="width: 10%;">
                                                <form method="POST" id="deleteTipoDoc" action="{{route('cierres.destroyConcepto',$item->id)}}">
                                                    {{method_field('DELETE')}}
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-circle btn-sm btn-danger" ><i class="fa fa-times"></i></button>
                                                </form>
                                            </th>
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

    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

        });
    </script>
    <script !src="">
        var i = 0;
        $('#agregarConcepto').click(function(){
            if (i < 4) { /*Cambiar el >= 0 por < 10 si quieres limitar el incremento*/
                i++;
            }else{
                $('.agregarConcepto').attr('disabled',true)
                console.log('para')

            }
            console.log(i)

            $('#concepto').append(
                '<tr class="active">' +
                '<td>'+
                '<select  name="nombreConcepto[]" id="nombreConcepto" class="select2 form-control custom-select" >' +
                '  <option value="Ingreso">Ingreso</option>' +
                '  <option value="Gastos">Gastos</option>' +
                '  <option value="Costo">Costo</option>' +
                '  <option value="Utilidades">Utilidades</option>' +
                '  <option value="Perdida">Perdida</option>' +
                '</select></td>' +
                '<input type="hidden" name="cierre_id[]"/>' +
                '<td>' +
                '<select  name="puc_id[]" id="puc_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" >'+
                '<option value="">[Seleccione una Cuenta]</option>'+
                '    @foreach($puc as $item)'+
                '        {{ $style = $item->tipoCuenta_id == 2 ? '' :  'disabled="disabled"' }}'+
                '       <option {{ $style }} value="{{$item->id}}" {{ old('puc_id') == $item->id ? 'selected' : '' }} >'+
                '       {{$item->codigoCuenta}} - {{$item->nombreCuenta}}'+
                '       </option>'+
                '   @endforeach'+
                '</select></td>'+
                '</tr>');
        });
    </script>
@endsection

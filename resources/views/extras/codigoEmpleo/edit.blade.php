@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('codigoEmpleo.update',$codEmpleo->id)}}" method="post" id="terceros" name="terceros">
                        {{ method_field('put') }}
                        {{csrf_field()}}
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">EDITAR CODIGO DE EMPELO</h6>
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
                            @if (Session::has('message'))
                                <div class="alert alert-warning">{{ Session::get('message') }}</div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-user" id="codigo" name="codigo" value="{{$codEmpleo->codigo}}" placeholder="CODIGO...">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-user" id="nombreEmpleo" name="nombreEmpleo" value="{{$codEmpleo->nombreEmpleo}}" placeholder="NOMBRE...">
                                    </div>
                                </div>
                                &nbsp
                                <div class="row">
                                    <div class="col-md-12">
                                        <select  name= "id_nivelEmpleo" id="id_nivelEmpleo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option value="">[Nivel de Empleo]</option>
                                            @foreach($nivelEmpleo as $nivel)
                                                <option {{ old('id_nivelEmpleo', $codEmpleo->id_nivelEmpleo) == $nivel->id ? 'selected' : '' }} value="{{$nivel->id}}"> {{$nivel->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                            </div>
                        </div>
                    </form>
                    &nbsp
                    <form method="POST" id="deleteTipoDoc" style="float: inline-end; margin-right: 90%;"
                          action="{{route('codigoEmpleo.destroy',$codEmpleo->id)}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle"></i>ELIMINAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="user"  action="{{route('regimenTributario.update',$regimenTrubutario->id)}}" method="post" id="terceros" name="terceros">
                        {{ method_field('put') }}
                        {{csrf_field()}}
                        <div class="card shadow mb-4" id="datosBasicos" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">EDITAR REGIMEN TRIBUTARIO</h6>
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
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-user" id="nombre" name="nombre" value="{{$regimenTrubutario->nombre}}" placeholder="NOMBRE...">
                                    </div>
                                </div>
                                &nbsp
                                <button class="btn btn-primary btn-user btn-block" type="submit">EDITAR</button>
                            </div>
                        </div>
                    </form>
                    &nbsp
                    @can('regimenTributario.destroy')
                    <form method="POST" id="deleteTipoDoc"  action="{{route('regimenTributario.destroy',$regimenTrubutario->id)}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit"  class="btn btn-danger">Eliminar</button>
                    </form>
                        @endcan
                </div>
            </div>
        </div>
    </div>
    @endsection
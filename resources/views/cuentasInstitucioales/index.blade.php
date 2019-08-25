@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('cuentasInstitucionales.create')
                      {{--  <a href="{{route('cuentasInstitucionales.create')}}" class="btn btn-success btn-circle float-right">
                            <i class="fas fa-plus"></i>
                        </a>--}}
                        <a href="{{route('puc.excel')}}" style="margin-right: 8px;" class="btn btn-success btn-circle float-right">
                            <i class="fas fa-file-excel"></i>
                        </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">CUENTAS INSTITUCIONALES</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Código deCuenta</th>
                            <th>Código Superior</th>
                            <th>Nombre de Cuenta</th>
                            <th>Naturaleza de Cuenta</th>
                            <th>Cuenta CoNC</th>
                            <th>Número de Cuenta</th>
                            <th>Tipo de Cuenta Bancaria</th>
                            <th>Situacion de Fondos</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Código deCuenta</th>
                            <th>Código Superior</th>
                            <th>Nombre de Cuenta</th>
                            <th>Naturaleza de Cuenta</th>
                            <th>Cuenta CoNC</th>
                            <th>Número de Cuenta</th>
                            <th>Tipo de Cuenta Bancaria</th>
                            <th>Situacion de Fondos</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($cuenta as $item)
                            <tr>
                                <td>{{$item->codigoCuenta}}</td>
                                <td>{{$item->codigoSuperior}}</td>
                                <td>{{$item->nombreCuenta}}</td>
                                <td>{{$item->naturalezaCuenta}}</td>
                                <td>{{$item->CuentaCoNC}}</td>
                                <td>{{$item->numeroCuenta}}</td>
                                <td>{{$item->tipoCuentaBancaria}}</td>
                                <td>{{$item->situacionFondos}}</td> <td>
                                    @can('cuentasInstitucionales.edit')
                                        <a href="{{route('cuentasInstitucionales.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h1>Cuentas Pedientes</h1>
                    @if($conteo>=1)
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Código deCuenta</th>
                                <th>Código Superior</th>
                                <th>Nombre de Cuenta</th>
                                <th>Naturaleza de Cuenta</th>
                                <th>Cuenta CoNC</th>
                                <th>Número de Cuenta</th>
                                <th>Tipo de Cuenta Bancaria</th>
                                <th>Situacion de Fondos</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Código deCuenta</th>
                                <th>Código Superior</th>
                                <th>Nombre de Cuenta</th>
                                <th>Naturaleza de Cuenta</th>
                                <th>Cuenta CoNC</th>
                                <th>Número de Cuenta</th>
                                <th>Tipo de Cuenta Bancaria</th>
                                <th>Situacion de Fondos</th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($cuentaPendientes as $item)
                                <tr>
                                    <td>{{$item->codigoCuenta}}</td>
                                    <td>{{$item->codigoSuperior}}</td>
                                    <td>{{$item->nombreCuenta}}</td>
                                    <td>{{$item->naturalezaCuenta}}</td>
                                    <td>{{$item->CuentaCoNC}}</td>
                                    <td>{{$item->numeroCuenta}}</td>
                                    <td>{{$item->tipoCuentaBancaria}}</td>
                                    <td>{{$item->situacionFondos}}</td> <td>
                                        @can('cuentasInstitucionales.edit')
                                            <a href="{{route('cuentasInstitucionales.edit',$item->id)}}"><i class="fa fa-edit">COPLETAR</i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-success">
                            <h3>NO TIENES CUENTAS PENDIENTES</h3>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
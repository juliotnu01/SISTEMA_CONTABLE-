@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row"  id="">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">IMPORTAR NIIF</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('niff.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="file" name="excel" class="">
                            <button class="btn btn-success" style="float: right;">Importar Datos</button>
                       <a href="{{route('niff.excel')}}" style="margin-right: 8px;" class="btn btn-success float-right">Gestionar NIIFS
                            <i class="fas fa-download"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               {{-- <a href="{{route('niff.excel')}}" style="margin-right: 8px;" class="btn btn-success btn-circle float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>--}}
                <h6 class="m-0 font-weight-bold text-primary">CUENTAS NIIF</h6>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Código PUC</th>
                        <th>Nombre Cuenta PUC</th>
                        <th>Código NIIF</th>
                        <th>Nombre NIIF</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Código PUC</th>
                        <th>Nombre Cuenta PUC</th>
                        <th>Código NIIF</th>
                        <th>Nombre NIIF</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($niif as $item)
                        <tr>
                            <td>{{$item->puc->codigoCuenta}}</td>
                            <td>{{$item->puc->nombreCuenta}}</td>
                            <td>{{$item->codigoNiff}}</td>
                            <td>{{$item->nombreNiff}}</td>
                            <td>
                                @can('niff.edit')
                                    <a href="{{route('niff.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
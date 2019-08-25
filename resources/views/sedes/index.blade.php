@extends('layouts.plantillaBase')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('sede.create')
                <a href="{{route('sede.create')}}" class="btn btn-success  float-right">
                    <i class="fas fa-plus"></i>
                    <a href="{{route('subSede.index')}}" style="margin-right: 8px;" class="btn btn-success  float-right">
                        <i class="fas fa-business-time">Sub Sede / Centro de Costo</i>
                    <a href="{{route('sede.excel')}}" style="margin-right: 8px;" class="btn btn-success  float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">SEDES / Centro de Costo</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width: 20%">Codigo Centro de Costo</th>
                            <th>Nombre de Centro de Costo</th>
                            <th>Clase Centro de Costo</th>
                            <th>Porrateo</th>
                            <th>Nombre de Grupo Centro de Costo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th style="width: 20%">Codigo Centro de Costo</th>
                            <th>Nombre de Centro de Costo</th>
                            <th>Clase Centro de Costo</th>
                            <th>Porrateo</th>
                            <th>Nombre de Grupo Centro de Costo</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($sedes as $item)
                            <tr>
                                <td style="width: 20%">{{$item->codigoCC}}</td>
                                <td>{{$item->NombreCC}}</td>
                                <td>{{$item->claseCC}}</td>
                                <td>{{$item->prorrateo}}</td>
                                <td>{{$item->nombreGrupoCC}}</td>
                                <td>
                                    @can('sede.edit')
                                        <a href="{{route('sede.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


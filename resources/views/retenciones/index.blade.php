@extends('layouts.plantillaBase')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('retenciones.create')}}" class="btn btn-success" style="float: right;"><i class="fa fa-plus"></i></a>
                <h5 class="m-0 font-weight-bold text-primary">Retenciones</h5>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tipó Retención</th>
                            <th>Concepto</th>
                            <th>Año</th>
                            <th>Base</th>
                            <th>Monto Minimo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($retenciones as $item)
                            <tr>
                                <td>{{$item->tipoRetencion}}</td>
                                <td>{{$item->concepto}}</td>
                                <td>{{$item->anio}}</td>
                                <td>{{$item->base}}</td>
                                <td>{{$item->montoMinimo}}</td>
                                <td>
                                    @can('retenciones.edit')
                                        <a href="{{route('retenciones.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
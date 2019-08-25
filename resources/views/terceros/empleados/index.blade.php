@extends('layouts.plantillaBase')
@section('contenido')
<!-- Page Heading -->
@include('terceros.partes.contadoresTerceros')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('personaEmpleado.create')
                    <a href="{{route('personaEmpleado.create')}}" class="btn btn-success float-right">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{route('personaEmpleado.excel')}}" style="margin-right: 8px;" class="btn btn-success float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">EMPLEADOS</h6>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width: 177px;">Identificación</th>
                            <th style="width: 177px;">Nombre Completo</th>
                            <th style="width: 177px;">Nivel de Empleo</th>
                            <th style="width: 177px;">Empleo</th>
                            <th style="width: 177px;">Designado Supervisor</th>
                            <th style="width: 0px;"></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th style="width: 177px;">Identificación</th>
                            <th style="width: 177px;">Nombre Completo</th>
                            <th style="width: 177px;">Nivel de Empleo</th>
                            <th style="width: 177px;">Empleo</th>
                            <th style="width: 177px;">Designado Supervisor</th>
                            <th style="width: 0px;"></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($perEmpleados as $item)
                            <tr>
                                <td>{{$item->numeroDocumento}}</td>
                                <td>{{$item->nombre1.' '.$item->nombre2.' '.$item->apellido. ' '. $item->apellido2}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->nombreEmpleo}}</td>
                                <td>{{$item->designadoSupervisor}}</td>
                                <td>
                                    {{--@can('personaEmpleado.show')--}}
                                        {{--<a href="{{route('personaEmpleado.show',$item->id)}}"><i class="fa fa-eye"></i></a>--}}
                                    {{--@endcan--}}
                                    @can('personaEmpleado.edit')
                                        <a href="{{route('personaEmpleado.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
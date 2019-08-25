@extends('layouts.plantillaBase')
@section('contenido')
<!-- Page Heading -->
@include('terceros.partes.contadoresTerceros')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('personaNarutal.create')
                <a href="{{route('personaNarutal.create')}}" class="btn btn-success float-right">
                    <i class="fas fa-plus"></i>
                    <a href="{{route('personaNarutal.excel')}}" style="margin-right: 8px;" class="btn btn-success float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">PERSONAS NATURALES</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th >Número de identificación</th>
                            <th>Nombres y Apellidos</th>
                            <th>Dirección</th>
                            <th>Regimen Simple</th>
                            <th>Responsable IVA</th>
                            <th>Número de Cuenta</th>
                            <th>Teléfono/Celular</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Número de identificación</th>
                            <th>Nombres y Apellidos</th>
                            <th>Dirección</th>
                            <th>Responsable IVA</th>
                            <th>Regimen Simple</th>
                            <th>Número de Cuenta</th>
                            <th>Teléfono/Celular</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($personasNaturales as $item)
                            <tr>
                                <td >{{$item->natural->numeroDocumento}}</td>
                                <td>{{$item->nombre1.' '.$item->nombre2.' '.$item->apellido. ' '. $item->apellido2}}</td>
                                <td>{{$item->direccion}}</td>
                                <td>{{$item->responsableIVA}}</td>
                                <td>{{$item->regimenSimple}}</td>
                                <td>{{$item->natural->numeroCuenta}}</td>
                                <td>{{$item->telefono .' / '. $item->celular}}</td>
                                <td>{{$item->correo}}</td>
                                <td>
                                    {{--@can('personaNarutal.show')--}}
                                        {{--<a href="{{route('personaNarutal.show',$item->id)}}"><i class="fa fa-eye"></i></a>--}}
                                    {{--@endcan--}}
                                    @can('personaNarutal.edit')
                                        <a href="{{route('personaNarutal.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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


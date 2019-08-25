@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('dependecias.create')
                        <a href="{{route('dependecias.create')}}" class="btn btn-success btn-circle float-right">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">Dependecias</h6>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Número</th>
                            <th>Código</th>
                            <th>Nombre Completo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Número</th>
                            <th>Código</th>
                            <th>Nombre Completo</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($dependecias as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>
                                     @can('dependecias.index')
                                        <a href="{{route('dependecias.show',$item->id)}}"><i class="fa fa-eye"></i></a>
                                     @endcan
                                     @can('dependecias.index')
                                        <a href="{{route('dependecias.edit',$item->id)}}"><i class="fa fa-edit"></i><a>
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
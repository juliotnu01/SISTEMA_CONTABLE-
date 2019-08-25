@extends('layouts.plantillaBase')
@section('contenido')
<!-- Page Heading -->
{{--@include('terceros.partes.contadoresTerceros')--}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('consorciados.create')
                <a href="{{route('consorciados.create')}}" class="btn btn-success btn-circle float-right">
                    <i class="fas fa-plus"></i>
                </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">CONSORCIADOS Y UNIONES TEMP</h6>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>NIT</th>
                            <th>Porcentaje</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Razón Social</th>
                            <th>NIT</th>
                            <th>Porcentaje</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($consorciados as $key => $item)
                            <tr>
                                <td>{{$item->raz_social}}</td>
                                <td>{{$item->nit}}</td>
                                <td>{{$item->consorcios()->pluck('porcentaje')->implode(' / ')}}</td>
                                <td>
                                    {{--@can('personaNarutal.show')--}}
                                    {{--<a href="{{route('personaNarutal.show',$item->id)}}"><i class="fa fa-eye"></i></a>--}}
                                    {{--@endcan--}}
                                    @can('consorciados.edit')
                                        <a href="{{route('consorciados.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
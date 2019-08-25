@extends('layouts.plantillaBase')
@section('contenido')
<!-- Page Heading -->
@include('terceros.partes.contadoresTerceros')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('personaJuridica.create')
                <a href="{{route('personaJuridica.create')}}" class="btn btn-success  float-right">
                    <i class="fas fa-plus"></i>
                </a>
                    <a href="{{route('personaJuridica.excel')}}" style="margin-right: 8px;" class="btn btn-success float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">PERSONAS JURIDICAS</h6>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <br>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="width: 10%;">NIT</th>
                            <th style="width: 20%;">Razón Social</th>
                            <th style="width: 20%;">Régimen Tributario</th>
                            <th style="width: 20%;">Banco</th>
                            <th style="width: 20%;">Representante Legal</th>
                            <th style="width: 20%;">responsable IVA</th>
                            <th style="width: 20%;">Número Bancaria</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th style="width: 10%;">NIT</th>
                            <th style="width: 20%;">Razón Social</th>
                            <th style="width: 20%;">Régimen Tributario</th>
                            <th style="width: 20%;">Banco</th>
                            <th style="width: 20%;">Representante Legal</th>
                            <th style="width: 20%;">responsable IVA</th>
                            <th style="width: 20%;">Número Bancaria</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($personaJuridica as $item)
                            <tr>
                                <td style="width: 10%;">{{$item->nit}}</td>
                                <td style="width: 10%;">{{$item->raz_social}}</td>
                                <td style="width: 10%;">{{$item->nombre}}</td>
                                <td style="width: 10%;">{{$item->banco}}</td>
                                <td>{{$item->nombre1.' '.$item->nombre2.' '.$item->apellido. ' '. $item->apellido2}}</td>
                                <td style="width: 10%;">{{$item->responsableIVA}}</td>
                                <td style="width: 10%;">{{$item->numeroCuenta}}</td>
                                <td>
                                    {{--@can('personaJuridica.show')--}}
                                    {{--<a href="{{route('personaJuridica.show',$item->id)}}"><i class="fa fa-eye"></i></a>--}}
                                    {{--@endcan--}}
                                    @can('personaJuridica.edit')
                                        <a href="{{route('personaJuridica.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
@extends('layouts.plantillaBase')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('transaccion.create')}}" class="btn btn-success" style="float: right;"><i class="fa fa-plus"></i></a>
                {{--<a href="{{route('transaccion.listaPlantillas')}}" class="btn btn-success" style="float: right;margin-right: 5px;">Plantillas<i class="fa fa-paperclip"></i></a>--}}
                <h5 class="m-0 font-weight-bold text-primary">Transacciones</h5>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            &nbsp
            <div class="container-fluid">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header bg-primary" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link " style="color: #fff" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Transacciónes Completas
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableSelect" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Numero Doc</th>
                                            <th>Fecha</th>
                                            <th>Tercero</th>
                                            <th>Soporte</th>
                                            <th>Tipo Presupuesto</th>
                                            <th>Valor de la Transacción</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Numero Doc</th>
                                            <th>Fecha</th>
                                            <th>Tercero</th>
                                            <th>Soporte</th>
                                            <th>Tipo Presupuesto</th>
                                            <th>Valor de la Transacción</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($trasacciones as $item)
                                            <tr>
                                                <td>{{$item->numeroDoc}}</td>
                                                <td>{{$item->anio.'/'.$item->mes.'/'.$item->dia}}</td>
                                                <td>{{$item->nombre1.' '.$item->nombre2.' '.$item->apellido.' '.$item->apellido2}}</td>
                                                <td>{{$item->nombreSoporte}}</td>
                                                <td>{{$item->nombrePresupuesto}}</td>
                                                <td>{{$item->valortransaccion }}</td>
                                                <td>
                                                    @can('transaccion.edit')
                                                        <a  title="EDITAR" href="{{route('transaccion.edit',$item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('transaccion.duplicate')
                                                        <a  title="DUPLICAR" href="{{route('transaccion.duplicate',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-clone"></i></a>

                                                    @endcan
                                                </td>
                                                <td>
                                                    <a  title="IMPRIMIR" href="{{route('transaccion.printTrans',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                                                </td>
                                                <td>
                                                    @can('transaccion.destroy')

                                                        <form method="POST" id="deleteRetencion"
                                                              action="{{route('transaccion.destroy',$item->id)}}">
                                                            {{method_field('DELETE')}}
                                                            {{csrf_field()}}
                                                            <button  title="ELIMINAR" type="submit"  onclick="return confirm('¿Esta seguro de eliminar este registro?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
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
                    <div class="card">
                        <div class="card-header" style="background-color: #28a745b0 !important;" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link  collapsed" style="color: #000" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Transacciónes por Completar
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th style="width: 100px">Numero Doc</th>
                                            <th style="width: 15%;">Fecha</th>
                                            <th style="width: 80px">Base</th>
                                            <th style="width: 10px"></th>
                                            <th style="width: 10px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trasaccionesFaltan as $item)
                                            <tr>
                                                <td style="width: 100px">{{$item->numeroDoc}}</td>
                                                <td style="width: 15%;">{{$item->anio.'/'.$item->mes.'/'.$item->dia}}</td>
                                                <td style="width: 80px">{{$item->valorBase}}</td>
                                                <td style="width: 10px">
                                                    @can('transaccion.edit')
                                                        <a href="{{route('transaccion.edit',$item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    @endcan
                                                </td>
                                                <td style="width: 10px">
                                                    @can('transaccion.destroy')
                                                        <form method="POST" id="deleteRetencion"
                                                              action="{{route('transaccion.destroy',$item->id)}}">
                                                            {{method_field('DELETE')}}
                                                            {{csrf_field()}}
                                                            <button type="submit"  onclick="return confirm('¿Esta seguro de eliminar este registro?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
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
                    <div class="card">
                        <div class="card-header bg-primary" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link  collapsed" style="color: #fff" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Plantillas
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered display dataTable_width_auto" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Numero Doc</th>
                                            <th style="width: 15%;">Fecha</th>
                                            <th style="width: 20%;">Tercero</th>
                                            <th>Soporte</th>
                                            <th>Tipo Presupuesto</th>
                                            <th>Base</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trasaccionesPlantilla as $item)
                                            <tr>
                                                <td>{{$item->numeroDoc}}</td>
                                                <td style="width: 15%;">{{$item->anio.'/'.$item->mes.'/'.$item->dia}}</td>
                                                <td style="width: 20%;">{{$item->nombre1.' '.$item->nombre2.' '.$item->apellido.' '.$item->apellido2}}</td>
                                                <td>{{$item->nombreSoporte}}</td>
                                                <td>{{$item->nombrePresupuesto}}</td>
                                                <td>{{$item->valorBase}}</td>
                                                <td>
                                                    @can('transaccion.edit')
                                                        <a href="{{route('transaccion.editPlantilla',$item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('transaccion.duplicate')
                                                        <a href="{{route('transaccion.duplicate',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-clone"></i></a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('transaccion.destroy')
                                                        <form method="POST" id="deleteRetencion"
                                                              action="{{route('transaccion.destroy',$item->id)}}">
                                                            {{method_field('DELETE')}}
                                                            {{csrf_field()}}
                                                            <button type="submit"  onclick="return confirm('¿Esta seguro de eliminar este registro?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
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
                &nbsp
            </div>
            &nbsp
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
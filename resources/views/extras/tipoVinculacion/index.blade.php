@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('tipoVinculacion.create')
                    <a class="btn btn-success btn-circle float-right" href="#crear"  data-toggle="modal">
                        <i class="fas fa-plus "></i>
                    </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">TIPO VINCULACIÓN</h6>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                @can('tipoVinculacion.edit')
                                <th></th>
                                    @endcan
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Nombre</th>
                                @can('tipoVinculacion.edit')
                                <th></th>
                                    @endcan
                            </tr>
                            </tfoot>
                            <tbody id="datos">
                            @foreach($tipoVinculacion  as $item)
                                <tr>
                                    <td>{{$item->nombreVinculacion}}</td>
                                    @can('tipoVinculacion.edit')
                                    <td>
                                        <a href="{{route('tipoVinculacion.edit',$item->id)}}" class="">
                                            <i class="fa fa-edit" aria-hidden="true"></i> </a>
                                    </td>
                                        @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade odal-open" id="crear" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AGREGAR TIPO DE VINCULACION</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post" id="crearTipoVincula" name="crearTipoVincula">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-user"  id="nombreVinculacion" name="nombreVinculacion"  placeholder="NOMBRE...">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="crearTipoVinculacion()"> <i class="fa fa-check"></i> Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--EDITAR
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Actualizar Genero</h4>
          </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="editDoc" name="editDoc">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-user" id="codigo" name="codigo"  placeholder="CODIGO...">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-user"  id="nombre" name="nombre"  placeholder="NOMBRE...">
                        </div>
                        <input type="hidden" id="id">

                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
           </div>
        </div>
      </div>
    </div>--}}
@endsection()
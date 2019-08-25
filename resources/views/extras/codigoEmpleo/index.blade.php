@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('codigoEmpleo.create')
                    <a class="btn btn-success btn-circle float-right" href="#crear"  data-toggle="modal">
                        <i class="fas fa-plus "></i>
                    </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">CODIGO EMPLEO</h6>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                @can('codigoEmpleo.edit')
                                <th>Acciones</th>
                                    @endcan
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                @can('codigoEmpleo.edit')
                                <th>Acciones</th>
                                    @endcan
                            </tr>
                            </tfoot>
                            <tbody id="datos">
                            @foreach($codEmpleo  as $item)
                                <tr>
                                    <td>{{$item->codigo}}</td>
                                    <td>{{$item->nombreEmpleo}}</td>
                                    @can('codigoEmpleo.edit')
                                    <td>
                                        <a href="{{route('codigoEmpleo.edit',$item->id)}}" class="">
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
    <div class="modal fade modal-open" id="crear" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AGREGAR CODIGO EMPLEO</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post" id="crearCodigoEmpleo" name="crearCodigoEmpleo">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-user"  id="codigo" name="codigo"  placeholder="CODIGO...">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-user"  id="nombreEmpleo" name="nombreEmpleo"  placeholder="NOMBRE...">
                            </div>
                        </div>
                        &nbsp
                        <div class="row">
                            <div class="col-md-12">
                                <select  name= "id_nivelEmpleo" id="id_nivelEmpleo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                    <option value="">[Nivel de Empleo]</option>
                                    @foreach($nivelEmpleo as $nivel)
                                        <option value="{{$nivel->id}}" {{ old('descritores_id') == $nivel->id ? 'selected' : '' }}>{{$nivel->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="crearCodigoEmpleos()"> <i class="fa fa-check"></i> Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
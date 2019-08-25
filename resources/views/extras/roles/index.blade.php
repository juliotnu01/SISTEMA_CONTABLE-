@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('roles.create')
                <a class="btn btn-success btn-circle float-right" href="{{route('roles.create')}}">
                    <i class="fas fa-plus "></i>
                </a>
                @endcan
                <h6 class="m-0 font-weight-bold text-primary">ROLES </h6>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>URL Amigable</th>
                            @can('roles.edit')
                                <th></th>
                            @endcan
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>URL Amigable</th>
                            @can('roles.edit')
                                <th></th>
                            @endcan
                        </tr>
                        </tfoot>
                        <tbody id="datos">
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->slug }}</td>
                                @can('roles.edit')
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                    class="btn btn-sm btn-default">
                                        <i
                                                class="fa fa-edit" aria-hidden="true"></i></a>
                                    </a>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>

@endsection
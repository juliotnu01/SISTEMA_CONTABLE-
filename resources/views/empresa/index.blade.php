@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('empresa.create')
                        <a href="{{route('empresa.create')}}" class="btn btn-success btn-circle float-right">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">MI EMPRESA</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($empresa as $item)
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row  align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$item->nombre}}</h6>
                        <div class="dropdown no-arrow">

                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body border-left-primary ">
                        <p>{{$item->lema}}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Datos de la empresa</h6>
                        @can('empresa.edit')
                            <a href="{{route('empresa.edit',$item->id)}}" class="  float-right">
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                    </div>
                    <!-- Card Body -->
                    <div class="card-body border-left-success ">
                        <ul>
                            <li>Dirección: {{$item->direccion}}</li>
                            <li>Teléfono: {{$item->telefono}}</li>
                            <li>Correo Electrónico: {{$item->correo}}</li>
                            <li>Pagina WEB: <a href="{{$item->url}}" target="_blank">{{$item->url}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body border-bottom-info ">

                    <div class="text-center">
                        {{--<p>Logo de la República</p>--}}
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{asset('images/'.$item->logo_republica)}}" alt="">
                        {{--<p>Logo del Municipio</p>--}}
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{asset('images/'.$item->logo_municipio)}}" alt="">
                        {{--<p>Logo de Plan de Desarrollo</p>--}}
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{asset('images/'.$item->logo_plandesarrollo)}}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endforeach
@endsection
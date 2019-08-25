@extends('layouts.plantillaBase')
@section('contenido')
<div class="row"  id="">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">IMPORTAR PUC</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('puc.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="file" name="excel" class="">
                        <button class="btn btn-success" style="float: right;">Importar Datos</button>
                    <a href="{{route('puc.plantilla')}}" style="margin-right: 8px;" class="btn btn-success  float-right">
                        <i class="fas fa-download"></i>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{route('puc.excel')}}" style="margin-right: 8px;" class="btn btn-success btn-circle float-right">
                        <i class="fas fa-file-excel"></i>
                    </a>
                <h6 class="m-0 font-weight-bold text-primary">PLAN UNICO DE CUENTAS</h6>
            </div>
            @if (Session::has('email'))
                <div class="alert alert-danger">{{ Session::get('email') }}</div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card-body">
                <busca-cuenta></busca-cuenta>
                <br>
                @foreach($puc as $itemCuenta)
                    <puc
                        :cuenta="{{$itemCuenta->toJson()}}"
                        :edit="{{auth()->user()->can('puc.edit')}}"
                        :create="{{auth()->user()->can('puc.create')}}">
                    </puc>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@endsection
@extends('layouts.plantillaBase')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    @can('users.create')
                    <a class="btn btn-success btn-circle float-right" href="{{route('users.create')}}" >
                        <i class="fas fa-plus "></i>
                    </a>
                    @endcan
                    <h6 class="m-0 font-weight-bold text-primary">USUARIOS</h6>
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Correo</th>
                            @can('users.edit')
                            <th></th>
                                @endcan
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Identificador</th>
                            <th>Correo</th>
                            @can('users.edit')
                            <th></th>
                                @endcan
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->email}}</td>
                                @can('users.edit')
                                <td>
                                    <a href="{{route('users.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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

@endsection
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script
<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script !src="">
    $(document).ready(function() {
        $("input[type=radio]").click(function(event){
            var valor = $(event.target).val();
            if(valor =="1"){
                $("#perNaturales").hide();
                $("#perEmpleado").show();
                $("#datosExtras").show();
            } else if (valor == "2") {
                $("#perNaturales").show();
                $("#perEmpleado").hide();
                $("#datosExtras").show();
            } else {
                // Otra cosa
            }
        });
    });


</script>
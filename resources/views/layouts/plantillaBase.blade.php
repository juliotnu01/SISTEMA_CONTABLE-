<!DOCTYPE html>
<html lang="en">
@routes
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Contable SOIN</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/smoke.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style>
        label.error { float: none; color: red; padding-left: .5em; vertical-align: middle; font-size: 16px; width: 100% }

        #empresa:hover{
            color: #4d72de;
        }
    </style>
  {{--  <style>
        #accordionSidebar1{
            background-color: #4e73de;
            height: 700px;
            width: 280px;
            overflow-y: scroll;
        }

        @media (max-width: 700px) {
            #accordionSidebar1{
                background-color: #4e73de;
                height: 700px;
                width: 200px;
            }
            .submenu{
                position: fixed;
            }
        }


    </style>--}}

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <div id="accordionSidebar1">
    <ul style="height: 100%;" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('empresa.index')}}">
            <div class="sidebar-brand-icon">
                <?php $imageneEmpresa= \Illuminate\Support\Facades\DB::table('empresas')->select('logo_plandesarrollo')->first(); ?>
                {{--{{dd($imageneEmpresa)}}--}}
                <img src="{{asset('images/'.$imageneEmpresa->logo_plandesarrollo)}}" class="img-circle" style="width: 80%; margin-top: 44px;" alt="">
            </div>
        </a>
        &nbsp
        &nbsp
        <!-- Divider -->
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        {{--@can('personaNarutal.index')--}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTerceros" aria-expanded="true" aria-controls="collapseTerceros">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Terceros y Dependenciass</span>
            </a>
            <div  id="collapseTerceros" class="collapse" aria-labelledby="collapseTerceros" data-parent="#accordionSidebar">
                <div  class="bg-white py-2 collapse-inner rounded submenu">
                    @can('personaNarutal.index')
                    <a class="collapse-item" href="{{route('personaNarutal.index')}}">Personas Naturales</a>
                    @endcan
                    @can('personaJuridica.index')
                    <a class="collapse-item" href="{{route('personaJuridica.index')}}">Personas Jurídicas</a>
                    @endcan
                    @can('personaEmpleado.index')
                    <a class="collapse-item" href="{{route('personaEmpleado.index')}}">Empleados</a>
                    @endcan
                    @can('consorciados.index')
                    <a class="collapse-item" href="{{route('consorciados.index')}}">Consorciados y Uniones</a>
                    @endcan
                    @can('dependecias.index')
                        <a class="collapse-item" href="{{route('dependecias.index')}}">Dependencias</a>
                    @endcan
                </div>
            </div>
        </li>
        <!-- Nav Item - Tables -->
        @can('users.index')
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Usuarios</span></a>
        </li>
        @endcan
        {{--@can('tipoDocumento.index')--}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiess" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Configuraciones extras</span>
            </a>
            <div id="collapseUtilitiess" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded submenu">
                    <h6 class="collapse-header">Extras:</h6>
                    @can('tipoDocumento.index')
                    <a class="collapse-item" href="{{route('tipoDocumento.index')}}">Tipos de Documento</a>
                    @endcan
                    @can('clasePersona.index')
                    <a class="collapse-item" href="{{route('clasePersona.index')}}">Clase de Persona</a>
                    @endcan
                    @can('codigoEmpleo.index')
                    <a class="collapse-item" href="{{route('codigoEmpleo.index')}}">Códigos de Empleos</a>
                    @endcan
                    @can('nivelEmpleo.index')
                    <a class="collapse-item" href="{{route('nivelEmpleo.index')}}">Niveles de Empleo</a>
                    @endcan
                    @can('regimenTributario.index')
                    <a class="collapse-item" href="{{route('regimenTributario.index')}}">Régimen Tributario</a>
                    @endcan
                    @can('tipoVinculacion.index')
                    <a class="collapse-item" href="{{route('tipoVinculacion.index')}}">Tipo de Vinculación</a>
                    @endcan
                    @can('unidadEjecutar.index')
                    <a class="collapse-item" href="{{route('unidadEjecutar.index')}}">Unidad Ejecutorá</a>
                    @endcan
                    @can('bienes.index')
                    <a class="collapse-item" href="{{route('bienes.index')}}">Bienes y Servicios</a>
                    @endcan
                    @can('roles.index')
                    <a class="collapse-item" href="{{route('roles.index')}}">Roles y Permisos</a>
                    @endcan
                    {{--<a class="collapse-item" href="{{route('codigo.index')}}">Codigo RetencionesDescuentos</a>--}}

                </div>
            </div>
        </li>
            {{--@endcan--}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepuc" aria-expanded="true" aria-controls="collapsepuc">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Contabilidad</span>
            </a>
            <div id="collapsepuc" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded submenu">
                    {{--@can('tipoDocumento.index')--}}
                    <a class="collapse-item" href="{{route('transaccion.index')}}">Transacciónes</a>
                    <a class="collapse-item" href="{{route('puc.index')}}">Catalogo de Cuentas</a>
                    <a class="collapse-item" href="{{route('cuentasInstitucionales.index')}}">Cuentas Institucionales</a>
                    <a class="collapse-item" href="{{route('sede.index')}}">Centro de Costo</a>
                    <a class="collapse-item" href="{{route('niff.index')}}">Catalogo de Cuentas NIIF</a>
                    <a class="collapse-item" href="{{route('retenciones.index')}}">Configurar Retenciones</a>
                    <a class="collapse-item" href="{{route('descuentos.index')}}">Configurar Descuentos</a>
                    <a class="collapse-item" href="{{route('panel.index')}}">Soporte Contable</a>
                        <a class="collapse-item" href="{{route('cierres.index')}}">Configurar Cierre Anual</a>
                    {{--@endcan--}}
                </div>
            </div>
        </li>
       {{-- <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestión del Gasto</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Manejo de Tesorería y Gastos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Metas Plan de Desarrollo</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Facturación y Cartera</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestión de Ingresos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Manejo de Tesorería Recaudos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestión de Activos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestión de Contratación</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestión Contable</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-table"></i>
                <span>Reportes</span></a>
        </li>--}}
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
    </div>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <?php $nombreEmpresa= \Illuminate\Support\Facades\DB::table('empresas')->select('nombre')->first(); ?>
                <a href="{{route('empresa.index')}}"> <h3>{{$nombreEmpresa->nombre}}</h3></a>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->

                    </li>

                    <h3 style="margin-top: 13px;" id="empresa">BIENVENIDO A COTA_XL</h3>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="color: #1b1e21" class=""> {{ auth()->user()->email }}</span>
                            {{--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">--}}
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesion
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid" id="app" >

                @yield('contenido')

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="footer text-center" style="position: relative !important;">
            <span class="copy-1">Desarrollador con todo el</span>
            <img src="{{asset('images/heart.png')}}" class="heart-copy">
            <span class="copy-2">
            por <a href="#" target="_blank" style="color: #000 !important;">Soliciones Integrales</a>
        </span>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/funciones.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('js/lang/es.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<script src="{{asset('select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>



<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


</body>

</html>

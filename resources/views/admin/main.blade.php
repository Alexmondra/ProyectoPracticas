<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema - Plantilla</title>
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <link rel="icon" type="image/png" href="dist/img/favicon.ico">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->

  <link rel="stylesheet" href="{{asset('assets/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
  <style>
    .sidebar-dark-blue {
      background: #2b91bd !important;
    }
  </style>
  <!--Estilos -->
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link"><i class="nav-icon fas fa-th text-success"></i> Escritorio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fas fa-cart-plus text-blue"></i> POS</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            {{-- <i class="fa fa-user text-warning"></i> {{ Auth::user()->name }} --}}
          </a>
          {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                
                <a href="route('logout')" class="dropdown-item dropdown-footer" 
                onclick="event.preventDefault();this.closest('form').submit();">
                <i class="mr-2 fas fa-sign-out-alt text-danger"></i> Cerrar sesión</a>
            </form>
          </div> --}}
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-square elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">HECAB</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li id="liConductors" class="nav-item">
              <a id="aConductors" href="/" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Control Facturas
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="liVenta" href="/venta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ventas</p>
                  </a>
                </li>
                </li>
              </ul>
            <label for="" class="nav-icon">CONTROL DE PRODUCTOS</label>
            <li id="reControl" class="nav-item">
              <a id="reControl" href="" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  Gestion de productos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="liConductor" href="/producto" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>productos</p>
                  </a>
                </li>

              </ul>
            </li>
            {{-- Control de transporte --}}
            <li id="reControl" class="nav-item">
              <a id="reControl" href="" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  Control de rutas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="liReporte" href="/reporte-ruta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>reporte</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a id="liViaticos" href="/viaticos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Viaticos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a id="liCombustible" href="/combustible" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Combustible</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a id="liRutas" href="/rutas" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ruta</p>
                  </a>
                </li>
              </ul>
            </li>

            {{-- Registro de transporte --}}
            <label for="" class="nav-icon">REGISTRO TRANSPORTE</label>
            <li id="reControl" class="nav-item">
              <a id="reControl" href="" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  Registro de Datos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="liConductor" href="/conductor" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conductor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a id="liCamion" href="/camion" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trailer</p>
                  </a>
                </li>
              </ul>
            </li>
            <li id="liSeguridad" class="nav-item">
              <a id="aSeguridad" href="#" class="nav-link">
                <i class="fas fa-users-cog"></i>
                <p>
                  Seguridad
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="liUsuario" href="/usuarios" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <p>
                  Acerca de
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">

      </div>

      <!-- /.content-header -->
      @yield('contenido') 
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Plantilla</h5>
        <p>Desarrollado por ...</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2024 <a href="https:incanatoit.com">USS</a>.</strong> Derechos reservados.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!--Scripts -->
  <!-- jQuery -->
  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/js/adminlte.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>}
  <!-- Agregar estilos y scripts de Select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  
  @stack('scripts')
  <!-- scripts de cada plantilla -->
  <!--Fin Scripts -->
</body>

</html>
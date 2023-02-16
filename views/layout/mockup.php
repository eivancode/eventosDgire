<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de eventos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url ?>adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url ?>adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- CABECERA -->
    <header>
        <div class="row banner">
            <div class="col-2 col-lg-1 col-md-1 col-sm-2 col-xs-2">
                <a href="https://www.unam.mx/" target=_BLANK>
                    <img class="" src="<?= base_url ?>assets/img/logo-unam.png" id="imgUnam" alt="">
                </a>
            </div>
            <div class="col-4 col-lg-5 col-md-5 col-sm-4 col-xs-4">
                <a href="https://www.unam.mx/" style="text-decoration:none;" target=_BLANK>
                    <h4 class="hidden-sm hidden-xs" id="txtUnam" style="color:white;">Universidad Nacional Autónoma de México</h4>
                    <h4 class="hidden-md hidden-lg" id="txtUnam" style="color:white;">UNAM</h4>
                </a>
            </div>
            <div class="col-4 col-lg-5 col-md-5 col-sm-4 col-xs-4">
                <a href="https://www.dgire.unam.mx/webdgire/" style="text-decoration:none;" target=_BLANK>
                    <h4 class="hidden-sm hidden-xs" id="txtDgire" style="color:white;">Dirección General de Incorporación y Revalidación de Estudios</h4>
                    <h4 class="hidden-md hidden-lg" id="txtDgire" style="color:white;">DGIRE</h4>
                </a>
            </div>
            <div class="col-2 col-lg-1 col-md-1 col-sm-2 col-xs-2">
                <a href="https://www.dgire.unam.mx/webdgire/" target="_BLANK">
                    <img class="" src="<?= base_url ?>assets/img/logo-dgire.png" id="imgDgire" alt="">
                </a>
            </div>
        </div>
        <div class="row bannerPagos">
            <div class="col-12 col-lg col-md-12 col-sm-12 col-xs-12 txtPagos">
                <p>Sistema de control de eventos</p>
            </div>
        </div>
    </header>
    <!-- FIN CABECERA -->

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url ?>adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <!--AQUI EMPIEZO -->
                        <li class="nav-item">
                            <a href="<?= base_url ?>usuario/index"" class=" nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendario
                                </p>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url ?>usuario/index" class="nav-link">
                                    <i class="fas fa-fw fa-file"></i>
                                    <p>
                                        Solicitudes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url ?>usuario/registro" class="nav-link">
                                    <i class="fas fa-fw fa-user"></i>
                                    <p>
                                        Usuarios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url ?>usuario/index" class="nav-link">
                                    <i class="fas fa-fw fa-building "></i>
                                    <p>
                                        Aulas
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a href="<?= base_url ?>usuario/logout"" class=" nav-link">
                                <i class="fas fa-fw fa-power-off"></i>
                                <p>
                                    Salir
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Starter Page</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">


                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
                            
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="<?= base_url ?>adminlte/plugins/jquery/jquery.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url ?>adminlte/dist/js/adminlte.js"></script>

    <!-- App -->
    <script src="<?= base_url ?>bootstrap/bootstrap.js"></script>

    <!-- <script src="<?= base_url ?>plugins/jquery/jquery-3.6.1.min.js"></script> -->
    <script src="<?= base_url ?>js/app.js"></script>
    <script src="<?= base_url ?>js/usuario.js"></script>
    
    <!-- Plugins -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</html>
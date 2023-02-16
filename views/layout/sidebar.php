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
            <!-- Brand Logo 
            <a href="" class="brand-link">
                <img src="<?= base_url ?>assets/img/logo-dgire.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">EVENTOS DGIRE</span>
            </a>-->

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Sidebar items -->
                        <li class="nav-item">
                            <a href="<?= base_url ?>evento/index" class="nav-link">
                                <i class="far fa-calendar-alt"></i>
                                <p>
                                    Eventos
                                </p>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url ?>solicitud/index" class="nav-link">
                                    <i class="fas fa-file"></i>
                                    <p>
                                        Solicitudes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url ?>usuario/index" class="nav-link">
                                    <i class="fas fa-user"></i>
                                    <p>
                                        Usuarios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url ?>aula/index" class="nav-link">
                                    <i class="fas fa-building "></i>
                                    <p>
                                        Aulas
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a href="<?= base_url ?>usuario/logout"" class=" nav-link">
                                <i class="fas fa-sign-out-alt"></i>
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
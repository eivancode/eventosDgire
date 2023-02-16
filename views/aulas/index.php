<link rel="stylesheet" href="<?= base_url ?>assets/css/adminlte.min.css">
<?php include_once "views/layout/header.php" ?>
<?php include_once('views/layout/sidebar.php') ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<?php if (isset($_SESSION['admin'])) : ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-success mt-3 mb-3" id="nuevo"><i class="fa fa-plus"></i> Agregar</button>
                        <table id="tablaAulas" class="table table-striped">
                            <thead style="background-color: #191970">
                                <tr>
                                    <th style="color: #fff;">ID</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <!-- Crear -->
            <div class="modal fade" id="aulaModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear aula</h5>
                        </div>
                        <div class="modal-body">
                            <form id="aulaForm">
                                <div class="mb-3 row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nombre" id="nombre">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" id="btnAgregar">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Editar -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar usuario</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <form id="editForm">
                                <div class="mb-3 row">
                                    <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nombre" id="editNombre">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" id="btnActualizar">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php elseif (isset($_SESSION['user'])) : ?>
    <?= header("Location:" . base_url . "evento/index"); ?>
    <?php else : ?>h
    <?= header("Location:" . base_url); ?>
<?php endif ?>

<?php include_once('views/layout/footer.php') ?>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url ?>js/aulas.js"></script>
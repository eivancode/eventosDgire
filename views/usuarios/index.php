<link rel="stylesheet" href="<?= base_url ?>assets/css/adminlte.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<?php include_once "views/layout/header.php" ?>
<?php include_once('views/layout/sidebar.php') ?>
<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) : ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-success mt-3 mb-3" id="nuevo"><i class="fa fa-user-plus"></i> Nuevo</button>
                        <table id="tablaUsuarios" class="table table-striped">
                            <thead style="background-color: #191970">
                                <tr>
                                    <th style="color: #fff;">ID</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Usuario</th>
                                    <th style="color: #fff;">E-mail</th>
                                    <th style="color: #fff;">Rol</th>
                                    <th style="color: #fff;">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Crear -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear usuario</h5>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="mb-3 row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <span class="form-error" id="nombre-error"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="usuario" id="usuario">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="rol" id="rol">
                                    <option disabled selected>Seleccione una opción</option>
                                    <?php foreach ($roles as $rol) : ?>
                                        <option value="<?= $rol['idRol'] ?>"><?= $rol['rol'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnAgregar">Agregar</button>
                </div>
                </form>
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
                        <div class="mb-3 row">
                            <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="usuario" id="editUsuario">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="editEmail">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="editPassword">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="rol" id="editRol">
                                    <?php foreach ($roles as $rol) : ?>
                                        <option value="<?= $rol['idRol'] ?>"><?= $rol['rol'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success" id="btnActualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

<?php elseif (isset($_SESSION['user'])) : ?>
    <?= header("Location:" . base_url . "evento/index"); ?>
    <?php else : ?>h
    <?= header("Location:" . base_url); ?>
<?php endif ?>

<?php include_once('views/layout/footer.php') ?>
<script src="<?= base_url ?>js/usuario.js"></script>
<script src="<?= base_url ?>plugins/jquery/jquery_validate.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
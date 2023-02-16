<?php include_once "views/layout/header.php" ?>
<?php include_once('views/layout/sidebar.php') ?>
<link rel="stylesheet" href="<?= base_url ?>assets/css/adminlte.min.css">
<link rel="stylesheet" href="<?= base_url ?>assets/css/timepicker.css">
<link rel="stylesheet" href="<?= base_url ?>assets/css/calendario.css">
<link rel="stylesheet" href="<?= base_url ?>plugins/fullcalendar/main.min.css">

<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) : ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div id='calendar'></div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!--CREAR-->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agendar evento</h5>
                </div>
                <div class="modal-body">
                    <input type="" name="fcInicio" id="fcInicio">
                    <input type="" name="fcFin" id="fcFin">
                    <form id="formEvent">
                        <div class="mb-2">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input class="form-control" type="text" name="titulo" id="titulo">
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="hrInicio">Hora de inicio</label>
                                <input class="timepicker" name="hrInicio" id="hrInicio" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="hrFin">Hora de término</label>
                                <input class="timepicker" name="hrFin" id="hrFin" readonly>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="aula" class="col-sm-2">Aula</label>
                            <select class="form-control" name="aula" id="aula">
                                <option disabled selected>Seleccione una opción</option>
                                <?php foreach ($aulas as $aula) : ?>
                                    <option value="<?= $aula['idAula'] ?>"><?= $aula['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="numAsistentes" class="form-label">Número de asistentes</label>
                            <input class="form-control" type="text" name="numAsistentes" id="numAsistentes">
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="2"></textarea>
                        </div>
                        <label for="" class="form-label">Seleccionar color</label>
                        <div class="mb-2" id="groupColor">
                            <input type="radio" name="color" id="blue" value="#62a0ea">
                            <label for="blue" class="circle" style="background-color: #62a0ea;"></label>
                            <input type="radio" name="color" id="green" value="#2ec27e">
                            <label for="green" class="circle" style="background-color: #33d17a;"></label>
                            <input type="radio" name="color" id="orange" value="#ffa348">
                            <label for="orange" class="circle" style="background-color: #ffa348;"></label>
                            <input type="radio" name="color" id="purple" value="#c061cb">
                            <label for="purple" class="circle" style="background-color: #c061cb;"></label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <?= header("Location:" . base_url); ?>
<?php endif ?>

<?php include_once('views/layout/footer.php') ?>
<script src="<?= base_url ?>js/eventos.js"></script>
<script src="<?= base_url ?>plugins/fullcalendar/main.min.js"></script>
<script src="<?= base_url ?>plugins/fullcalendar/es.js"></script>
<script src="<?= base_url ?>plugins/timepicker/timepicker.js"></script>
<script src="<?= base_url ?>plugins/jquery/jquery_validate.js"></script>
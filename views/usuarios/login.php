<link rel="stylesheet" href="<?= base_url ?>bootstrap/bootstrap.css">
<?php require_once 'views/layout/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 mt-4">
            <div class="img-login">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Acceso
                </div>
                <div class="card-body">
                    <form id="login">
                        <div class="row mb-3">
                            <label for="user" class="col-sm-3 col-form-label">Usuario:</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="user" id="user">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">Contraseña:</label>
                            <div class="col-sm">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <button type="button" class="btn-acceder" id="btnLogin">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>
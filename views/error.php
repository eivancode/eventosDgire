<? require_once "views/layout/header.php" ?>
<?php include_once('views/layout/sidebar.php') ?>
<link rel="stylesheet" href="<?= base_url ?>assets/css/adminlte.min.css">

<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) : ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class='notFound'>La página que buscas no existe</h1>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php else : ?>
    <?= header("Location:" . base_url); ?>
<?php endif ?>

<?php include_once('views/layout/footer.php') ?>
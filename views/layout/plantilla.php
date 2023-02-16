<? include_once "views/layout/header.php" ?>
<?php include_once('views/layout/sidebar.php') ?>
<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) : ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

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
<?php elseif (isset($_SESSION['user'])) : ?>
    <?= header("Location:" . base_url . "usuario/index"); ?>
<?php else : ?>
    <?= header("Location:" . base_url); ?>
<?php endif ?>

<?php include_once('views/layout/footer.php') ?>
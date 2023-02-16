<?php

class ErrorController
{

    public function index()
    {
        /*require_once "views/layout/header.php";
        require_once 'views/layout/sidebar.php';

        if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {

            echo "<h1 class='error404'>La página que buscas no existe</h1>";
        } else {
            header("Location:" . base_url);
        }
        require_once 'views/layout/footer.php';*/
        require_once 'views/error.php';

    }

}

<?php

function controllers_autoload($classname)
{
    //include_once 'controllers/' . ucfirst($classname) . '.php';
    include_once 'controllers/EventoController.php';
    include_once 'controllers/SolicitudController.php';
    include_once 'controllers/UsuarioController.php';
    include_once 'controllers/AulaController.php';
    include_once 'controllers/ErrorController.php';
}

spl_autoload_register('controllers_autoload');

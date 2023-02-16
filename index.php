<?php

ob_start();
session_start();
require_once 'autoload.php';
require_once 'config/conexion.php';
require_once 'config/parameters.php';

function show_error()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) { //Si en la URL existe 'controller'
    $nombre_controlador = $_GET['controller'] . 'Controller'; //Se asigna el valor de 'controller' que se recibe por URL
    // Ejemplo: ?usuario -> usuarioController
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) { //Si no existe controlador ni accion 
    //Ejemplo usuario/registro
    $nombre_controlador = controller_default;                       //Se asigna el valor por defecto que se obtiene 
    //de parameters.php
} /*else {

    show_error();
    exit();
}*/

if (class_exists($nombre_controlador)) {

    $controlador = new $nombre_controlador(); // Ejemplo: new UsuarioController

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action(); // Ejemplo usuario->registro
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $accion = action_default;
        $controlador->$accion();
    } else {
        show_error();
    }
} else {
    show_error();
}
ob_end_flush();

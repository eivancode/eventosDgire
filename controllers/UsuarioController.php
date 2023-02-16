<?php

require_once 'models/Usuario.php';

class UsuarioController
{

    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new Usuario();
    }

    public function index()
    {
        $id = $_SESSION['idUsuario'];
        $roles = $this->usuarios->getRoles();
        $usuario = $this->usuarios->getSession($id);

        require_once 'views/usuarios/index.php';
    }

    public function login()
    {

        if (isset($_POST) and !empty($_POST)) {
            $usuario = !empty($_POST['usuario']) ? $_POST['usuario'] : false;
            $password = !empty($_POST['password']) ? $_POST['password'] : false;
            $usuario = $this->usuarios->login($usuario, $password);

            if ($usuario && $password) {
                $_SESSION['idUsuario'] = $usuario['idUsuario']; //Obtener los datos del usuario solicitante
                if ($usuario['idRol'] == '1') {
                    $_SESSION['admin'] = $usuario;
                } elseif ($usuario['idRol'] == '2') {
                    $_SESSION['user'] = $usuario;
                } else {
                    http_response_code(400);
                }
            } else {
                http_response_code(400);
            }
        }
        require_once 'views/usuarios/login.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . base_url);
    }

    public function guardar()
    {
        /* if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['rol']) && is_numeric($_POST['rol'])) {
            $this->usuarios->setNombre($_POST['nombre']);
            $this->usuarios->setEmail($_POST['email']);
            $this->usuarios->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
            $this->usuarios->setRol($_POST['rol']);
            $this->usuarios->setFcCrea(date('Y-m-d H:i:s'));
            $this->usuarios->insert();
        } else {
            http_response_code(400);
            echo  json_encode(array('message' => "Faltan campos por completar"));
        } */

        $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : false;
        $email = !empty($_POST['email']) ? $_POST['email'] : false;
        $password = !empty($_POST['password']) ? $_POST['password'] : false;
        $rol = !empty($_POST['rol']) && is_numeric($_POST['rol']) ? $_POST['rol'] : false;

        if ($nombre && $email && $password && $rol) {
            $this->usuarios->setNombre($nombre);
            $this->usuarios->setEmail($email);
            $this->usuarios->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $this->usuarios->setRol($rol);
            $this->usuarios->setFcCrea(date('Y-m-d H:i:s'));
            $this->usuarios->insert();
            echo  json_encode(array('message' => "Usuario registrado"));
        } else {
            http_response_code(400);
            echo  json_encode(array('message' => "Faltan campos por completar"));
        }
    }

    public function listar()
    {
        echo json_encode($this->usuarios->getUsers());
    }

    public function editar()
    {
        $id = $_GET['id'];

        echo json_encode($this->usuarios->edit($id));
    }

    public function actualizar()
    {
        //$idRol = $this->usuarios->getSession($id); // Variable de prueba 

        $id = $this->usuarios->setIdUsuario($_GET['id']);
        $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : false;
        $email = !empty($_POST['email']) ? $_POST['email'] : false;
        $rol = !empty($_POST['rol']) && is_numeric($_POST['rol']) ? $_POST['rol'] : false;

        if ($nombre && $email && $rol) {
            $this->usuarios->setNombre($nombre);
            $this->usuarios->setEmail($email);
            $this->usuarios->setRol($rol);
            $this->usuarios->setFcActualiza(date('Y-m-d H:i:s'));
            $this->usuarios->update($id);
            echo  json_encode(array('message' => "Usuario actualizado"));
        } else {
            http_response_code(400);
            echo  json_encode(array('message' => "Faltan campos por completar"));
        }
        /*      if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['rol'])) {
            $this->usuarios->setNombre($_POST['nombre']);
            $this->usuarios->setEmail($_POST['email']);
            $this->usuarios->setRol($_POST['rol']);
            $this->usuarios->setFcActualiza(date('Y-m-d H:i:s'));
            $this->usuarios->update($id);

            if ($idRol['idRol'] == 2) {


                session_destroy();
                header("Location:" . base_url);
            }
        } else {
            http_response_code(404);
        } */
    }

    public function borrar()
    {
        $id = $_GET['id'];

        $this->usuarios->delete($id);
        echo  json_encode(array('message' => "Usuario eliminado"));
    }
}

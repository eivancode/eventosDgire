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
        $roles = $this->usuarios->getRoles();

        require_once 'views/usuarios/index.php';
    }

    public function login()
    {
        require_once 'views/usuarios/login.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . base_url);
    }

    public function autenticar()
    {
        $nombre = isset($_POST['usuario']) && !empty($_POST['usuario']) ? $_POST['usuario'] : false;
        $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : false;

        if ($nombre && $password) {
            $usuario = $this->usuarios->auth($nombre, $password);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['idUsuario'] = $usuario['idUsuario']; //Obtener los datos del usuario solicitante
                $_SESSION['idRol'] = $usuario['idRol'];

                if ($usuario['idRol'] == '1') {
                    $_SESSION['admin'] = $usuario['email'];
                } elseif ($usuario['idRol'] == '2') {
                    $_SESSION['user'] = $usuario['email'];
                }
            } else {
                http_response_code(400);
                echo  json_encode(array('message' => "Usuario o contraseña incorrecto"));
            }
        } else {
            http_response_code(400);
            echo  json_encode(array('message' => "Faltan campos por completar"));
        }
    }

    public function guardar()
    {
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
    }

    public function borrar()
    {
        $id = $_GET['id'];

        $this->usuarios->delete($id);
        echo  json_encode(array('message' => "Usuario eliminado"));
    }
}

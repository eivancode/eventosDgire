<?php

require_once 'models/Aula.php';

class AulaController
{

    private $aulas;
    private $date;

    public function __construct()
    {
        $this->aulas = new Aula();
    }

    public function index()
    {
        require_once 'views/aulas/index.php';
    }

    public function guardar()
    {

        if (!empty($_POST['nombre'])) {
            $this->aulas->setNombre($_POST['nombre']);
            $this->aulas->insert();
        } else {
            http_response_code(400);
            echo  json_encode(array('message' => "Faltan campos por completar"));
        }
    }

    public function listar()
    {
        echo json_encode($this->aulas->getAulas());
    }

    public function editar()
    {
        $id = $_GET['id'];

        echo json_encode($this->aulas->edit($id));
    }

    public function actualizar()
    {
        $id = $this->aulas->setIdAula($_GET['id']);

        if (!empty($_POST['nombre'])) {
            $this->aulas->setNombre($_POST['nombre']);
            $this->aulas->update($id);
        } else {
            http_response_code(404);
        }
    }

    public function borrar()
    {
        $id = $_GET['id'];
        $this->aulas->delete($id);
    }
}

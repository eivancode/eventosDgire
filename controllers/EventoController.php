<?php

require_once 'models/Evento.php';
require_once 'models/Aula.php';


class EventoController
{
    private $eventos;

    public function __construct()
    {
        $this->eventos = new Evento();
    }

    public function index()
    {
        $aula = new Aula();
        $aulas = $aula->getAulas();

        require_once 'views/eventos/index.php';
    }

    public function listar()
    {
        echo json_encode($this->eventos->getEvents());
    }

    public function guardar()
    {
        $this->eventos->setTitulo($_POST['titulo']);
        $this->eventos->setInicio($_POST['inicio']);
        $this->eventos->setFin($_POST['fin']);
        $this->eventos->setColor($_POST['color']);
        $this->eventos->setUsuario((int)$_SESSION['idUsuario']);
        $this->eventos->setAula($_POST['idAula']);
        $this->eventos->insert();
    }
}

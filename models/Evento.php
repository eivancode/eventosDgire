<?php

class Evento extends Conexion
{
    private $idEvento;
    private $titulo;
    private $descripcion;
    private $inicio;
    private $fin;
    private $color;
    private $idUsuario;
    private $idAula;
    private $db;

    public function __construct()
    {
        $this->db = (new Conexion)->connect();
    }
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getInicio()
    {
        return $this->inicio;
    }

    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    public function getFin()
    {
        return $this->fin;
    }

    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
    
    public function getUsuario()
    {
        return $this->idUsuario;
    }

    public function setAula($idAula)
    {
        $this->idAula = $idAula;

        return $this;
    }
    
    public function getAula()
    {
        return $this->idAula;
    }
    
    public function getEvents()
    {
        try {
            $query = "SELECT * FROM eventos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos[] = $fila;
            }

            return $datos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert()
    {
        try {
            $query = "INSERT INTO eventos(titulo, inicio, fin, color, idUsuario, idAula) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $this->titulo);
            $stmt->bindParam(2, $this->inicio);
            $stmt->bindParam(3, $this->fin);
            $stmt->bindParam(4, $this->color);
            $stmt->bindParam(5, $this->idUsuario);
            $stmt->bindParam(6, $this->idAula);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

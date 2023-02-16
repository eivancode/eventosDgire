<?php

class Aula extends Conexion
{
	private $idAula;
	private $nombre;
	private $fcCrea;
	private $fcActualiza;
	private $db;

	public function __construct()
	{
		$this->db = (new Conexion)->connect();
	}

	public function getIdAula()
	{
		return $this->idAula;
	}

	public function setIdAula($idAula)
	{
		$this->idAula = $idAula;

		return $this;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}

	public function insert()
	{
		$this->fcCrea = date('Y-m-d H:i:s');

		try {
			$query = "INSERT INTO aulas(nombre, fcCrea) VALUES (?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->fcCrea, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getAulas()
	{
		try {

			$query = "SELECT * FROM aulas";
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

	public function edit($id)
	{

		try {
			$query = "SELECT idAula, nombre FROM aulas WHERE idAula = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();

			while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
				$datos[] = $fila;
			}

			return $datos;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update($idAula)
	{
		$this->fcActualiza = date('Y-m-d H:i:s');

		try {
			$query = "UPDATE aulas SET nombre = ?, fcActualiza = ? WHERE idAula = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->fcActualiza, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->idAula, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id)
	{
		try {
			$query = "DELETE FROM aulas WHERE idAula = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

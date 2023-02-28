<?php

class Usuario extends Conexion
{
	private $idUsuario;
	private $nombre;
	private $usuario;
	private $email;
	private $password;
	private $idRol;
	private $fcCrea;
	private $fcActualiza;
	private $db;

	public function __construct()
	{
		$this->db = (new Conexion)->connect();
	}

	public function getIdUsuario()
	{
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;

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

	public function getusuario()
	{
		return $this->nombre;
	}

	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;

		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	public function getRol()
	{
		return $this->idRol;
	}

	public function setRol($idRol)
	{
		$this->idRol = $idRol;

		return $this;
	}

	public function getFcCrea()
	{
		return $this->fcCrea;
	}

	public function setFcCrea($fcCrea)
	{
		$this->fcCrea = $fcCrea;

		return $this;
	}

	public function getFcActualiza()
	{
		return $this->fcActualiza;
	}

	public function setFcActualiza($fcActualiza)
	{
		$this->fcActualiza = $fcActualiza;

		return $this;
	}

	public function auth($nombre, $password)
	{
		try {
			$query = "SELECT * FROM usuarios WHERE usuario = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $nombre, PDO::PARAM_STR);
			$stmt->execute();
			$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

			return $usuario;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getUsers()
	{
		try {
			$query = "SELECT idUsuario, nombre, usuario, email, rol
			FROM usuarios u JOIN roles r on u.idRol = r.idRol";
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

	public function getRoles()
	{
		try {

			$query = "SELECT * FROM roles";
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

	public function usernameExists()
	{
		try {
			$query = "SELECT usuario FROM usuarios WHERE usuario = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->usuario, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->fetchColumn() != 0) {
				return true; 
			} else {
				return false; //Usuario disponible 
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function emailExists()
	{
		try {
			$query = "SELECT email FROM usuarios WHERE email = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->email, PDO::PARAM_STR);
			$stmt->execute();

			if ($stmt->fetchColumn() != 0) {
				return true; 
			} else {
				return false; //Email disponible 
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function insert()
	{
		try {
			$query = "INSERT INTO usuarios(nombre, usuario, email, password, idRol, fcCrea) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->usuario, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->email, PDO::PARAM_STR);
			$stmt->bindParam(4, $this->password, PDO::PARAM_STR);
			$stmt->bindParam(5, $this->idRol, PDO::PARAM_INT);
			$stmt->bindParam(6, $this->fcCrea, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function edit($idUsuario)
	{
		try {
			$query = "SELECT idUsuario, nombre, usuario, email, idRol FROM usuarios WHERE idUsuario = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
			$stmt->execute();

			while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
				$datos[] = $fila;
			}

			return $datos;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function update()
	{
		try {
			$query = "UPDATE usuarios SET nombre = ?, email = ?, idRol = ?, fcActualiza = ? WHERE idUsuario = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
			$stmt->bindParam(2, $this->email, PDO::PARAM_STR);
			$stmt->bindParam(3, $this->idRol, PDO::PARAM_STR);
			$stmt->bindParam(4, $this->fcActualiza, PDO::PARAM_STR);
			$stmt->bindParam(5, $this->idUsuario, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id)
	{
		try {
			$query = "DELETE FROM usuarios WHERE idUsuario = ?";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

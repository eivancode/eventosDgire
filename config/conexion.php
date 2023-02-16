<?php

class Conexion
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $db = DB_NAME;
    private $pdo;

    public function connect()
    {
        try {
            $db_config = "mysql:host=" . $this->host . ";dbname=" . $this->db;
            $error_config = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->pdo = new PDO($db_config, $this->user, $this->password, $error_config);
            return $this->pdo;
        } catch (PDOException $ex) {
            echo "Conecction error:" . $ex->getMessage();
        }
    }
}

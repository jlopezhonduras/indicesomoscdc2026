<?php

class Conexion
{
    private $host = "localhost";
    private $db = "indice_lgtbi";
    private $user = "root";
    private $pass = "";

    public function conectar()
    {
        $conexion = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $conexion->set_charset("utf8mb4");

        return $conexion;
    }
}
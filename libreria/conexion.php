<?php
include_once 'config.php';

class Conexion {
    private $conn;

    public function __construct() {
        $this->conn = conectar();  // Llama a la función conectar() de config.php
    }

    public function getConexion() {
        return $this->conn;
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>

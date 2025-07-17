<?php
include("motor.php");

class Persona {
    public $id;
    public $nombre;
    public $apellido;
    public $sexo;
    public $dni;
    public $carrera;
    public $telefono;
    public $email;
    public $user;
    public $passwd;
    public $rol;
    static $recs;

    private $mysqli;

    public function __construct() {
        $conexion = new Conexion();
        $this->mysqli = $conexion->getConexion();
    }

    function guardar() {
        $pass = md5($this->passwd);
        $sql = "INSERT INTO personas(nombre,apellido,sexo,dni,carrera,telefono,email,user,passwd,rol)
            VALUES (
                '$this->nombre',
                '$this->apellido',
                '$this->sexo',
                '$this->dni',
                '$this->carrera',
                '$this->telefono',
                '$this->email',
                '$this->user',
                '$pass',
                '$this->rol'
            )";
        $this->mysqli->query($sql);
    }

    function actualizar($nro = 0) {
        if ($this->passwd != "") {
            $pass = md5($this->passwd);
        } else {
            $pass = md5("1234");
        }
        $sql = "UPDATE personas SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            sexo='$this->sexo',
            dni='$this->dni',
            carrera='$this->carrera',
            telefono='$this->telefono',
            email='$this->email',
            user='$this->user',
            passwd='$pass',
            rol='$this->rol'
            WHERE id = $nro";
        $this->mysqli->query($sql);
    }

    function borrar($nro = 0) {
        $sql = "DELETE FROM personas WHERE id=$nro";
        $this->mysqli->query($sql);
    }

    function traer_datos($nro = 0) {
        if ($nro != 0) {
            $sql = "SELECT * FROM personas WHERE id = $nro";
            $result = $this->mysqli->query($sql);
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }

    static function buscar($str) {
        $conexion = new Conexion();
        $mysqli = $conexion->getConexion();

        $sql = "SELECT * FROM personas WHERE 
                carrera LIKE '%$str%' OR 
                user LIKE '%$str%' OR 
                nombre LIKE '%$str%' OR 
                apellido LIKE '%$str%' OR 
                id='$str' OR 
                dni='$str'";
        $rs = $mysqli->query($sql);
        $est = [];
        while ($fila = $rs->fetch_assoc()) {
            $est[] = $fila;
        }
        return $est;
    }
}

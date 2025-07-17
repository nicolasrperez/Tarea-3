<?php
include("motor.php");

class Cartel {
    public $id_cartel;
    public $categoria;
    public $titulo;
    public $texto;
    public $imagen;
    public $plantilla;
    public $v_desde;
    public $v_hasta;
    public $activo;
    public $link;
    public $texto1;
    public $texto2;
    public $imagen1;

    private $mysqli;

    public function __construct() {
        $conexion = new Conexion();
        $this->mysqli = $conexion->getConexion();
    }

    function guardar() {
        $sql = "INSERT INTO carteles(categoria,titulo,texto,imagen,plantilla,v_desde,v_hasta,activo,link,texto1,texto2,imagen1)
            VALUES (
                '$this->categoria',
                '$this->titulo',
                '$this->texto',
                '$this->imagen',
                '$this->plantilla',
                '$this->v_desde',
                '$this->v_hasta',
                '$this->activo',
                '$this->link',
                '$this->texto1',
                '$this->texto2',
                '$this->imagen1'
            )";
        $this->mysqli->query($sql);
    }

    function actualizar($nro = 0) {
        $sql = "UPDATE carteles SET
            categoria='$this->categoria',
            titulo='$this->titulo',
            texto='$this->texto',
            imagen='$this->imagen',
            plantilla='$this->plantilla',
            v_desde='$this->v_desde',
            v_hasta='$this->v_hasta',
            activo='$this->activo',
            link='$this->link',
            texto1='$this->texto1',
            texto2='$this->texto2',
            imagen1='$this->imagen1'
            WHERE id_cartel = $nro";
        $this->mysqli->query($sql);
    }

    function borrar($nro = 0) {
        $sql = "DELETE FROM carteles WHERE id_cartel = $nro";
        $this->mysqli->query($sql);
    }

    function traer_datos($nro = 0) {
        if ($nro != 0) {
            $sql = "SELECT * FROM carteles WHERE id_cartel = $nro";
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

        $sql = "SELECT * FROM carteles WHERE 
                categoria LIKE '%$str%' OR 
                titulo LIKE '%$str%' OR 
                texto LIKE '%$str%' OR 
                link LIKE '%$str%' OR 
                id_cartel='$str'";
        $rs = $mysqli->query($sql);
        $est = [];
        while ($fila = $rs->fetch_assoc()) {
            $est[] = $fila;
        }
        return $est;
    }

    static function seleccionar($str) {
        $conexion = new Conexion();
        $mysqli = $conexion->getConexion();

        if (is_numeric($str)) {
            $sql = "SELECT * FROM carteles WHERE id_cartel = '$str'";
        } else {
            $sql = "SELECT * FROM carteles WHERE categoria = '$str' AND activo = 1";
        }

        $rs = $mysqli->query($sql);
        $est = [];
        while ($fila = $rs->fetch_assoc()) {
            $est[] = $fila;
        }
        return $est;
    }

    static function categorias() {
        $conexion = new Conexion();
        $mysqli = $conexion->getConexion();

        $sql = "SELECT categoria, COUNT(id_cartel) as cantidad FROM carteles WHERE activo=1 GROUP BY categoria";
        $rs = $mysqli->query($sql);
        $est = [];
        while ($fila = $rs->fetch_assoc()) {
            $est[] = $fila;
        }
        return $est;
    }
}

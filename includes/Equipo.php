<?php

namespace es\fdi\ucm\aw;

class Equipo{
    private $id;
    private $nombre;

    private function __construct($nombre){
        $this->nombre= $nombre;
    }

    public static function buscaEquipo($idEquipo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM equipos U WHERE U.idEquipo = '%s'", $conn->real_escape_string($idEquipo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $equipo = new Equipo($fila['nombre']);
                $equipo->id = $fila['idEquipo'];
                $result = $equipo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaNombre($nombre){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM equipos U WHERE U.nombre = '%s'", $conn->real_escape_string($nombre));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $equipo = new Equipo($fila['nombre']);
                $equipo->id = $fila['idEquipo'];
                $result = $equipo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($nombre){
        $equipo = self::buscaNombre($nombre);
        if($equipo){
            return false;
        }

        $equipo = new Equipo($nombre);
        return self::guarda($equipo);
    }

    private static function inserta($equipo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO equipos(nombre) VALUES('%s')"
            , $conn->real_escape_string($equipo->nombre));
        if ( $conn->query($query) ) {
            $equipo->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $equipo;
    }

    public static function guarda($equipo){
        return self::inserta($equipo);
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
}
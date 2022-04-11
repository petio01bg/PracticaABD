<?php

namespace es\fdi\ucm\aw;

class Jugador{
    private $id;
    private $nombre;
    private $dorsal;
    private $equipo;
    private $goles;
    private $asistencias;
    private $salvadas;
    private bool $ok = true;

    private function __construct($nombreJugador, $equipo, $dorsal, $golesJugador,$asistenciasJugador,$salvadasJugador){
        $this->nombre= $nombreJugador;
        $this->dorsal = $dorsal;
        $this->equipo = $equipo;
        $this->goles = $golesJugador;
        $this->asistencias=$asistenciasJugador;
        $this->salvadas=$salvadasJugador;
    }

    public static function buscaJugador($idJugador){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM jugadores U WHERE U.idJugador = '%s'", $conn->real_escape_string($idJugador));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $jugador = new Jugador($fila['nombreJugador'], $fila['equipo'], $fila['dorsal'], $fila['golesJugador'],$fila['asistenciasJugador'],$fila['salvadasJugador']);
                $jugador->id = $fila['idJugador'];
                $result = $jugador;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaJugadorNombre($nombreJugador, $equipo, $dorsal){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM jugadores U WHERE U.nombreJugador = '%s'", $conn->real_escape_string($nombreJugador));
        $rs = $conn->query($query);
        $result = false;
        $ok = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $jugador = new Jugador($fila['nombreJugador'], $fila['equipo'], $fila['dorsal'], $fila['golesJugador'],$fila['asistenciasJugador'],$fila['salvadasJugador']);
                $jugador->id = $fila['idJugador'];

                if($fila['equipo'] == $equipo && $fila['dorsal'] == $dorsal){
                    $result = false;
                    $ok = true;
                }
                else{
                    $result = $jugador;
                    $ok = false;
                }
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $ok;
    }

    public static function crea($nombreJugador, $dorsal, $equipo, $golesJugador, $asistenciasJugador, $salvadasJugador){
        $ok = true;
        $jugador = self::buscaJugadorNombre($nombreJugador, $equipo, $dorsal);
        if($jugador == true){
            return false;
        }

        $jugador = new Jugador($nombreJugador, $dorsal, $equipo, $golesJugador, $asistenciasJugador, $salvadasJugador);
        return self::guarda($jugador);
    }

    private static function inserta($jugador){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO jugadores(nombreJugador, equipo, dorsal, golesJugador, asistenciasJugador, salvadasJugador) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($jugador->nombre)
            , $conn->real_escape_string($jugador->equipo)
            , $conn->real_escape_string($jugador->dorsal)
            , $conn->real_escape_string($jugador->goles)
            , $conn->real_escape_string($jugador->asistencias)
            , $conn->real_escape_string($jugador->salvadas));
        if ( $conn->query($query) ) {
            $jugador->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $jugador;
    }

    public static function guarda($jugador){
        return self::inserta($jugador);
    }

    public function getId(){
        return $this->id;
    }

    public function getNombreJugador(){
        return $this->nombre;
    }

    public function getEquipo(){
        return $this->equipo;
    }

    public function getDorsal(){
        return $this->dorsal;
    }

    public function getGoles(){
        return $this->goles;
    }

    public function getAsistenacias(){
        return $this->asistencias;
    }

    public function getSalvadas(){
        return $this->salvadas;
    }
}
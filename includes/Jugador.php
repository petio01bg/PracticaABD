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

    private function __construct($nombreJugador, $equipo, $dorsal, $golesJugador,$asistenciasJugador,$salvadasJugador){
        $this->nombre= $nombreJugador;
        $this->dorsal=$dorsal;
        $this->equipo=$equipo;
        $this->goles=$golesJugador;
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
        $query = sprintf("SELECT * FROM jugadores U WHERE U.nombreJugador='$nombreJugador' AND U.equipo='$equipo' AND U.dorsal='$dorsal'", $conn->real_escape_string($nombreJugador),$conn->real_escape_string($equipo), $conn->real_escape_string($dorsal));
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

    public static function crea($nombreJugador, $equipo, $dorsal, $golesJugador, $asistenciasJugador, $salvadasJugador){
        $jugador = self::buscaJugadorNombre($nombreJugador, $equipo, $dorsal);
        if($jugador){
            $id = $jugador->id;
            $jugador = new Jugador($nombreJugador, $equipo, $dorsal, $golesJugador, $asistenciasJugador, $salvadasJugador);
            $jugr = self::actualiza($jugador,$id);
            return false;
        }

        $jugador = new Jugador($nombreJugador, $equipo, $dorsal, $golesJugador, $asistenciasJugador, $salvadasJugador);
        return self::guarda($jugador);
    }

    private static function actualiza($jugador, $id){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE jugadores SET golesJugador='$jugador->goles', asistenciasJugador='$jugador->asistencias', salvadasJugador='$jugador->salvadas' WHERE idJugador='$id'"
            ,$id  
            , $conn->real_escape_string($jugador->goles)
            , $conn->real_escape_string($jugador->asistencias)
            , $conn->real_escape_string($jugador->salvadas));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el jugador: " . $jugador->id;
            }
            else{
                $result = $jugador;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
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

    private static function borraJugador($nombreJugador, $equipo, $dorsal){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM jugadores WHERE nombreJugador='$nombreJugador' AND equipo='$equipo' AND dorsal='$dorsal'", $conn->real_escape_string($nombreJugador),$conn->real_escape_string($equipo), $conn->real_escape_string($dorsal));
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private static function borraJugadorEquipo($nombreEquipo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM jugadores WHERE equipo='$nombreEquipo'", $conn->real_escape_string($nombreEquipo));
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function borra($nombreJugador, $equipo, $dorsal){
        return self::borraJugador($nombreJugador, $equipo, $dorsal);
    }

    public static function borraEq($nombre){
        return self::borraJugadorEquipo($nombre);
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
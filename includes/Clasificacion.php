<?php

namespace es\fdi\ucm\aw;

class Clasificacion{
    private $id;
    private $puntos;
    private $ganados;
    private $empatados;
    private $perdidos;
    private $marcados;
    private $recibidos;

    private function __construct($id,$puntos,$ganados,$empatados,$perdidos,$marcados,$recibidos){
        $this->id=$id;
        $this->puntos=$puntos;
        $this->ganados=$ganados;
        $this->empatados=$empatados;
        $this->perdidos=$perdidos;
        $this->marcados=$marcados;
        $this->recibidos=$recibidos;
    }

    public static function buscaEquipoClasificacion($idEquipo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM clasificacion U WHERE U.idEquipo = '%s' ORDER BY puntos DESC" , $conn->real_escape_string($idEquipo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $equipo = new Clasificacion($fila['idEquipo'],$fila['puntos'], $fila['ganados'],$fila['empatados'],$fila['perdidos'],$fila['golesmarcados'],$fila['golesrecibidos']);
                $result = $equipo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($idEquipo,$puntos,$ganados,$empatados,$perdidos,$golesmarcados,$golesrecibidos){
        $equipo = self::buscaEquipoClasificacion($idEquipo);
        if($equipo){
            $equipo = new Clasificacion($idEquipo,$puntos,$ganados,$empatados,$perdidos,$golesmarcados,$golesrecibidos);
            $eq = self::actualiza($equipo);
            return false;
        }

        $equipo = new Clasificacion($idEquipo,$puntos,$ganados,$empatados,$perdidos,$golesmarcados,$golesrecibidos);
        return self::guarda($equipo);
    }

    private static function actualiza($equipo){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE clasificacion SET puntos='$equipo->puntos', ganados='$equipo->ganados', empatados='$equipo->empatados', perdidos='$equipo->perdidos', golesmarcados='$equipo->marcados' , golesrecibidos='$equipo->recibidos' WHERE idEquipo='$equipo->id'"
            , $conn->real_escape_string($equipo->id)   
            , $conn->real_escape_string($equipo->puntos)
            , $conn->real_escape_string($equipo->ganados)
            , $conn->real_escape_string($equipo->empatados)
            , $conn->real_escape_string($equipo->perdidos)
            , $conn->real_escape_string($equipo->marcados)
            , $conn->real_escape_string($equipo->recibidos));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el equipo: " . $equipo->id;
            }
            else{
                $result = $equipo;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }

    private static function inserta($equipo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO clasificacion(idEquipo,puntos,ganados,empatados,perdidos,golesmarcados,golesrecibidos) VALUES('%s','%s','%s','%s','%s','%s','%s')"
            , $equipo->id
            , $conn->real_escape_string($equipo->puntos)
            , $conn->real_escape_string($equipo->ganados)
            , $conn->real_escape_string($equipo->empatados)
            , $conn->real_escape_string($equipo->perdidos)
            , $conn->real_escape_string($equipo->marcados)
            , $conn->real_escape_string($equipo->recibidos));
        if ( $conn->query($query) ) {
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $equipo;
    }
    private static function borraEquipo($id){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM clasificacion WHERE idEquipo='$id'", $conn->real_escape_string($id));
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function borra($id){
        return self::borraEquipo($id);
    }

    public static function guarda($equipo){
        return self::inserta($equipo);
    }

    public function getId(){
        return $this->id;
    }

    public function getPuntos(){
        return $this->puntos;
    }

    public function getGanados(){
        return $this->ganados;
    }

    public function getEmpatados(){
        return $this->empatados;
    }

    public function getPerdidos(){
        return $this->perdidos;
    }

    public function getMarcados(){
        return $this->marcados;
    }

    public function getRecibidos(){
        return $this->recibidos;
    }
}
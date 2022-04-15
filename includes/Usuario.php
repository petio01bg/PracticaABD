<?php

namespace es\fdi\ucm\aw;

class Usuario{
    private $id;
    private $nombreUsuario;
    private $password;
    private $nombre;
    private $rol;
    private $correo;

    private function __construct($nombreUsuario, $nombre, $password, $rol, $correo){
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->correo = $correo;
    }

    public static function login($nombreUsuario, $password){
        $usuario = self::buscaUsuario($nombreUsuario,null);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario, $correo){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $query1 = sprintf("SELECT * FROM Usuarios U WHERE U.correo = '%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $rs1 = $conn->query($query1);
        $result = false;
        if ($rs && $rs1) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol'], $fila['correo']);
                $user->id = $fila['id'];
                $result = $user;
            }
            if ( $rs1->num_rows == 1) {
                $fila = $rs1->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol'], $fila['correo']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
            $rs1->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea($nombreUsuario, $nombre, $password, $rol, $correo){
        $user = self::buscaUsuario($nombreUsuario, $correo);
        if ($user) {
            return false;
        }
        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $rol, $correo);
        return self::guarda($user);
    }
    
    private static function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function guarda($usuario){
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }

    private static function inserta($usuario){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol,correo) VALUES('%s', '%s', '%s', '%s','%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            , $conn->real_escape_string($usuario->correo));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    private static function actualiza($usuario){
        $result = false;
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', rol='%s' WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
            }
            else{
                $result = $usuario;
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
        }
        
        return $result;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getRol(){
        return $this->rol;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function compruebaPassword($password){
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword){
        $this->password = self::hashPassword($nuevoPassword);
    }
}
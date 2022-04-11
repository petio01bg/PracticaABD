<?php

namespace es\fdi\ucm\aw;

class FormularioRegistro extends Form{

    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $nombre = $datos['nombre'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreUsuario = self::createMensajeError($errores, 'nombreUsuario', 'span', array('class' => 'error'));
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));
        $errorPassword2 = self::createMensajeError($errores, 'password2', 'span', array('class' => 'error'));

        $html = <<<EOF
            <div class="content">
                $htmlErroresGlobales
                <div class="grupo-control">
                    <p><label>Nombre de usuario:</label> <input class="control" type="text" name="nombreUsuario" value="$nombreUsuario" />$errorNombreUsuario<p7>
                </div>
                <div class="grupo-control">
                    <p><label>Nombre completo:</label> <input class="control" type="text" name="nombre" value="$nombre" />$errorNombre</p>
                </div>
                <div class="grupo-control">
                    <p><label>Password:</label> <input class="control" type="password" name="password" />$errorPassword</p>
                </div>
                <div class="grupo-control">
                    <p><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" />$errorPassword2</p>
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
            </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos){
        $result = array();
        
        $nombreUsuario = $datos['nombreUsuario'] ?? null;
        
        if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
            $result['nombreUsuario'] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result['nombre'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $password = $datos['password'] ?? null;
        if ( empty($password) || mb_strlen($password) < 5 ) {
            $result['password'] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = $datos['password2'] ?? null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result['password2'] = "Los passwords deben coincidir";
        }
        
        if (count($result) === 0) {
            $user = Usuario::crea($nombreUsuario, $nombre, $password, 'user');
            if ( ! $user ) {
                $result[] = "El usuario ya existe";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $nombre;
                $result = 'index.php';
            }
        }
        return $result;
    }
}
<?php

namespace es\fdi\ucm\aw;

class FormularioLogin extends Form{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario =$datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreUsuario = self::createMensajeError($errores, 'nombreUsuario', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        <div class="content">
            <legend>Usuario y contraseña</legend>
            $htmlErroresGlobales
            <p><label>Nombre de usuario:</label> <input type="text" name="nombreUsuario" value="$nombreUsuario"/>$errorNombreUsuario</p>
            <p><label>Contraseña:</label> <input type="password" name="password" />$errorPassword</p>
            <button type="submit" name="login">Entrar</button>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos){
        $result = array();
        
        $nombreUsuario =$datos['nombreUsuario'] ?? null;
        $nombre = $datos['nombre'] ?? null;
                
        if ( empty($nombreUsuario) ) {
            $result['nombreUsuario'] = "El nombre de usuario no puede estar vacío";
        }
        
        $password = $datos['password'] ?? null;
        if ( empty($password) ) {
            $result['password'] = "La contraseña no puede estar vacía.";
        }
        
        if (count($result) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o la contraseña no coinciden";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombreUsuario();
                $_SESSION['esAdmin'] = strcmp($usuario->getRol(), 'admin') == 0 ? true : false;
                $result = 'index.php';
            }
        }
        return $result;
    }
}
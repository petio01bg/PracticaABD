<?php

namespace es\fdi\ucm\aw;

class FormularioBorraEquipo extends Form{

    public function __construct() {
        parent::__construct('formBorraEquipo');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        $nombre = $datos['nombre'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));

        $html = <<<EOF
            <div class="content">
                $htmlErroresGlobales
                <div class="grupo-control">
                    <p><label>Nombre del Equipo:</label> <input class="control" type="text" name="nombre" value="$nombre" />$errorNombre</p>
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Borrar Equipo</button></div>
            </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos){
        $result = array();
        
        $nombre = $datos['nombre'] ?? null;
        
        if ( empty($nombre) || mb_strlen($nombre) < 1 ) {
            $result['nombre'] = "El nombre del equipo esta vacío";
        }
        
        if (count($result) === 0) {
            $equipo = Equipo::buscaNombre($nombre);
            if ($equipo) {

                $id = $equipo->getId();
                $nombre = $equipo->getNombre();

                $equipo = Equipo::borra($id);
                $equipo = Jugador::borraEq($nombre);
                $equipo = Clasificacion::borra($id);
                $result = 'index.php';


            } else {
                $result[] = "El equipo no existe";
            }
        }
        return $result;
    }
}
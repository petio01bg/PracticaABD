<?php

namespace es\fdi\ucm\aw;

class FormularioBorraJugador extends Form{

    public function __construct() {
        parent::__construct('formBorraJugador');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        $nombre = $datos['nombreJugador'] ?? '';
        $equipo = $datos['equipo'] ?? '';
        $dorsal = $datos['dorsal'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreJugador = self::createMensajeError($errores, 'nombreJugador', 'span', array('class' => 'error'));
        $errorEquipo = self::createMensajeError($errores, 'equipo', 'span', array('class' => 'error'));
        $errorDorsal = self::createMensajeError($errores, 'dorsal', 'span', array('class' => 'error'));

        $html = <<<EOF
        <div class="content">
                $htmlErroresGlobales
                <div class="grupo-control">
                    <p><label>Nombre del Jugador:</label> <input class="control" type="text" name="nombreJugador" value="$nombre" />$errorNombreJugador</p>
                </div>
                <div class="grupo-control">
                    <p><label>Equipo:</label> <input class="control" type="text" name="equipo" value="$equipo" />$errorEquipo</p>
                </div>
                <div class="grupo-control">
                    <p><label>Dorsal:</label> <input class="control" type="text" name="dorsal" value="$dorsal" />$errorDorsal</p>
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Borrar jugador</button></div>
            </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos){
        $result = array();
        
        $nombreJugador = $datos['nombreJugador'] ?? null;
        
        if ( empty($nombreJugador) || mb_strlen($nombreJugador) < 1 ) {
            $result['nombreJugador'] = "El nombre del Jugador esta vacío";
        }

        $equipo = $datos['equipo'] ?? null;
        
        if ( empty($equipo) || mb_strlen($nombreJugador) < 1 ) {
            $result['equipo'] = "El equipo del Jugador esta vacío";
        }

        $dorsal = $datos['dorsal'] ?? null;
        
        if ( empty($dorsal) || mb_strlen($dorsal) < 1 ) {
            $result['dorsal'] = "El dorsal del Jugador esta vacío";
        }

        if ( mb_strlen($dorsal) > 99 ) {
            $result['dorsal'] = "El dorsal del Jugador debe de ser entre 1 y 99";
        }

        
        if (count($result) === 0) {
            $jugador = Jugador::borra($nombreJugador, $equipo, $dorsal);
            if ($jugador) {
                $result = 'index.php';
            } else {
                $result[] = "El jugador no se ha podido borrar";
            }
        }
        return $result;
    }
}
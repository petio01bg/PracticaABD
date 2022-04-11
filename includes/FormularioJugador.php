<?php

namespace es\fdi\ucm\aw;

class FormularioJugador extends Form{

    public function __construct() {
        parent::__construct('formJugador');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        $nombre = $datos['nombreJugador'] ?? '';
        $equipo = $datos['equipo'] ?? '';
        $dorsal = $datos['dorsal'] ?? '';
        $goles = $datos['golesJugador'] ?? '';
        $asistencias = $datos['asistenciasJugador'] ?? '';
        $salvadas = $datos['salvadasJugador'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreJugador = self::createMensajeError($errores, 'nombreJugador', 'span', array('class' => 'error'));
        $errorEquipo = self::createMensajeError($errores, 'equipo', 'span', array('class' => 'error'));
        $errorDorsal = self::createMensajeError($errores, 'dorsal', 'span', array('class' => 'error'));
        $errorGoles = self::createMensajeError($errores, 'golesJugador', 'span', array('class' => 'error'));
        $errorAsistencias = self::createMensajeError($errores, 'asistenciasJugador', 'span', array('class' => 'error'));
        $errorSalvadas = self::createMensajeError($errores, 'salvadasJugador', 'span', array('class' => 'error'));

        $html = <<<EOF
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                    <label>Nombre del Jugador:</label> <input class="control" type="text" name="nombreJugador" value="$nombre" />$errorNombreJugador
                </div>
                <div class="grupo-control">
                    <label>Equipo:</label> <input class="control" type="text" name="equipo" value="$equipo" />$errorEquipo
                </div>
                <div class="grupo-control">
                    <label>Dorsal:</label> <input class="control" type="number" name="dorsal" value="$dorsal" />$errorDorsal
                </div>
                <div class="grupo-control">
                    <label>Goles:</label> <input class="control" type="number" name="golesJugador" value="$goles" />$errorGoles
                </div>
                <div class="grupo-control">
                    <label>Asistencias:</label> <input class="control" type="number" name="asistenciasJugador" value="$asistencias" />$errorAsistencias
                </div>
                <div class="grupo-control">
                    <label>Salvadas:</label> <input class="control" type="number" name="salvadasJugador" value="$salvadas" />$errorSalvadas
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Añadir jugador</button></div>
            </fieldset>
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
        
        if ( empty($dorsal) || mb_strlen($nombreJugador) < 1 ) {
            $result['dorsal'] = "El dorsal del Jugador esta vacío";
        }

        if ( mb_strlen($nombreJugador) > 99 ) {
            $result['dorsal'] = "El dorsal del Jugador debe de ser entre 1 y 99";
        }

        $golesJugador = $datos['golesJugador'] ?? null;
        
        if ( empty($golesJugador)) {
            $result['goles'] = "El campo esta vacío";
        }

        $asistenciasJugador = $datos['asistenciasJugador'] ?? null;
        
        if ( empty($asistenciasJugador)) {
            $result['asistenciasJugador'] = "El campo esta vacío";
        }

        $salvadasJugador = $datos['salvadasJugador'] ?? null;
        
        if ( empty($salvadasJugador) ) {
            $result['salvadasJugador'] = "El campo esta vacío";
        }
        
        if (count($result) === 0) {
            $jugador = Jugador::crea($nombreJugador, $equipo, $dorsal, $golesJugador, $asistenciasJugador, $salvadasJugador);
            if (!$jugador) {
                $result[] = "El jugador ya existe";
            } else {
                $result = 'index.php';
            }
        }
        return $result;
    }
}
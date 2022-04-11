<?php

namespace es\fdi\ucm\aw;

class FormularioClasificacion extends Form{

    public function __construct() {
        parent::__construct('formClasificacion');
    }
    
    protected function generaCamposFormulario($datos, $errores = array()){
        $puntos = $datos['puntos'] ?? '';
        $ganados = $datos['ganados'] ?? '';
        $empatados = $datos['empatados'] ?? '';
        $perdidos = $datos['perdidos'] ?? '';
        $golesmarcados = $datos['golesmarcados'] ?? '';
        $golesrecibidos = $datos['golesrecibidos'] ?? '';
        $equipo = $datos['equipo'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorPuntos = self::createMensajeError($errores, 'puntos', 'span', array('class' => 'error'));
        $errorGanados = self::createMensajeError($errores, 'ganados', 'span', array('class' => 'error'));
        $errorEmpatados = self::createMensajeError($errores, 'empatados', 'span', array('class' => 'error'));
        $errorPerdidos = self::createMensajeError($errores, 'perdidos', 'span', array('class' => 'error'));
        $errorMarcados = self::createMensajeError($errores, 'golesmarcados', 'span', array('class' => 'error'));
        $errorRecibidos = self::createMensajeError($errores, 'golesrecibidos', 'span', array('class' => 'error'));
        $errorEquipo = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));

        $html = <<<EOF
            <div class="content">
                $htmlErroresGlobales
                <div class="grupo-control">
                    <p><label>Equipo:</label> <input class="control" type="text" name="equipo" value="$equipo" />$errorEquipo
                </div>
                <div class="grupo-control">
                    <p><label>Puntos:</label> <input class="control" type="text" name="puntos" value="$puntos" />$errorPuntos
                </div>
                <div class="grupo-control">
                    <p><label>Partidos ganados:</label> <input class="control" type="text" name="ganados" value="$ganados" />$errorGanados
                </div>
                <div class="grupo-control">
                    <p><label>Partidos empatados:</label> <input class="control" type="text" name="empatados" value="$empatados" />$errorEmpatados
                </div>
                <div class="grupo-control">
                    <p><label>Partidos perdidos:</label> <input class="control" type="text" name="perdidos" value="$perdidos" />$errorPerdidos
                </div>
                <div class="grupo-control">
                    <p><label>Goles marcados:</label> <input class="control" type="text" name="golesmarcados" value="$golesmarcados" />$errorMarcados
                </div>
                <div class="grupo-control">
                    <p><label>Goles recibidos:</label> <input class="control" type="text" name="golesrecibidos" value="$golesrecibidos" />$errorRecibidos
                </div>
                <div class="grupo-control"><button type="submit" name="registro">Añadir datos</button></div>
            </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos){
        $result = array();
        
        $puntos = $datos['puntos'] ?? null;
        if ( empty($puntos)) {
            $result['puntos'] = "El campo puntos esta vacío";
        }

        $ganados = $datos['ganados'] ?? null;
        if ( empty($ganados)) {
            $result['ganados'] = "El campo ganados esta vacío";
        }

        $empatados = $datos['empatados'] ?? null;
        if ( empty($empatados)) {
            $result['empatados'] = "El campo empatados esta vacío";
        }

        $perdidos = $datos['perdidos'] ?? null;
        if ( empty($perdidos)) {
            $result['perdidos'] = "El campo perdidos esta vacío";
        }

        $golesmarcados = $datos['golesmarcados'] ?? null;
        if ( empty($golesmarcados)) {
            $result['golesmarcados'] = "El campo goles marcados esta vacío";
        }

        $golesrecibidos = $datos['golesrecibidos'] ?? null;
        if ( empty($golesrecibidos)) {
            $result['golesrecibidos'] = "El ncampo goles recibidos esta vacío";
        }

        $equipo = $datos['equipo'] ?? null;
        if ( empty($equipo)) {
            $result['equipo'] = "El campo equipo esta vacío";
        }

        $eq = Equipo::buscaNombre($equipo);
        if(!$eq){
            $result['nombre'] = "El equipo no se ha encontrado";
        }
        
        if (count($result) === 0) {
            $id = $eq->getId();
            $equipo = Clasificacion::crea($id,$puntos,$ganados,$empatados,$perdidos,$golesmarcados,$golesrecibidos);
            if (!$equipo) {
                $result[] = "El equipo ya esta actualizado";
            } else {
                $result = 'index.php';
            }
        }
        return $result;
    }
}
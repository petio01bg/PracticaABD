<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Info Equipo';

$equipo = $_POST["equipo"];

if(!empty($equipo)){
    $e = \es\fdi\ucm\aw\Equipo::buscaNombre($equipo);
    if($e){
        $c = \es\fdi\ucm\aw\Clasificacion::buscaEquipoClasificacion($e->getId());
        if($c){

            $nombre = $e->getNombre();
            $puntos = $c->getPuntos();
            $ganados = $c->getGanados();
            $perdidos = $c->getPerdidos();
            $empatados = $c->getEmpatados();
            $marcados = $c->getMarcados();
            $recibidos = $c->getRecibidos();
            $jornadas = $ganados + $perdidos + $empatados;
            $diferencia = $marcados - $recibidos;


            $contenidoPrincipal = <<<EOF
		    <div>
            <table>
            <thead>
            <tr>
            <th>EQUIPO</th>
            <th>JORNADAS</th>
            <th>PUNTOS</th>
            <th>P.GANADOS</th>
            <th>P.EMPATADOS</th>
            <th>P.PERDIDOS</th>
            <th>GOLES MARCADOS</th>
            <th>GOLES RECIBIDOS</th>
            <th>DIFERENCIA</th>
            </tr>
            </thead>
            <tr>
				<td>{$nombre}</td>
				<td>{$jornadas}</td>
				<td>{$puntos}</td>
				<td>{$ganados}</td>
                <td>{$empatados}</td>
                <td>{$perdidos}</td>
                <td>{$marcados}</td>
                <td>{$recibidos}</td>
                <td>{$diferencia}</td>
			</tr>
            </table>	
EOF;
        }
        else{
            $contenidoPrincipal = <<<EOF
		    <h1>El equipo no esta clasificado</h1>
EOF;
        }
    }
    else{
        $contenidoPrincipal = <<<EOF
		    <h1>No se ha encontrado el equipo biscado</h1>
EOF;
    }
}
else{
    $contenidoPrincipal = <<<EOF
		    <h1>El campo esta vacío</h1>
EOF;
}


include __DIR__.'/includes/plantillas/plantilla.php';
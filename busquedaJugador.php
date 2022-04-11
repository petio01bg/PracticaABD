<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Info Equipo';

$equipo = $_POST["equipo"];
$dorsal = $_POST["dorsal"];
$jugador = $_POST["jugador"];

if(!empty($equipo) && !empty($dorsal) && !empty($jugador)){
    $j = \es\fdi\ucm\aw\Jugador::buscaJugadorNombre($jugador,$equipo,$dorsal);
    if($j){

            $nombre =$j->getNombreJugador();
            $eq = $j->getEquipo();
            $dr = $j->getDorsal();
            $goles = $j->getGoles();
            $asistencias = $j->getAsistenacias();
            $salvadas = $j->getSalvadas();


            $contenidoPrincipal = <<<EOF
		    <div>
            <table>
            <thead>
            <tr>
            <th>JUGADOR</th>
            <th>EQUIPO</th>
	        <th>DORSAL</th>
	        <th>GOLES</th>
            <th>ASISTENCIAS</th>
            <th>SALVADAS</th>
            </tr>
            </thead>
            <tr>
				<td>{$nombre}</td>
				<td>{$eq}</td>
				<td>{$dr}</td>
				<td>{$goles}</td>
                <td>{$asistencias}</td>
                <td>{$salvadas}</td>
			</tr>
            </table>	
EOF;
        
    }
    else{
        $contenidoPrincipal = <<<EOF
		    <h1>No se ha encontrado el jugador buscado</h1>
EOF;
    }
}
else{
    $contenidoPrincipal = <<<EOF
		    <h1>Hay campos que estan vacíos</h1>
EOF;
}


include __DIR__.'/includes/plantillas/plantilla.php';
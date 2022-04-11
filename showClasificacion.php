<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Clasificacion';

if (!isset($_SESSION["login"])) {
	$contenidoPrincipal = <<<EOF
	<h1>Usuario no registrado!</h1>
	<p>Debes iniciar sesión para ver la clasificacion</p>
EOF;
} 
else {
	$app = \es\fdi\ucm\aw\Aplicacion::getInstancia();
	$con = $app->conexionBd();
	$query = sprintf("SELECT idEquipo FROM clasificacion ORDER BY puntos DESC");
    $rs = $con->query($query);

	$equipos=array();
	$cont = 0;
	while($fila = $rs->fetch_assoc()){
		$equipos[$cont] = $fila["idEquipo"];
		$cont++;
	}

    $contenidoPrincipal = <<<EOF
		<div>
   <h1 class = "move"> 
   <span>CLASIFICACIÓN DE LA LIGA SANTANDER</span>
   <div class="liquid"></div>
   </h1>
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
EOF;

for($i = 0; $i < $cont; $i++){
	$equipo = \es\fdi\ucm\aw\Equipo::buscaEquipo($equipos[$i]);
    $clas = \es\fdi\ucm\aw\Clasificacion::buscaEquipoClasificacion($equipos[$i]);

    if($equipo && $clas){

	$nombre = $equipo->getNombre();
    $puntos = $clas->getPuntos();
    $ganados = $clas->getGanados();
    $perdidos = $clas->getPerdidos();
    $empatados = $clas->getEmpatados();
    $marcados = $clas->getMarcados();
    $recibidos = $clas->getRecibidos();
    $jornadas = $ganados + $perdidos + $empatados;
    $diferencia = $marcados - $recibidos;

	
		$contenidoPrincipal.=<<<EOF
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
EOF;
    }
}

$contenidoPrincipal.=<<<EOF
</table>		
EOF;
$rs->free();
}

include __DIR__.'/includes/plantillas/plantilla.php';
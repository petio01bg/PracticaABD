<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Administrar';
$contenidoPrincipal = '';
if (isset($_SESSION["esAdmin"]) && $_SESSION["esAdmin"]) {
	$contenidoPrincipal .= <<<EOF
		<h1>Consola de administración</h1>
		<p>Aquí estarían todos los controles de administración</p>
EOF;
   	} else {
		   $contenidoPrincipal .= <<<EOF
		   <h1>Acceso denegado!</h1>
		   <p>No tienes permisos suficientes para administrar la web.</p>
EOF;
	  }

include __DIR__.'/includes/plantillas/plantilla.php';
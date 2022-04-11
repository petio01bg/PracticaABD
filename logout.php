<?php
require_once __DIR__.'/includes/config.php';

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["esAdmin"]);
unset($_SESSION["nombre"]);

session_destroy();
session_start();
$tituloPagina = 'Logout';
$contenidoPrincipal = <<<EOF
<div class="move">
		<h1>Hasta pronto!</h1>
</div>
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';
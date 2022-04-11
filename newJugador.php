<?php
require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioJugador();

$tituloPagina = 'Nuevo Jugador';
$contenidoPrincipal = <<<EOF
		<h1>Añadir nuevo jugador</h1>
EOF;
$htmlFormLogin = $form->gestiona();
$contenidoPrincipal .= $htmlFormLogin;

include __DIR__.'/includes/plantillas/plantilla.php';
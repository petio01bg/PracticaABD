<?php

require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioBorraJugador();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Borrar Jugador';
$contenidoPrincipal = <<<EOF
	<div class="move">
		<h1>Borrar Jugador</h1>
	</div>
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';
<?php

require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioBorraEquipo();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Borrar Equipo';
$contenidoPrincipal = <<<EOF
	<div class="move">
		<h1>Borrar Equipo</h1>
	</div>
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';
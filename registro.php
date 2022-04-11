<?php

require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal = <<<EOF
	<div class="move">
		<h1>Registro de usuario</h1>
	</div>
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';
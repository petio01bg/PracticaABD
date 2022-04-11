<?php

require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal = <<<EOF
		<h1>Registro de usuario</h1>
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';
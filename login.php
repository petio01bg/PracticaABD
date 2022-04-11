<?php
require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioLogin();

$tituloPagina = 'Login';
$contenidoPrincipal = <<<EOF
	<div class="move">
		<h1>Iniciar sesión</h1>
	</div>
EOF;
$htmlFormLogin = $form->gestiona();
$contenidoPrincipal .= $htmlFormLogin;

include __DIR__.'/includes/plantillas/plantilla.php';
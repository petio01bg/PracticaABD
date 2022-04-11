<?php
require_once __DIR__.'/includes/config.php';

$form = new es\fdi\ucm\aw\FormularioEquipo();

$tituloPagina = 'Nuevo Equipo';
$contenidoPrincipal = <<<EOF
<div class="move">
		<h1>Añadir nuevo equipo</h1>
</div>
EOF;
$htmlFormLogin = $form->gestiona();
$contenidoPrincipal .= $htmlFormLogin;

include __DIR__.'/includes/plantillas/plantilla.php';
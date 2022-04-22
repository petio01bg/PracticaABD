<?php
//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Portada';
$contenidoPrincipal = <<<EOS
<h1>Página principal</h1>
<p> En esta página podrás encontrar todo tipo de información de la mejor liga del mundo <color>LA LIGA SANTADER</color>.
Los máximos goleadores, la clasificación, los máximos asistentes y <color>mucho más</color></p>
<p> Registrate en un nuestra página para poder ver toda la información, si ya lo estás logeate totalmete gratuito </p>
<div align='center'>
<img src='logo.png' width="400" height="400">
</div>
EOS;

include __DIR__.'/includes/plantillas/plantilla.php';

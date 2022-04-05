<?php
$paginas = array('Juegos'=>'juegos.php','Tienda' => 'tienda.php', 'Ranking'=>'ranking.php', 'Eventos'=>'eventos.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

if (!( isset( $_GET['type']) && $_GET['type'] = "home" )){
    $paginas = array('Home' => 'index.php') + $paginas;
}
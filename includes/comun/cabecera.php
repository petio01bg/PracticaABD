<?php
function mostrarSaludo() {
	if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
		echo "Bienvenido, " . $_SESSION['nombre'] . ".<a href='logout.php'>(salir)</a>";
		
	} else {
		echo "Usuario desconocido. <a href='login.php'>Login</a> <a href='registro.php'>Registro</a>";
	}
}
?>
<header>
	<div class="logo">
		<img src='img/logo2.png' width="100" height="100">
	</div>
	<h1>FUTBOLMANIA</h1>
	<div class="saludo">
	<?php
		mostrarSaludo();
	?>
	</div>
</header>
<?php
$tituloPagina = "Inicio";
?>

<!DOCTYPE html>
<html lang='es'>
	<head>
        <meta charset="UTF-8">
		<title><?= $tituloPagina ?></title>
	</head>
	<body>

			<div class = "wrapper">
				<div class = "parallax_section">
					<div class = "parallax_level1"></div>

						<header>
								<img id="logo" src= "<?=$app->resuelve(RUTA_IMGS."logo/Chestnut_Logo.png")?>" alt="logo" >
								<h1> ChestNut Games </h1>
									<?php
										$_GET['type']="home";
										$app->doInclude("/vistas/comun/header.php");
									?>		
						</header>
						<p id="inicio">
								Bienvenido a la mejor pagina de fútbol, resultados, noticias y jugadores.
                    	</p> 
				</div>

				<div class = "parallax_section">
					<div class = "parallax_level2"></div>
						
						<main>
								<!-- Main Page -->
						</main>

						<footer>
								<!-- Aqui ira el pie de pagina -->
						</footer>

				</div>
			</div>

	</body>
</html>
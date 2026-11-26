<?php require_once '../include/antiIntruccion_and_Testin.php'; ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>GYM-Sena</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php require_once 'head.php'; ?> 		
	</head>
	<body class="bg-light" oncontextmenu="return false" onkeydown="return false">		
		<?php require_once 'hederMenu.php'; ?> 
		<!-- ================= INICIO CONTENIDO DE CADA PAGINA ================= -->
			<main class="col p-4 min-vh-100">
			<!-- ================= CONTENIDO PRINCIPAL ================= -->
			<main class="col-lg-9 col-xl-10 p-4">
				<h1 class="h3">Bienvenido</h1>
				<p>Aquí va el contenido de la página.</p>
			</main>
		<?php require_once 'fooderMenu.php'; ?> 

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// Reemplaza lo que antes hacía PHP: $_SESSION['loguinUsuSesion']
		// Cambia este valor o léelo de localStorage / una API.
		const usuario = localStorage.getItem('loguinUsuSesion') || 'Usuario';
		document.querySelectorAll('.nombre-usuario').forEach(el => el.textContent = usuario);

		// Botones de salir
		function salir() {
			localStorage.removeItem('loguinUsuSesion');
			window.location.href = '../../index.php';
		}
		document.getElementById('opSalir1').addEventListener('click', salir);
		document.getElementById('opSalir2').addEventListener('click', salir);
	</script>

	</body>
</html>
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
				<h1 class="h3">FORMAULRIO DE INGRESO ROL</h1>

				<!--inicio de botones!-->

				<div class="card shadow-sm mt-4">
					<div class="card-body">
						<div class="row g-2 align-items-end">
							<div class="col-md-8">
								<label for="txtArea" class="form-label">Nombre del Rol</label>
								<!-- stopPropagation permite escribir aunque el body tenga onkeydown="return false" -->
								<input type="text" class="form-control" id="txtArea" name="txtArea"
									   placeholder="Escriba el nombre del Rol" onkeydown="event.stopPropagation()">
							</div>
							<div class="col-md-4 d-grid">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRol">
									Abrir modal
								</button>

								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRol">
									Buscar
								</button>
							</div>
						</div>
					</div>
				</div>

			<!--fin de botones!-->

			<!--   inicio de modal crear rutina --> 				
			<div class="modal fade" id="modalRol" tabindex="-1" aria-labelledby="modalAreaLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalAreaLabel">Rol ingresado</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
							</div>
							<div class="modal-body">
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Ingrese el nombre del usuario</label>
									<input type="text" id='numeroIdentificacionUsuario' name='numeroIdentificacionUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese el nombre' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Seleccione el rol del usuario</label>
									<select id='idArea_FK' name='idArea_FK' class="form-control" title='' style='cursor:pointer;' >
											<option value='0' >Seleccione:</option>
											<option value='1' >Aprendiz</option>
											<option value='2' >Instructor</option>
											<option value='3' >Funcionario</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-success">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			<!--   cierre de modal crear rutina -->
			</main>
		<!-- ================= CIERRE CONTENIDO DE CADA PAGINA ================= -->
		<?php require_once 'fooderMenu.php'; ?> 
	</body>
</html>
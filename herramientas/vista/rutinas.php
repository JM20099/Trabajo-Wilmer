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
				<h1 class="h3">FORMULARIO DE RUTINAS</h1>

			<!--inicio de botones!-->

				<div class="card shadow-sm mt-4">
					<div class="card-body">
						<div class="row g-2 align-items-end">
							<div class="col-md-8">
								<label for="txtArea" class="form-label">Nombre de la rutina</label>
								<!-- stopPropagation permite escribir aunque el body tenga onkeydown="return false" -->
								<input type="text" class="form-control" id="txtArea" name="txtArea"
									   placeholder="Escriba el nombre de la rutina" onkeydown="event.stopPropagation()">
							</div>
							<div class="col-md-4 d-grid">
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRutinas">
									Añadir Rutina
								</button>

								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRutinas">
									Buscar
								</button>
							</div>
						</div>
					</div>
				</div>

			<!--fin de botones!-->

			<!--   inicio de modal crear rutina --> 				
			<div class="modal fade" id="modalRutinas" tabindex="-1" aria-labelledby="modalAreaLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalAreaLabel">Creacion de Rutinas</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
							</div>
							<div class="modal-body">	
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Nombre del Instructor</label>
									<input type="text" id='numeroIdentificacionUsuario' name='numeroIdentificacionUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese su nombre' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Nombre de la rutina</label>
									<input type="text" id='nombresUsuario' name='nombresUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese el nombre de la rutina' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Ejercicio</label>
									<select id='idArea_FK' name='idArea_FK' class="form-control" title='' style='cursor:pointer;' >
											<option value='0' >Seleccione:</option>
											<option value='1' >Sentadillas</option>
											<option value='2' >Zancada</option>
											<option value='3' >Prensa de piernas</option>
											<option value='4' >Peso muerto</option>
											<option value='5' >Burpees</option>
									</select>
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Nivel de la rutina</label>
									<select id='idArea_FK' name='idArea_FK' class="form-control" title='' style='cursor:pointer;' >
											<option value='0' >Seleccione:</option>
											<option value='1' >principiante</option>
											<option value='2' >intermedio</option>
											<option value='3' >Avanzado</option>
									</select>
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Nuevo Ejercicio</label>
									<input type="text" id='nombresUsuario' name='nombresUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese el nombre del ejercicio' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Series del Ejercicio</label>
									<input type="text" id='nombresUsuario' name='nombresUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese el nombre de la rutina' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Repeticiones del Ejercicio</label>
									<input type="text" id='nombresUsuario' name='nombresUsuario' class="form-control" title='' style='cursor:pointer;' placeholder='Ingrese el nombre de la rutina' >
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Musculo que se entrena el ejercicio</label>
									<select id='idArea_FK' name='idArea_FK' class="form-control" title='' style='cursor:pointer;' >
											<option value='0' >Seleccione:</option>
											<option value='1' >Pectoral mayor:</option>
											<option value='2' >Trapecio</option>
											<option value='3' >Recto abdominal</option>
									</select>
								</div>
								<div class="mb-3">
									<labelfor="recipient-name" class="col-form-label">Parte del cuerpo a la que pertenece ese musculo</label>
									<select id='idArea_FK' name='idArea_FK' class="form-control" title='' style='cursor:pointer;' >
											<option value='0' >Seleccione:</option>
											<option value='1' >Pecho</option>
											<option value='2' >Espalda</option>
											<option value='3' >brazos</option>
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
<?php		
	if (realpath(__FILE__) === realpath($_SERVER["SCRIPT_FILENAME"])) 
		{				
			// Cabeceras de seguridad ----------
			header('Content-Type: text/html; charset=utf-8');
			header('X-Content-Type-Options: nosniff');
			header('X-Frame-Options: DENY');
			header('Referrer-Policy: same-origin');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			// ---------- Sesión ----------
			// 'secure' solo se activa si hay HTTPS, para que siga funcionando en localhost por HTTP.
			$esHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
			ini_set('session.use_strict_mode', '1');
			ini_set('session.use_only_cookies', '1');
			session_set_cookie_params([
				'lifetime' => 0,
				'path'     => '/',
				'secure'   => $esHttps,
				'httponly' => true,
				'samesite' => 'Lax',
			]);
			function cerrarSesion(): void{
				$_SESSION = [];
				if (ini_get('session.use_cookies')) {
					$p = session_get_cookie_params();
					setcookie(session_name(), '', [
						'expires'  => time() - 42000,
						'path'     => $p['path'],
						'domain'   => $p['domain'],
						'secure'   => $p['secure'],
						'httponly' => $p['httponly'],
						'samesite' => $p['samesite'] ?: 'Lax',
					]);
				}
				session_destroy();
			}
			/** Devuelve el parámetro solo si es texto (evita arreglos como correoUsu[]=x). */
			function entrada(array $origen, string $clave): string 
				{	$valor = $origen[$clave] ?? '';		return is_string($valor) ? $valor : '';		}
			function redirigirInicio(): void {	header('Location: ../../index.php'); exit;	}
			include('../include/conex.php');			
			ini_set('session.cookie_httponly', 1);
			ini_set('session.use_strict_mode', 1);
			ini_set('session.cookie_secure',   1);									
			session_start();						
			$opcion = entrada($_POST, 'opcion');
			if ($opcion === '') { 	$opcion = entrada($_GET, 'opcion');		}			
			$correoUsu = trim(entrada($_POST, 'correoUsu'));
			//usted decide cual dejar			
			//$claveUsu  = entrada($_POST, 'claveUsu'); // no quita espacios. la clave puede tener espacios.
			$claveUsu = trim(entrada($_POST, 'claveUsu'));// si quita espacios. pueda que presente problemas, al ingresar la clave y el sistema quita espacios.
			if(isset($opcion) && isset($correoUsu) && isset($claveUsu))
			{
				try{						
					switch($opcion){
						case 'iniciarLogueo':							
							// Las credenciales solo se aceptan por POST (nunca en la URL)
							if ($_SERVER['REQUEST_METHOD'] !== 'POST') {	http_response_code(405); echo '0'; break;	}
								$estado = '0';
								$query = "SELECT  usu.idusuario, usu.correoinstitucionalusuario,
										  CONCAT(SUBSTRING_INDEX(TRIM(nombreusuario), ' ', 1), ' ', SUBSTRING_INDEX(TRIM(apellidosusuario), ' ', 1)) as usuLoguedao, 
										  usu.password, tp.nombretiposdeusuarios, tp.idtipodeusuario 		  
										  FROM usuarios usu
										  INNER JOIN tipos_de_usuarios tp ON tp.idtipodeusuario = usu.idtipodeusuario
										  WHERE usu.correoinstitucionalusuario = ?
										  AND usu.password = ? ;";

									

								$resultQuery = $conexion->prepare($query);
								$resultQuery->bind_param("ss", $correoUsu, $claveUsu);
								$resultQuery->execute();
								$vector = $resultQuery->get_result();
								while ($datos_fila = $vector->fetch_assoc())
									{
										session_regenerate_id(true);
										$_SESSION = array();
										$_SESSION['idUuarioSesion'] = $datos_fila['idusuario'];
										$_SESSION['correoUsuSesion'] = $datos_fila['correoinstitucionalusuario'];
										$_SESSION['idrolSesion'] = $datos_fila['idtipodeusuario'];
										$_SESSION['nombreRolSesion'] = $datos_fila['nombretiposdeusuarios'];
										$_SESSION['loguinUsuSesion'] = $datos_fila['usuLoguedao'];
										$estado = '1';						
									}echo $estado;
								$resultQuery->close();
						break;
						case 'activarUsuario':
							echo "<br>Dentro de nueva clave.";
						break;
						case 'nueva_clave':
							echo "<br>Dentro de nueva clave.";
						break; 			
						case 'salir':
							cerrarSesion();
							redirigirInicio();
						exit;
						default:
							echo "<br>Error de selección";
						break;
					}	
				} catch (Throwable $e) {
					// El detalle va al log del servidor, nunca al navegador
					error_log('loguinControl.php: ' . $e->getMessage());
					http_response_code(500);
					echo '0';
				}				
			} else{ redirigirInicio(); 	}
		} else { redirigirInicio(); }
?>
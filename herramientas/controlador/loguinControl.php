<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]))    // si el archivo es llamado directamente, redirigir a index.php
    { header("Location: ../../index.php"); }
else
    {
        header('Content-Type: text/html; charset=utf-8');
        include('../include/conex.php');
        session_start();        //session_start es necesario para poder usar variables de sesión
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_strict_mode', 1);  //usar modelos unicos del sistema como por ejemplo https
        ini_set('session.cookie_secure',   1);  //solo se puede usar en https
        if (isset($_SERVER['HTTPS'])) { ini_set('session.cookie_secure', 1); }   //si hhtps esta vacio entonces inicia session.cookie_secure
        $opcion  = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_STRING);
        if(isset($correoUsu) && isset($claveUsu) && isset($opcion)){						
					switch($opcion){
						case 'iniciarLogueo':							
							$correoUsu = filter_input(INPUT_POST, 'correoUsu', FILTER_SANITIZE_EMAIL);
							$claveUsu   = filter_input(INPUT_POST, 'claveUsu', FILTER_SANITIZE_STRING);
							$query = "SELECT
										usu.idUsuario,
										usu.correoInstitucionalUsuario,
										usu.contrasenaUsuario,
										rl.nombreRol, rl.idRol,
										FROM usuarios usu
										INNER JOIN rol rl ON rl.idRol = usu.idRol
										WHERE usu.correoInstitucionalUsuario = ?
										AND usu.contrasenaUsuario = ? ;";
							$resultQuery = $conexion->prepare($query);
							$resultQuery->bind_param("ss", $correoUsu, $claveUsu);      //bind_param() se utiliza para vincular los parámetros a la consulta preparada. En este caso, se están vinculando dos parámetros de tipo string (ss) a la consulta, que corresponden a las variables $correoUsu y $claveUsu. Esto ayuda a prevenir ataques de inyección SQL al asegurarse de que los valores se traten como datos y no como parte de la consulta SQL y ss es para indicar que son dos parametros de tipo string, si fueran enteros seria ii, si fueran un string y un entero seria si y bind_param es 
							$resultQuery->execute();
							$vector = $resultQuery->get_result();           //vector es un objeto que contiene el resultado de la consulta ejecutada. Se utiliza para almacenar los datos obtenidos de la base de datos y poder iterar sobre ellos posteriormente.
							while ($datos_fila = $vector->fetch_assoc())    //fetch_assoc() es un método que se utiliza para obtener una fila de resultados de la consulta como un array asociativo. Cada vez que se llama a fetch_assoc(), se obtiene la siguiente fila de resultados hasta que no haya más filas disponibles. En este caso, se está utilizando dentro de un bucle while para iterar sobre todas las filas obtenidas de la consulta y procesarlas una por una.
								{
									session_regenerate_id(true);
									$_SESSION = array();      //array() es una función que se utiliza para crear un array vacío. En este caso, se está utilizando para reiniciar la variable de sesión $_SESSION y asegurarse de que no haya datos antiguos almacenados en ella antes de asignar nuevos valores.
									$_SESSION['idUsuarioSesion'] = $datos_fila['idUsuario'];
									$_SESSION['correoUsuSesion'] = $datos_fila['correoInstitucionalUsuario'];
									$_SESSION['idrolSesion'] = $datos_fila['idRol'];
									$_SESSION['nombreRolSesion'] = $datos_fila['nombreRol'];
									$_SESSION['loguinUsuSesion'] = $datos_fila['usuLoguedao'];
									$estado = '1';	
									echo "todo bien";
									exit();					
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
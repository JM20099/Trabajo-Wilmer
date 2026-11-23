<?php
if (realpath(__FILE__) === realpath($_SERVER["SCRIPT_FILENAME"]))     // si el archivo es ejecutado directamente, es decir, si el archivo es accedido directamente a través de la URL en lugar de ser incluido por otro archivo, entonces se ejecuta el bloque de código dentro del if.

    {
        header('Content-Type: text/html; charset=utf-8');
        include('../include/conex.php');
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_strict_mode', 1);  //usar modelos unicos del sistema como por ejemplo https
        ini_set('session.cookie_secure',   1);  //solo se puede usar en https
		session_start();        //session_start es necesario para poder usar variables de sesión
        $opcion = $_POST['opcion'] ?? '';  //operador de fusión de null, si $_POST['opcion'] no está definido, se asigna una cadena vacía a $opcion
		$correoUsu = $_POST['correoUsu'] ?? '';
		$claveUsu = $_POST['claveUsu'] ?? '';
        if(isset($opcion) && isset($correoUsu) && isset($claveUsu)){	
				try{					
					switch($opcion){
						case 'iniciarLogueo':	
							$estado = '0';  //estado es una variable que se utiliza para indicar el estado del inicio de sesión. Inicialmente se establece en '0', lo que significa que el inicio de sesión no ha sido exitoso. Si se encuentra un usuario válido en la base de datos, se cambiará a '1' para indicar que el inicio de sesión fue exitoso.						
							$query = "SELECT
										usu.idUsuario,
										usu.correoUsuario,
										usu.contrasenaUsuario,
										rl.nombreRol, rl.idRol,
										FROM usuarios usu
										INNER JOIN rol rl ON rl.idRol = usu.idRol
										WHERE usu.correoUsuario = ?
										AND usu.contrasenaUsuario = ? ;";
							$resultQuery = $conexion->prepare($query);
							$resultQuery->bind_param("ss", $correoUsu, $claveUsu);      //bind_param() se utiliza para vincular los parámetros a la consulta preparada. En este caso, se están vinculando dos parámetros de tipo string (ss) a la consulta, que corresponden a las variables $correoUsu y $claveUsu. Esto ayuda a prevenir ataques de inyección SQL al asegurarse de que los valores se traten como datos y no como parte de la consulta SQL y ss es para indicar que son dos parametros de tipo string, si fueran enteros seria ii, si fueran un string y un entero seria si y bind_param es 
							$resultQuery->execute();
							$vector = $resultQuery->get_result();           //vector es un objeto que contiene el resultado de la consulta ejecutada. Se utiliza para almacenar los datos obtenidos de la base de datos y poder iterar sobre ellos posteriormente.
							while ($datos_fila = $vector->fetch_assoc())    //fetch_assoc() es un método que se utiliza para obtener una fila de resultados de la consulta como un array asociativo. Cada vez que se llama a fetch_assoc(), se obtiene la siguiente fila de resultados hasta que no haya más filas disponibles. En este caso, se está utilizando dentro de un bucle while para iterar sobre todas las filas obtenidas de la consulta y procesarlas una por una.
								{
									session_regenerate_id(true);
									$_SESSION = array();      //array() es una función que se utiliza para crear un array vacío. En este caso, se está utilizando para reiniciar la variable de sesión $_SESSION y asegurarse de que no haya datos antiguos almacenados en ella antes de asignar nuevos valores.
									$_SESSION['idUsuarioSesion'] = $datos_fila['idUsuario'];       //$_SESSION es una superglobal en PHP que se utiliza para almacenar datos de sesión. En este caso, se están asignando valores a diferentes claves dentro del array $_SESSION para almacenar información del usuario que ha iniciado sesión. Por ejemplo, $_SESSION['idUsuarioSesion'] almacena el ID del usuario, $_SESSION['correoUsuSesion'] almacena el correo electrónico del usuario, y así sucesivamente. Estos valores se pueden utilizar en otras partes de la aplicación para identificar al usuario y mantener su sesión activa.
									$_SESSION['correoUsuSesion'] = $datos_fila['correoInstitucionalUsuario'];
									$_SESSION['idrolSesion'] = $datos_fila['idRol'];
									$_SESSION['nombreRolSesion'] = $datos_fila['nombreRol'];
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
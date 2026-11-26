function salir() {
			localStorage.removeItem('loguinUsuSesion');
			window.location.href = '../../index.php';
		}
		document.getElementById('opSalir1').addEventListener('click', salir);
		document.getElementById('opSalir2').addEventListener('click', salir);
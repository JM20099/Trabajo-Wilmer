$ (document).ready(function() {          // codigo inicial para inicializar el script cuando el documento este listo
    //alert('JE JE JE JE JE...... COMO TAS....!!!!!!');      // Crear una alerta

	function esCorreo(texto) {
		const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return regex.test(texto.trim());
		}

	

    $("#entrarBtn").click(function() 
	{        // entrarBtn es el id o name del boton de login

		/*var correo = $("#correoUsu").val().trim(); // Obtener el valor del campo de correo y eliminar espacios en blanco al inicio y al final
		if (!esCorreo(correo)) { // Validar si el correo es válido
			Swal.fire({
				title: "Correo válido",
				icon: "warning",
				draggable: true
			});
			$("#correoUsu").focus();
			return;
		}else{
			Swal.fire({
				title: "Correo no válido",
				icon: "warning",
				draggable: true
			});
		}

		exit();*/

		if ($("#correoUsu").val()==""){        // Validar si el campo de correo esta vacio y si esta vacio mostrar un mensaje de alerta
            Swal.fire({
				title: "Digite el correo Sena",
				icon: "warning",
				draggable: true
			});
			$("#correoUsu").focus();           //focus() es para que el cursor se coloque en el campo de correo
        }else{
			if ($("#claveUsu").val()==""){
				Swal.fire({
					title: "Digite la clave",
					icon: "warning",
					draggable: true
				});
				$("#claveUsu").focus();				
			}else{	
				
				$.ajax({               //ajax es una función de jQuery que permite enviar y recibir datos de un servidor de manera asincrónica sin tener que recargar la página completa
					url: "herramientas/controlador/loguinControl.php", type: "POST",        //url es la ruta del archivo que se va a ejecutar, type es el tipo de petición que se va a realizar (POST o GET)
					data: { 
						opcion : "iniciarLogueo",
						correoUsu: $("#correoUsu").val(),      //val() es una función de jQuery que permite obtener o establecer el valor de un elemento del formulario
						claveUsu: $("#claveUsu").val()
				},
					success: function(response) {
						var estado = String(response).trim();      //trim() es una función de JavaScript que elimina los espacios en blanco al inicio y al final de una cadena de texto. En este caso, se utiliza para asegurarse de que la respuesta del servidor no contenga espacios adicionales que puedan afectar la comparación posterior.
						if (estado === "0")
							{
								Swal.fire({
									title: "Acceso denegado",
									icon: "error",
									draggable: true
								});
							} else if (estado === "1")
							{
								//alert('Bien credenciales correctas...!! je je je je');
								Swal.fire({
									title: "Bienvenido",
									icon: "success",
									draggable: true
								});
								window.location.href = "herramientas/vista/inicio_principal.php";
							} else { alert("Respuesta inesperada del servidor: " + estado); }
					},
					error: function(xhr) {     //xhr es un objeto que contiene información sobre la solicitud AJAX que se realizó, incluyendo el estado de la respuesta y el texto de la respuesta. En este caso, se utiliza para mostrar un mensaje de error si la solicitud falla.
						alert("Error " + xhr.status + ": " + xhr.responseText);
					}
				
				});

			}

		}
    });         

    $("#activarBtn").click(function() {        // activarBtn es el id o name del boton de activación
		if ($("#correoUsu").val()==""){        // Validar si el campo de correo esta vacio y si esta vacio mostrar un mensaje de alerta
            alert('Para activar la cuenta, digite el correo');
			$("#correoUsu").focus();           //focus() es para que el cursor se coloque en el campo de correo
        }else{

        }
    });

});
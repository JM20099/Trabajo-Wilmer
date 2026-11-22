$ (document).ready(function() {          // codigo inicial para inicializar el script cuando el documento este listo
    //alert('JE JE JE JE JE...... COMO TAS....!!!!!!');      // Crear una alerta

    $("#entrarBtn").click(function() {        // entrarBtn es el id o name del boton de login
		if ($("#correoUsu").val()==""){        // Validar si el campo de correo esta vacio y si esta vacio mostrar un mensaje de alerta
            alert('Digite el correo sena');
			$("#correoUsu").focus();           //focus() es para que el cursor se coloque en el campo de correo
        }else{
			if ($("#claveUsu").val()==""){
				alert('Digite la clave');
				$("#claveUsu").focus();				
			}else{	
				
				$.ajax({               //ajax es una función de jQuery que permite enviar y recibir datos de un servidor de manera asincrónica sin tener que recargar la página completa
					url: "herramientas/controlador/loguinControl.php", type: "POST",        //url es la ruta del archivo que se va a ejecutar, type es el tipo de petición que se va a realizar (POST o GET)
					data: { 
						opcion : "iniciarLogueo",
						correoUsu: $("#correoUsu").val(),      //val() es una función de jQuery que permite obtener o establecer el valor de un elemento del formulario
						claveUsu: $("#claveUsu").val()
				},
					success: function(response) {				   //response es la respuesta que se recibe del servidor, success es una función de jQuery que se ejecuta cuando la petición se realiza correctamente			
						if (response.estado == 0) 
							{ alert("CREDENCIALES INCORRECTAS."); }
						else { window.location.href = "herramientas/controlador/menu.php";  }
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
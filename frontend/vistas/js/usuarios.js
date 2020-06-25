/* CAPTURA DE RUTA */
var rutaActual = location.href;
$(".btnIngreso, .facebook, .google").click(function(){
	localStorage.setItem("rutaActual", rutaActual);
})

/* FORMATEAR LOS IPUNT */
$("input").focus(function(){
	$(".alert").remove();
})

/* VALIDAR EMAIL REPETIDO */
var validarEmailRepetido = false;

$("#regEmail").change(function(){

	var email = $("#regEmail").val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({

		url:rutaOculta+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			
			if(respuesta == "false"){
				$(".alert").remove();
				validarEmailRepetido = false;

			}else{
				var modo = JSON.parse(respuesta).modo;
				if(modo == "directo"){
					modo = "esta página";
				}

				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue registrado a través de '+modo+', por favor ingrese otro diferente</div>')

					validarEmailRepetido = true;

			}
		}
	})
})

/* VALIDAR EL REGISTRO DE USUARIO */
function registroUsuario(){

	/* VALIDAR EL NOMBRE */
	var nombre = $("#regUsuario").val();

	if(nombre != ""){
		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
		if(!expresion.test(nombre)){
			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')
			return false;
		}
	}else{
		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		return false;
	}

	/* VALIDAR EL EMAIL */
	var email = $("#regEmail").val();
	if(email != ""){
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		if(!expresion.test(email)){
			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')
			return false;
		}
		if(validarEmailRepetido){
			$("#regEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>')
			return false;
		}
	}else{
		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		return false;
	}


	/* VALIDAR CONTRASEÑA */
	var password = $("#regPassword").val();
	if(password != ""){
		var expresion = /^[a-zA-Z0-9]*$/;
		if(!expresion.test(password)){
			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')
			return false;
		}
	}else{
		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		return false;
	}

	/* VALIDAR POLÍTICAS DE PRIVACIDAD */
	var politicas = $("#regPoliticas:checked").val();
	if(politicas != "on"){
		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')
		return false;
	}
	return true;
}

/* CAMBIAR FOTO */
$("#btnCambiarFoto").click(function(){
	$("#imgPerfil").toggle();
	$("#subirImagen").toggle();

})

$("#datosImagen").change(function(){
	var imagen = this.files[0];
	/* VALIDAMOS EL FORMATO DE LA IMAGEN*/
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
		$("#datosImagen").val("");
		swal({
		  title: "Error al subir la imagen",
		  text: "¡La imagen debe estar en formato JPG o PNG!",
		  type: "error",
		  confirmButtonText: "¡Cerrar!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = rutaOculta+"perfil";
				  } 
		});
	}

	else if(Number(imagen["size"]) > 2000000){
		$("#datosImagen").val("");
		swal({
		  title: "Error al subir la imagen",
		  text: "¡La imagen no debe pesar más de 2 MB!",
		  type: "error",
		  confirmButtonText: "¡Cerrar!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = rutaOculta+"perfil";
				  } 
		});

	}else{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src",  rutaImagen);
		})
	}
})

/* AGREGAR LISTA */
$(".deseos").click(function(){
	var idProducto = $(this).attr("idProducto");
	console.log("idProducto", idProducto);

	var idUsuario = localStorage.getItem("usuario");
	console.log("idUsuario", idUsuario);

	if(idUsuario == null){
		swal({
		  title: "Debe ingresar al sistema",
		  text: "¡Para agregar un LABORATORIO a 'MI LISTA' debe primero ingresar al sistema!",
		  type: "warning",
		  confirmButtonText: "¡Cerrar!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = rutaOculta;
				  } 
		});

	}else{

		$(this).addClass("btn-danger");

		var datos = new FormData();
		datos.append("idUsuario", idUsuario);
		datos.append("idProducto", idProducto);

		$.ajax({
			url:rutaOculta+"ajax/usuarios.ajax.php",
			method:"POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success:function(respuesta){				
			}
		})
	}
})

$(".quitarDeseo").click(function(){

	var idDeseo = $(this).attr("idDeseo");

	$(this).parent().parent().parent().remove();

	var datos = new FormData();
	datos.append("idDeseo", idDeseo);
	$.ajax({
			url:rutaOculta+"ajax/usuarios.ajax.php",
			method:"POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success:function(respuesta){
			}
		});
})

$("#eliminarUsuario").click(function(){

	var id = $("#idUsuario").val();
	if($("#modoUsuario").val() == "directo"){
		if($("#fotoUsuario").val() != ""){
			var foto = $("#fotoUsuario").val();
		}
	}
	swal({
		  title: "¿Está usted seguro(a) de eliminar su cuenta?",
		  text: "¡Si borrar esta cuenta ya no se puede recuperar los datos!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "¡Si, borrar cuenta!",
		  closeOnConfirm: false
		},
		function(isConfirm){
				 if (isConfirm) {	   
				    window.location = "index.php?ruta=perfil&id="+id+"&foto="+foto;
				  } 
		});

})



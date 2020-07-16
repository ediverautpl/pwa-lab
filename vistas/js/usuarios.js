/* CAPTURA DE RUTA */
var rutaActual = location.href;
$(".btnIngreso, .facebook, .google").click(function(){
	localStorage.setItem("rutaActual", rutaActual);
})

/* FORMATEAR LOS IPUNTS */
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



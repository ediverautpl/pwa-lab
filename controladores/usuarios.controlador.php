<?php

class ControladorUsuarios{


	/* MOSTRAR USUARIO */
	static public function ctrMostrarUsuario($item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
		return $respuesta;
	}

	/* ACTUALIZAR USUARIO */
	static public function ctrActualizarUsuario($id, $item, $valor){
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
		return $respuesta;

	}

	/* REGISTRO CON REDES SOCIALES */
	static public function ctrRegistroRedesSociales($datos){

		$tabla = "usuarios";
		$item = "email";
		$valor = $datos["email"];
		$emailRepetido = false;

		$respuesta0 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		if($respuesta0){

			if($respuesta0["modo"] != $datos["modo"]){

				echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡El correo electrónico '.$datos["email"].', ya está registrado en el sistema con un método diferente a Google!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';

				$emailRepetido = false;

			}

			$emailRepetido = true;

		}else{

			$respuesta1 = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

		}

		if($emailRepetido || $respuesta1 == "ok"){

			$respuesta2 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

			if($respuesta2["modo"] == "facebook"){

				session_start();

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

				echo "ok";

			}else if($respuesta2["modo"] == "google"){

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

				echo "<span style='color:white'>ok</span>";

			}

			else{

				echo "";
			}

		}
	}

	/* AGREGAR A MI LISTA */
	static public function ctrAgregarDeseo($datos){

		$tabla = "deseos";
		$respuesta = ModeloUsuarios::mdlAgregarDeseo($tabla, $datos);
		return $respuesta;

	}

	/* MOSTRAR MI LISTA */
	static public function ctrMostrarDeseos($item){

		$tabla = "deseos";
		$respuesta = ModeloUsuarios::mdlMostrarDeseos($tabla, $item);
		return $respuesta;

	}

	/* QUITAR LABORATORIOS DE MI LISTA */
	static public function ctrQuitarDeseo($datos){

		$tabla = "deseos";
		$respuesta = ModeloUsuarios::mdlQuitarDeseo($tabla, $datos);
		return $respuesta;
	}

	/* ELIMINAR USUARIO */
	public function ctrEliminarUsuario(){

		if(isset($_GET["id"])){

			$tabla1 = "usuarios";		
			$tabla2 = "comentarios";
			$tabla3 = "compras";
			$tabla4 = "deseos";

			$id = $_GET["id"];

			if($_GET["foto"] != ""){
				unlink($_GET["foto"]);
				rmdir('vistas/img/usuarios/'.$_GET["id"]);
			}

			$respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla1, $id);
			
			ModeloUsuarios::mdlEliminarComentarios($tabla2, $id);
			ModeloUsuarios::mdlEliminarCompras($tabla3, $id);
			ModeloUsuarios::mdlEliminarListaDeseos($tabla4, $id);

			if($respuesta == "ok"){

		    	$url = Ruta::ctrRuta();

		    	echo'<script>

						swal({
							  title: "¡SU CUENTA HA SIDO BORRADA!",
							  text: "¡Debe registrarse nuevamente si desea ingresar!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						},

						function(isConfirm){
								 if (isConfirm) {	   
								   window.location = "'.$url.'salir";
								  } 
						});

					  </script>';

		    }

		}

	}

}
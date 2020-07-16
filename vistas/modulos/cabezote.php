<?php

$url = Ruta::ctrRuta();

if(isset($_SESSION["validarSesion"])){
	if($_SESSION["validarSesion"] == "ok"){
		echo '<script>
			localStorage.setItem("usuario","'.$_SESSION["id"].'");
		</script>';
	}
}

/*API DE GOOGLE*
/*CREAR EL OBJETO DE LA API GOOGLE*/
$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*RUTA PARA EL LOGIN DE GOOGLE*/
$rutaGoogle = $cliente->createAuthUrl();

/*RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE*/
if(isset($_GET["code"])){
	$token = $cliente->authenticate($_GET["code"]);
	$_SESSION['id_token_google'] = $token;
	$cliente->setAccessToken($token);
}

/*RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY*/
if($cliente->getAccessToken()){
 	$item = $cliente->verifyIdToken();
 	$datos = array("nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>0,
				   "emailEncriptado"=>"null");
 	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);
 	echo '<script>
	setTimeout(function(){
		window.location = localStorage.getItem("rutaActual");
	},1000);
 	</script>';
}

?>

<div class="container-fluid barraSuperior" id="top">
    <div class="container">
        <div class="row">
            <!-- REDES SOCIALES -->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
                <ul>
                    <?php
					$social = ControladorPlantilla::ctrEstiloPlantilla();
					$jsonRedesSociales = json_decode($social["redesSociales"],true);		
					foreach ($jsonRedesSociales as $key => $value) {
						echo '<li>
								<a href="'.$value["url"].'" target="_blank">
									<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
								</a>
							</li>';
					}
					?>
                </ul>
            </div>

            <!-- REGISTRO -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>
                    <?php

				if(isset($_SESSION["validarSesion"])){
					if($_SESSION["validarSesion"] == "ok"){
						
						// REGISTRO GOOGLE
						if($_SESSION["modo"] == "facebook"){
							echo '<li>
									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir" class="salir">Salir</a></li>';

						}
						// REGISTRO FACEBOOK
						if($_SESSION["modo"] == "google"){
							echo '<li>
									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">
								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir">Salir</a></li>';

						}
					}
				}else{
					echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
						  <li>|</li>
						  <li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';

				}

				?>

                </ul>
            </div>
        </div>
    </div>
</div>

<!-- HEADER -->
<header class="container-fluid">
    <div class="container">
        <div class="row" id="cabezote">
            <!-- LOGOTIPO -->
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
                <a href="<?php echo $url; ?>">
                    <img src="<?php echo $url.$social["logo"]; ?>" class="img-responsive">
                </a>
            </div>
            <!-- BLOQUE CATEGORÍAS Y BUSCADOR -->
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <!-- BOTÓN CATEGORÍAS -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
                    <p>LABORATORIOS
                        <span class="pull-right">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                    </p>
                </div>
                <!-- BUSCADOR -->
                <div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <a href="<?php echo $url; ?>buscador/1/recientes">
                            <button class="btn btn-default backColor" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </a>
                    </span>
                </div>
            </div>
            <!-- CATEGORÍAS -->
            <div class="col-xs-12 backColor" id="categorias">

                <?php

				$item = null;
				$valor = null;
				$categorias = ControladorLaboratorios::ctrMostrarCategorias($item, $valor);
				foreach ($categorias as $key => $value) {
					echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<h4>
								<a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
							</h4>
							<hr>
							<ul>';
							$item = "id_categoria";
							$valor = $value["id"];
							$subcategorias = ControladorLaboratorios::ctrMostrarSubCategorias($item, $valor);
							foreach ($subcategorias as $key => $value) {
									echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
								}	
								
							echo '</ul>
						</div>';
				}

			?>
            </div>
        </div>
</header>

<!-- VENTANA MODAL REGISTRO -->
<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">
    <div class="modal-content modal-dialog">
        <div class="modal-body modalTitulo">
            <h3 class="backColor">REGISTRARSE</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- REGISTRO FACEBOOK -->
            <div class="col-sm-6 col-xs-12 facebook">
                <p>
                    <i class="fa fa-facebook"></i>
                    Registro con Facebook
                </p>
            </div>

            <!-- REGISTRO GOOGLE -->
            <a href="<?php echo $rutaGoogle; ?>">
                <div class="col-sm-6 col-xs-12 google">
                    <p>
                        <i class="fa fa-google"></i>
                        Registro con Google
                    </p>
                </div>
            </a>

        </div>
        <div class="modal-footer">
            ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal"
                    data-toggle="modal">Ingresar</a></strong>
        </div>
    </div>
</div>

<!-- VENTANA MODAL PARA EL INGRESO -->
<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">
    <div class="modal-content modal-dialog">
        <div class="modal-body modalTitulo">
            <h3 class="backColor">INGRESAR</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- INGRESO FACEBOOK -->
            <div class="col-sm-6 col-xs-12 facebook">
                <p>
                    <i class="fa fa-facebook"></i>
                    Ingreso con Facebook
                </p>
            </div>
            <!-- INGRESO GOOGLE -->
            <a href="<?php echo $rutaGoogle; ?>">
                <div class="col-sm-6 col-xs-12 google">
                    <p>
                        <i class="fa fa-google"></i>
                        Ingreso con Google
                    </p>
                </div>
            </a>
        </div>

        <div class="modal-footer">
            ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal"
                    data-toggle="modal">Registrarse</a></strong>
        </div>
    </div>
</div>

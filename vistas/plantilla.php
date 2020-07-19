<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="title" content="PWA - LAB">
	<meta name="description" content="">
	<meta name="keyword" content="">

	<title>PWA - LAB</title>

	<!-- Declaraciópn de manifest -->
	<link rel="manifest" href="./manifest.json">
	<meta name="theme-color" content="#47bac1">

	<!-- Detección de Icono de PWA -->
	<link rel="icon" type="image/png" sizes="16x16" href="./vistas/img/favicon-16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./vistas/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="./vistas/img/android-chrome-96x96">
    <link rel="icon" type="image/png" sizes="120x120" href="./vistas/img/apple-touch-icon.png">

	<?php

		error_reporting(0);
		session_start();
		$url = Ruta::ctrRuta();
		$icono = ControladorPlantilla::ctrEstiloPlantilla();
		echo '<link rel="icon" href="'.$url.$icono["icono"].'">';
		

	?>

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/cabezote.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/slide.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/laboratorios.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/infolaboratorio.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/perfil.css">

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script>

</head>

<body>

<?php

include "modulos/cabezote.php";

$rutas = array();
$ruta = null;
$infoProducto = null;

if(isset($_GET["ruta"])){
	$rutas = explode("/", $_GET["ruta"]);
	$item = "ruta";
	$valor =  $rutas[0];

	$rutaCategorias = ControladorLaboratorios::ctrMostrarCategorias($item, $valor);
	if (is_array($rutaCategorias) && $rutas[0] == $rutaCategorias["ruta"]) {
		$ruta = $rutas[0];
	}

	/* URL'S AMIGABLES DE SUBCATEGORÍAS */
	$rutaSubCategorias = ControladorLaboratorios::ctrMostrarSubCategorias($item, $valor);
	foreach ($rutaSubCategorias as $key => $value) {
		if($rutas[0] == $value["ruta"]){
			$ruta = $rutas[0];
		}
	}

	$rutaProductos = ControladorLaboratorios::ctrMostrarInfoLaboratorio($item, $valor);
	if(is_array($rutaProductos) && $rutas[0] == $rutaProductos["ruta"]){
		$infoProducto = $rutas[0];
	}

	/* LISTA BLANCA DE URL'S AMIGABLES */
	if($ruta != null || $rutas[0] == "lo-mas-visto"){
		include "modulos/laboratorios.php";

	}else if($infoProducto != null){
		include "modulos/infolaboratorios.php";

	}else if($rutas[0] == "buscador" || $rutas[0] == "verificar" || $rutas[0] == "salir" || $rutas[0] == "perfil"){
		include "modulos/".$rutas[0].".php";
		
	}else{
		include "modulos/error404.php";
	}

}else{

	include "modulos/slide.php";

	include "modulos/destacados.php";

}

?>

<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

<!-- JAVASCRIPT PERSONALIZADO-->
<script src="<?php echo $url; ?>vistas/js/cabezote.js"></script>
<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>
<script src="<?php echo $url; ?>vistas/js/slide.js"></script>
<script src="<?php echo $url; ?>vistas/js/buscador.js"></script>
<script src="<?php echo $url; ?>vistas/js/infolaboratorio.js"></script>
<script src="<?php echo $url; ?>vistas/js/usuarios.js"></script>
<script src="<?php echo $url; ?>vistas/js/registroFacebook.js"></script>

<script src="<?php echo $url; ?>vistas/js/script.js"></script>

<!-- https://developers.facebook.com/ -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1886940058166316',
      cookie     : true,
      xfbml      : true,
      version    : 'v7.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
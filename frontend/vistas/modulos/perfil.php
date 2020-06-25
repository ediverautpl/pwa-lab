<!-- VALIDAR SESIÓN -->

<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){
	echo '<script>
		window.location = "'.$url.'";
	</script>';
	exit();
}

?>
<!-- BREADCRUMB PERFIL -->
<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>
			</ul>
		</div>
	</div>
</div>
<!-- SECCIÓN PERFIL -->
<div class="container-fluid">
	<div class="container">
		<ul class="nav nav-tabs">
	  		<li> 				
		  		<a data-toggle="tab" href="#deseos">
		  		<i class="fa fa-heart"></i> MI LISTA</a>
	  		</li>
	  		<li>				
	  			<a data-toggle="tab" href="#perfil">
	  			<i class="fa fa-user"></i> EDITAR PERFIL</a>
	  		</li>
		</ul>
	</div>
</div>
<!-- VENTANA MODAL PARA COMENTARIOS-->
<div  class="modal fade modalFormulario" id="modalComentarios" role="dialog">
	<div class="modal-content modal-dialog">
		<div class="modal-body modalTitulo">
			<h3 class="backColor">CALIFICA ESTE LABORATORIO</h3>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<form method="post" onsubmit="return validarComentario()">
				<input type="hidden" value="" id="idComentario" name="idComentario">
				<h1 class="text-center" id="estrellas">
		       		<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
				</h1>
				<div class="form-group text-center">
		       		<label class="radio-inline"><input type="radio" name="puntaje" value="0.5">0.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.0">1.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.5">1.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.0">2.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.5">2.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.0">3.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.5">3.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.0">4.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.5">4.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="5.0" checked>5.0</label>
				</div>
				<div class="form-group">
			  		<label for="comment" class="text-muted">Tu opinión acerca de este laboratorio: <span><small>(máximo 300 caracteres)</small></span></label>
			  		<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>
			  		<br>
					<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">
				</div>
				<?php

					$actualizarComentario = new ControladorUsuarios();
					$actualizarComentario -> ctrActualizarComentario();

				?>
			</form>
		</div>
		<div class="modal-footer">
      	</div>
	</div>
</div>
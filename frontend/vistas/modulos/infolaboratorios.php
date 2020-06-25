<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>

<!-- BREADCRUMB INFOLABORATORIOS -->
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
<div class="container-fluid infolaboratorio">
    <div class="container">
        <div class="row">

            <?php

				$item =  "ruta";
				$valor = $rutas[0];
				$infoproducto = ControladorLaboratorios::ctrMostrarInfoProducto($item, $valor);

				$multimedia = json_decode($infoproducto["multimedia"],true);

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
							<figure class="visor">';
							if($multimedia != null){

								for($i = 0; $i < count($multimedia); $i ++){

									echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'">';

								}								

								echo '</figure>
								<div class="flexslider">
								  <ul class="slides">';

								for($i = 0; $i < count($multimedia); $i ++){

									echo '<li>
								     	<img value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
								    </li>';

								}

							}	
							    						 
							  echo '</ul>
							</div>
						</div>';			
				}			

			?>

            <!-- LABORATORIO -->

            <?php
				if($infoproducto["tipo"] == "fisico"){
					echo '<div class="col-md-7 col-sm-6 col-xs-12">';
				}else{
					echo '<div class="col-sm-6 col-xs-12">';
				}

			?>
            <!-- REGRESAR INICIO-->
            <div class="col-xs-6">
                <h6>
                    <a href="javascript:history.back()" class="text-muted">
                        <i class="fa fa-reply"></i> Continuar Revisando
                    </a>
                </h6>
            </div>
            <!-- COMPARTIR EN REDES SOCIALES -->
            <div class="col-xs-6">
                <h6>
                    <a class="dropdown-toggle pull-right text-muted" data-toggle="dropdown" href="">
                        <i class="fa fa-plus"></i> Compartir
                    </a>
                    <ul class="dropdown-menu pull-right compartirRedes">
                        <li>
                            <p class="btnFacebook">
                                <i class="fa fa-facebook"></i>
                                Facebook
                            </p>
                        </li>
                        <li>
                            <p class="btnGoogle">
                                <i class="fa fa-google"></i>
                                Google
                            </p>
                        </li>
                    </ul>
                </h6>
            </div>
            <div class="clearfix"></div>
            <!-- ESPACIO PARA EL LABORATORIO-->
            <?php

					/* TITULO */				
					if($infoproducto["oferta"] == 0){
						if($infoproducto["nuevo"] == 0){
							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';
						}else{
							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
							<br>
							<small>
								<span class="label label-warning">Nuevo</span>
							</small>
							</h1>';
						}

					}else{

						if($infoproducto["nuevo"] == 0){
							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
							<br>
							</h1>';

						}else{

							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
							<br>
							<small>
								<span class="label label-warning">Nuevo</span> 
							</small>
							</h1>';
						}
					}

					/* DESCRIPCIÓN */		
					echo '<p>'.$infoproducto["descripcion"].'</p>';

				?>

            <!-- CARACTERÍSTICAS LABORATORIO -->
            <hr>
            <div class="form-group row">
                <?php
					if($infoproducto["detalles"] != null){
						$detalles = json_decode($infoproducto["detalles"], true);
						if($infoproducto["tipo"] == "fisico"){
						}else{
							echo '<div class="col-xs-12">
								<li>
									<i style="margin-right:10px" class="fa fa-flask"></i> '.$detalles["Procesa"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-tint"></i> '.$detalles["Toma"].'
								</li>
							</div>';
						}
					}

					/*=============================================
					ENTREGA
					=============================================*/

					if($infoproducto["entrega"] == 0){

						if($infoproducto["precio"] == 0){

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata | 
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos |
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata <br>
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos <br>
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</small>

							</h4>';

						}else{

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata |
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas |
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata <br> 
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas <br>
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas

								</small>

							</h4>';

						}

					}else{

						if($infoproducto["precio"] == 0){

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">
								
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas  

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].' </span> personas 

								</small>

							</h4>';

						}else{

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">

									
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

								
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas

								</small>

							</h4>';

						}

					}				

				?>

            </div>

            <!-- BOTON DE CONTACTO -->
            <div class="row botonesCompra">
                <?php

					if($infoproducto["precio"]==0){
						echo '<div class="col-md-6 col-xs-12">';
							if($infoproducto["tipo"]=="virtual"){
								echo ' <a href="'.$infoproducto["multimedia"].'" target="_blank">
								<button class="btn btn-default btn-block btn-lg backColor">CONTACTAR AHORA</button>';
							}
							echo '</div>';
					}
				?>
            </div>
            <!-- ZONA DE LUPA-->
            <figure class="lupa">
                <img src="">
            </figure>
        </div>
    </div>
    <br>

    <!-- LABORATORIOS RELACIONADOS-->
    <div class="container-fluid productos">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 tituloDestacado">
                    <div class="col-sm-6 col-xs-12">
                        <h1><small>LABORATORIOS RELACIONADOS</small></h1>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                <?php

					$item = "id";
					$valor = $infoproducto["id_subcategoria"];

					$rutaArticulosDestacados = ControladorLaboratorios::ctrMostrarSubcategorias($item, $valor);

					echo '<a href="'.$url.$rutaArticulosDestacados[0]["ruta"].'">
						
						<button class="btn btn-default backColor pull-right">
							VER MÁS <span class="fa fa-chevron-right"></span>
						</button>
					</a>';

				?>

                    </div>

                </div>

                <div class="clearfix"></div>

                <hr>

            </div>

            <?php

			$ordenar = "";
			$item = "id_subcategoria";
			$valor = $infoproducto["id_subcategoria"];
			$base = 0;
			$tope = 4;
			$modo = "Rand()";

			$relacionados = ControladorLaboratorios::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

			if(!$relacionados){

				echo '<div class="col-xs-12 error404">
					<h1><small>¡Oops!</small></h1>
					<h2>No hay LABORATORIOS relacionados</h2>
				</div>';

			}else{

				echo '<ul class="grid0">';

				foreach ($relacionados as $key => $value) {
				
				echo '<li class="col-md-3 col-sm-6 col-xs-12">

						<figure>
							<a href="'.$url.$value["ruta"].'" class="pixelProducto">
								<img src="'.$servidor.$value["portada"].'" class="img-responsive">
							</a>
						</figure>

						<h4>
							<small>
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									'.$value["titulo"].'<br>
									<span style="color:rgba(0,0,0,0)">-</span>';

									if($value["nuevo"] != 0){

										echo '<span class="label label-warning fontSize">Nuevo</span> ';

									}

								echo '</a>	
							</small>			

						</h4>

						<div class="col-xs-6 precio">';

						if($value["precio"] == 0){

							

						}else{

							if($value["oferta"] != 0){

								echo '<h2>

										<small>
					
											<strong class="oferta">USD $'.$value["precio"].'</strong>

										</small>

										<small>$'.$value["precioOferta"].'</small>
									
									</h2>';

							}else{

								echo '<h2><small>USD $'.$value["precio"].'</small></h2>';

							}
							
						}
										
						echo '</div>

						<div class="col-xs-6 enlaces">
							<div class="btn-group pull-right">
								
							';

				
								echo '<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									<button type="button" class="btn btn-default" data-toggle="tooltip" title="Ver Laboratorio">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</button>	
								</a>
							</div>
						</div>
					</li>';
				}

			echo '</ul>';

		}

		?>

        </div>
    </div>
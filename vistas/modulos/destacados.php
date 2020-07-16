<!-- BANNER -->

<?php

$url = Ruta::ctrRuta();

$ruta = "sin-categoria";

$banner = ControladorLaboratorios::ctrMostrarBanner($ruta);

$titulo1 = json_decode($banner["titulo1"],true);
$titulo2 = json_decode($banner["titulo2"],true);
$titulo3 = json_decode($banner["titulo3"],true);

if($banner != null){

echo '<figure class="banner">

		<img src="'.$url.$banner["img"].'" class="img-responsive" width="100%">	

		<div class="textoBanner '.$banner["estilo"].'">
			<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>
			<h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>
			<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

		</div>

	</figure>';

}


$titulosModulos = array("LO MÁS VISTO");
$rutaModulos = array("lo-mas-visto");

$base = 0;
$tope = 4;

if($titulosModulos[0] == "LO MÁS VISTO"){

$ordenar = "vistasGratis";
$item = null;
$valor = null;
$modo = "DESC";

$vistas = ControladorLaboratorios::ctrMostrarLaboratorios($ordenar, $item, $valor, $base, $tope, $modo);

}


$modulos = array($vistas);

for($i = 0; $i < count($titulosModulos); $i ++){

	echo '<div class="container-fluid well well-sm barraProductos">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 organizarProductos">
						<div class="btn-group pull-right">
							 <button type="button" class="btn btn-default btnGrid" id="btnGrid'.$i.'">
								<i class="fa fa-th" aria-hidden="true"></i>  
								<span class="col-xs-0 pull-right"> GRID</span>
							 </button>
							 <button type="button" class="btn btn-default btnList" id="btnList'.$i.'">
								<i class="fa fa-list" aria-hidden="true"></i> 
								<span class="col-xs-0 pull-right"> LIST</span>
							 </button>
						</div>		
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid productos">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 tituloDestacado">
						<div class="col-sm-6 col-xs-12">
							<h1><small>'.$titulosModulos[$i].' </small></h1>
						</div>
						<div class="col-sm-6 col-xs-12">
							<a href="'.$rutaModulos[$i].' ">
								<button class="btn btn-default backColor pull-right">
									VER MÁS <span class="fa fa-chevron-right"></span>
								</button>
							</a>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
				</div>

				<ul class="grid'.$i.'">';

				foreach ($modulos[$i] as $key => $value) {

					if(isset($_SESSION["validarSesion"])){
						if($_SESSION["validarSesion"] == "ok"){
							
							echo '<li class="col-md-3 col-sm-6 col-xs-12">
							<figure>
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									<img src="'.$url.$value["portada"].'" class="img-responsive">
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



							echo '</div>

							<div class="col-xs-6 enlaces">
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-default deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="MI LISTA">
										<i class="fa fa-heart" aria-hidden="true"></i> AGREGAR
									</button>' ;

								

									echo '<a href="'.$value["ruta"].'" class="pixelProducto">
									</a>
								</div>
							</div>
						</li>';
						

					}
				}else{

					echo '<li class="col-md-3 col-sm-6 col-xs-12">
							<figure>
								<a href=" " class="pixelProducto">
									<img src="'.$url.$value["portada"].'" class="img-responsive">
								</a>
							</figure>
							<h4>
								<small>
									<a href=" " class="pixelProducto">
										'.$value["titulo"].'<br>
										<span style="color:rgba(0,0,0,0)">-</span>';
										if($value["nuevo"] != 0){
											echo '<span class="label label-warning fontSize">Nuevo</span> ';
										}

									echo '</a>	
								</small>			
							</h4>

							<div class="col-xs-6 precio">';



							echo '</div>

							<div class="col-xs-6 enlaces">
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-default deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="MI LISTA">
										<i class="fa fa-heart" aria-hidden="true"></i> AGREGAR
									</button>' ;

								

									echo '<a href="'.$value["ruta"].'" class="pixelProducto">
									</a>
								</div>
							</div>
						</li>';

				}
					
				}

				echo '</ul>

				<ul class="list'.$i.'" style="display:none">';

				foreach ($modulos[$i] as $key => $value) {

					if(isset($_SESSION["validarSesion"])){
						if($_SESSION["validarSesion"] == "ok"){

							echo '<li class="col-xs-12">
					  
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
								 
							  <figure>
						  
								  <a href="'.$url.$value["ruta"].'" class="pixelProducto">
									  
									  <img src="'.$url.$value["portada"].'" class="img-responsive">
  
								  </a>
  
							  </figure>
  
							</div>
								
						  <div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							  
							  <h1>
  
								  <small>
								  
									  <a href="'.$url.$value["ruta"].'" class="pixelProducto">
										  
										  '.$value["titulo"].'<br>';
  
										  if($value["nuevo"] != 0){
  
											  echo '<span class="label label-warning">Nuevo</span> ';
  
										  }
  
							  
									  echo '</a>
								  </small>
							  </h1>
							  <p class="text-muted">'.$value["titular"].'</p>';
  
							  
							  echo '<div class="btn-group pull-left enlaces">
								
									<button type="button" class="btn btn-default deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a MI LISTA">
  
										<i class="fa fa-heart" aria-hidden="true"></i> AGREGAR
  
									</button>';
  
						  
									echo '<a href= "" class="pixelProducto">
  
										
  
									</a>
							  
							  </div>
  
						  </div>
  
						  <div class="col-xs-12"><hr></div>
  
					  </li>';

						}
					}else{

						echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href=" " class="pixelProducto">
									
									<img src="'.$url.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>
								
									<a href=" " class="pixelProducto">
										
										'.$value["titulo"].'<br>';

										if($value["nuevo"] != 0){

											echo '<span class="label label-warning">Nuevo</span> ';

										}

							
									echo '</a>
								</small>
							</h1>
							<p class="text-muted">'.$value["titular"].'</p>';

							
							echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a MI LISTA">

						  			<i class="fa fa-heart" aria-hidden="true"></i> AGREGAR

						  		</button>';

						
						  		echo '<a href= "" class="pixelProducto">

							  		

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

					}

					
				}

				echo '</ul>

			</div>

		</div>';

}

?>


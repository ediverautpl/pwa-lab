<?php

class ControladorLaboratorios{

	static public function ctrMostrarCategorias($item, $valor){
		$tabla = "categorias";
		$respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarSubCategorias($item, $valor){
		$tabla = "subcategorias";
		$respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){
		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo);
		return $respuesta;
	}

	static public function ctrMostrarInfoProducto($item, $valor){
		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlMostrarInfoProducto($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrListarProductos($ordenar, $item, $valor){
		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);
		return $respuesta;
	}

	/*MOSTRAR BANNER*/
	static public function ctrMostrarBanner($ruta){

		$tabla = "banner";
		$respuesta = ModeloProductos::mdlMostrarBanner($tabla, $ruta);
		return $respuesta;
	}

	/*BUSCADOR*/
	static public function ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope){

		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);
		return $respuesta;
	}

	/*LISTAR LABORATORIOS BUSCADOR*/
	static public function ctrListarProductosBusqueda($busqueda){

		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlListarProductosBusqueda($tabla, $busqueda);
		return $respuesta;
	}

	static public function ctrActualizarVistaLaboratorio($datos, $item){
		$tabla = "laboratorios";
		$respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla, $datos, $item);
		return $respuesta;
	}
}
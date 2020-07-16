<?php

class ControladorLaboratorios{

	static public function ctrMostrarCategorias($item, $valor){
		$tabla = "categorias";
		$respuesta = ModeloLaboratorios::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarSubCategorias($item, $valor){
		$tabla = "subcategorias";
		$respuesta = ModeloLaboratorios::mdlMostrarSubCategorias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarLaboratorios($ordenar, $item, $valor, $base, $tope, $modo){
		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlMostrarLaboratorios($tabla, $ordenar, $item, $valor, $base, $tope, $modo);
		return $respuesta;
	}

	static public function ctrMostrarInfoLaboratorio($item, $valor){
		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlMostrarInfoLaboratorio($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrListarLaboratorios($ordenar, $item, $valor){
		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlListarLaboratorios($tabla, $ordenar, $item, $valor);
		return $respuesta;
	}

	/*MOSTRAR BANNER*/
	static public function ctrMostrarBanner($ruta){

		$tabla = "banner";
		$respuesta = ModeloLaboratorios::mdlMostrarBanner($tabla, $ruta);
		return $respuesta;
	}

	/*BUSCADOR*/
	static public function ctrBuscarLaboratorios($busqueda, $ordenar, $modo, $base, $tope){

		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlBuscarLaboratorios($tabla, $busqueda, $ordenar, $modo, $base, $tope);
		return $respuesta;
	}

	/*LISTAR LABORATORIOS BUSCADOR*/
	static public function ctrListarLaboratoriosBusqueda($busqueda){

		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlListarLaboratoriosBusqueda($tabla, $busqueda);
		return $respuesta;
	}

	static public function ctrActualizarVistaLaboratorio($datos, $item){
		$tabla = "laboratorios";
		$respuesta = ModeloLaboratorios::mdlActualizarVistaProducto($tabla, $datos, $item);
		return $respuesta;
	}
}
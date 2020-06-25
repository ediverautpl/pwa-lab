<?php

require_once "../controladores/laboratorios.controlador.php";
require_once "../modelos/laboratorios.modelo.php";

class AjaxLaboratorios{

	public $valor;
	public $item;
	public $ruta;

	public function ajaxVistaLaboratorios(){

		$datos = array("valor"=>$this->valor,
					   "ruta"=>$this->ruta);

		$item = $this->item;
		$respuesta = ControladorLaboratorios::ctrActualizarVistaLaboratorio($datos, $item);
		echo $respuesta;
	}
}

if(isset($_POST["valor"])){

	$vista = new AjaxLaboratorios();
	$vista -> valor = $_POST["valor"];
	$vista -> item = $_POST["item"];
	$vista -> ruta = $_POST["ruta"];
	$vista -> ajaxVistaLaboratorios();


}


 
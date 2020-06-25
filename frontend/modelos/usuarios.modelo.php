<?php

require_once "conexion.php";

class ModeloUsuarios{
	
	/* REGISTRO DE USUARIO*/
	static public function mdlRegistroUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, password, email, foto, modo, verificacion, emailEncriptado) VALUES (:nombre, :password, :email, :foto, :modo, :verificacion, :emailEncriptado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/* MOSTRAR USUARIO */
	static public function mdlMostrarUsuario($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt-> close();
		$stmt = null;
	}

	/* ACTUALIZAR USUARIO */
	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}

	/* ACTUALIZAR PERFIL */
	static public function mdlActualizarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password, foto = :foto WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}

	/* MOSTRAR COMPRAS */
	static public function mdlMostrarCompras($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt-> close();
		$stmt = null;
	}


	/* AGREGAR A MI LISTA */
	static public function mdlAgregarDeseo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto) VALUES (:id_usuario, :id_producto)");

		$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);	

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}

	/* MOSTRAR MI LISTA  */
	static public function mdlMostrarDeseos($tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id DESC");
		$stmt -> bindParam(":id_usuario", $item, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;

	}

	/* QUITAR LABORATORIO DE MI LISTA */
	static public function mdlQuitarDeseo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}

	/* ELIMINAR USUARIO */
	static public function mdlEliminarUsuario($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}

	/* ELIMINAR MI LISTA DE USUARIO */
	static public function mdlEliminarListaDeseos($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt-> close();
		$stmt = null;
	}
}
<?php


require_once 'conexion.php';



class ModeloUsuarios {
		
	/*--=============================================
		Login usuario
	=============================================*/
	static public function mdlIngresoUsuario($user){
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC admvalidadusuario '".$user."'");
		$stmt -> execute();
		return $stmt ->fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlRefreshToken ($user, $tipoDocumento, $documento, $token, $ip, $windowsUser) {
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC adminiciasesion '".$user."', '".$tipoDocumento."', '".$documento."', '".$token."', '".$ip."', '".$windowsUser."'");
		if( $stmt -> execute() ) {
			return 'Exitoso';
		} else {
			return 'Error';
		}
		$stmt -> close();
		$stmt = null;
	}


	static public function mdlValidaUsuario($fechaNac, $document, $vhur){
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC ctrValidaUsuario '".$fechaNac."', '".$document."', '".$vhur."'");
		$stmt -> execute();
		return $stmt ->fetch();
		$stmt -> close();
		$stmt = null;
	}


	static public function mdlCambiaPassword($tipoDocumento, $document, $vhur, $password){
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC admcambiarcontrasenia '".$vhur."', '".$tipoDocumento."', '".$document."','".$password."'");
		$stmt -> execute();
		$respuesta = $stmt -> fetch();
		if($respuesta['valido'] === '1') {
			return array(
				'mensaje' => 'Se ha cambiado la contraseña con éxito.'
			);
		} else {
			return array(
				'mensaje' => 'Se han presentado errores, contacte al administrador.'
			);
		}
		$stmt -> close();
		$stmt = null;
	}
	

	static public function mdlValidaMenu($user, $tipoDocumento, $documento) {
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC mnuprincipal '".$user."', '".$tipoDocumento."', '".$documento."'");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt - close();
		$stmt = null;
	}

	static public function mdlRenderMenu($user) {
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC mnuporusuario '".$user."'");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt - close();
		$stmt = null;
	}

	static public function mdlUpdateMenu($datos) {
		$stmt = Conexion::conectarSQL("workforce")->prepare("EXEC mnuagregar
			'".$datos['vhur']."',
			'".$datos['tipoDocumento']."',
			'".$datos['documento']."',
			'".$datos['idMenu']."',
			'".$datos['activo']."'
			");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt - close();
		$stmt = null;
	}

}
<?php


require_once 'conexion.php';



class ModeloDatos {
		

	
	static public function mdlMatrixData() {
		$stmt = Conexion::conectarSQLB("wfmTest")->prepare("EXEC ctrUnidades");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMatrixKpi($id) {
		$stmt = Conexion::conectarSQLB("wfmTest")->prepare("EXEC ctrkpiUnidad '".$id."'");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMatrixFormData($datos) {
		$stmt = Conexion::conectarSQLB("wfmTest")->prepare("EXEC ctrEscalationMatrix
			'".$datos['id']."',
			'".$datos['unidad']."',
			'".$datos['subunidad']."',
			'".$datos['kpi']."',
			'".$datos['meta']."',
			'".$datos['ejecutado']."',
			'".$datos['alerta']."',
			'".$datos['responsable']."',
			'".$datos['afectaciones']."',
			'".$datos['causas']."',
			'".$datos['acciones']."'
		 ");
		if($stmt -> execute()){
			return 'Se han insertado los datos con éxito.';
		} else {
			return 'Se han presentado problemas insertando los datos.';
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMatrixUpdate($datos) {
		$stmt = Conexion::conectarSQLB("wfmTest")->prepare("EXEC ctrUpdateMatrix
			'".$datos['ipkpi']."',
			'".$datos['idsubunidad']."',
			'".$datos['meta']."',
			'".$datos['roja']."',
			'".$datos['naranja']."',
			'".$datos['amarilla']."'
		 ");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMatrixUpdateMail($datos) {
		$stmt = Conexion::conectarSQLB("wfmTest")->prepare("EXEC ctrUpdateMatrixMail 
			'".$datos['alerta']."',
			'".$datos['subunidad']."',
			'".$datos['mail']."'
		 ");
		if($stmt -> execute()){
			return 'ok';
		} else {
			return 'error';
		}
		$stmt -> close();
		$stmt = null;
	}

 	
} // Fin de la clase
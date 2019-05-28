<?php
require_once '../models/datos.modelo.php';



class FetchMatrixData {
		
	static public function fecthMatrixData() {
        $respuesta = ModeloDatos::mdlMatrixData();
        echo json_encode($respuesta);
    }

	static public function fecthMatrixKpi($id) {
        $respuesta = ModeloDatos::mdlMatrixKpi($id);
        echo json_encode($respuesta);   
    }


    static public function fetchMatrixForm($datos) {
        $respuesta = ModeloDatos::mdlMatrixFormData($datos);
        echo json_encode($respuesta);   
    }

    static public function fetchMatrixUpdate($datos) {
        $respuesta = ModeloDatos::mdlMatrixUpdate($datos);
        echo json_encode($respuesta);   
    }

    static public function fetchMatrixUpdateMail($datos) {
        $respuesta = ModeloDatos::mdlMatrixUpdateMail($datos);
        echo json_encode($respuesta);   
    }
 	
} // End of the class


// -- Class Validation --
    if(isset($_POST['unidades'])){
        $datos = new FetchMatrixData();
        $datos -> fecthMatrixData();
    } else if(isset($_POST['subunidad'])) {
        $id = $_POST['subunidad'];
        $datos = new FetchMatrixData();
        $datos -> fecthMatrixKpi($id);
    } else if(isset($_POST['matrixId'])) {
        $datos = new FetchMatrixData();
        $formData = array(
            'id' => $_POST['matrixId'],
            'unidad' => $_POST['matrixUnidades'],
            'subunidad' => $_POST['matrixSubunidades'],
            'kpi' => $_POST['matrixKpi'],
            'meta' => $_POST['matrixMeta'],
            'ejecutado' => $_POST['matrixResultado'],
            'alerta' => $_POST['matrixAlerta'],
            'responsable' => $_POST['matrixResponsable'],
            'afectaciones' => $_POST['matrixAfectaciones'],
            'causas' => $_POST['matrixCausas'],
            'acciones' => $_POST['matrixAcciones'],
        );
        $datos -> fetchMatrixForm($formData);
    } else if(isset($_POST['updateKpi'])) {
        $datos = new FetchMatrixData();
        $tipo = $_POST['tipo'];
        if($tipo === 'porcentaje') {
            $denominador = 100;
        } else {
            $denominador = 1;
        }
        $formData = array(
            'ipkpi' => intval($_POST['id']),
            'idsubunidad' => intval($_POST['sub']),
            'meta' => floatval($_POST['meta']) / $denominador,
            'roja' => floatval($_POST['roja']) / $denominador,
            'naranja' => floatval($_POST['naranja']) / $denominador,
            'amarilla' => floatval($_POST['amarilla']) / $denominador,
        );
        $datos -> fetchMatrixUpdate($formData);
    } else if(isset($_POST['updateMail'])) {
        $datos = new FetchMatrixData();
        $formData = array(
            'alerta' => $_POST['alerta'],
            'subunidad' => $_POST['subun'],
            'mail' => $_POST['mail'],
        );
        $datos -> fetchMatrixUpdateMail($formData);
    } else {
        echo json_encode('Se presentaron errores con los datos del fetch!');
    }


<?php
require_once '../models/datos.modelo.php';



class FetchData {
		
	
	static public function fetchDatos($tipoDocumento, $documento) {
        $respuesta = ModeloDatos::mdlDatos($tipoDocumento, $documento);
        echo json_encode($respuesta);
    }

 	
} // End of the class


// -- Class Validation --
    if(isset($_POST['datos'])){
        $datos = new FetchData();
        $tipoDocumento = $_POST['tipoDocumento'];
        $documento = $_POST['documento'];
        $datos -> fetchDatos($tipoDocumento, $documento);
     } else {
        echo json_encode('Se presentaron errores con los datos del fetch!');
    }


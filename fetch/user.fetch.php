<?php
require_once '../controllers/usuarios.controlador.php';
require_once '../models/usuarios.modelo.php';




class FetchController {


    static public function fetchUserVal ($vhur) {
        $respuesta = ModeloUsuarios::mdlIngresoUsuario($vhur);
        $datos = array(
            'fechaExp' => $respuesta['fechaexpedicion'],
            'documento' => $respuesta['documento'],
            'vhur' => $respuesta['vhur']
        );
        echo json_encode($datos);
    }

    
    static public function fetchChangePass ($tipoDocumento, $document, $vhur, $password) {
        $respuesta = ModeloUsuarios::mdlCambiaPassword($tipoDocumento, $document, $vhur, $password);
        // $respuesta = 'Test de fetch API';
        echo json_encode($respuesta);
    }

    static public function fetchSearchUser($user) {
        $respuesta = ModeloUsuarios::mdlIngresoUsuario($user);
        $datos = array(
            'cargo' => $respuesta['cargo'],
            'nombre' => $respuesta['nombre'],
            'documento' => $respuesta['documento'],
            'tipDoc' => $respuesta['tipodocumento'],
            'vhur' => $respuesta['vhur'],
            'estado' => $respuesta['estado'],
            'fechafin' => $respuesta['fechafin'],
        );
        echo json_encode($datos);
    }

    static public function fetchRenderMenu($user){
        $respuesta = ModeloUsuarios::mdlRenderMenu($user);
        echo json_encode($respuesta);
    }

    static public function fetchUpdateMenu($datos) {
        $respuesta = ModeloUsuarios::mdlUpdateMenu($datos);
        echo json_encode($respuesta);
    }

    static public function fetchUpdateAttrition($datos) {
        $respuesta = ModeloUsuarios::mdlUpdateAttrition($datos);
        echo json_encode($respuesta);
    }

    static public function fetchActivateAttrition($datos) {
        $respuesta = ModeloUsuarios::mdlActivateAttrition($datos);
        echo json_encode($respuesta);
    }




} // End of the class



// -- Class Validation --

    // fetchUserVal
    if(isset($_POST['validarData'])){
        $validaUser = new FetchController();
        $fechaNac = $_POST['fechaNac'];
        $document = $_POST['documento'];
        $vhur = intval($_POST['vhur']);
        $validaUser -> fetchUserVal($vhur);

     } else if(isset($_POST['cambiarPass'])){
        $cambiaPass = new FetchController();
        $document = $_POST['documento'];
        $tipoDocumento = $_POST['tipoDocumento'];
        $vhur = intval($_POST['vhur']);
        $options = ['cost' => 12,];
        $password = $_POST['rec__confirmPassword'];
        $passCrypt =  password_hash($password, PASSWORD_BCRYPT, $options);
        $passwordC =  $passCrypt;
        $cambiaPass -> fetchChangePass($tipoDocumento, $document, $vhur, $passwordC);

    } else if(isset($_POST['user'])) {
        $searchUser = new FetchController();
        $user = $_POST['user'];
        $searchUser -> fetchSearchUser($user);
    } else if(isset($_POST['userMenu'])) {
        $renderMenu = new FetchController();
        $user = $_POST['userMenu'];
        $renderMenu -> fetchRenderMenu($user);
    } else if(isset($_POST['updateMenu'])) {
        $updateMenu = new FetchController();
        $datos = array(
            'tipoDocumento' => $_POST['tipoDocumento'],
            'documento' => $_POST['documento'],
            'vhur'  => $_POST['vhur'],
            'idMenu' => $_POST['idMenu'],
            'activo' => $_POST['updateMenu'],
        );
        $updateMenu -> fetchUpdateMenu($datos);

    } else if(isset($_POST['fechaRetiro'])) {
        $attr = new FetchController();
        $datos = array(
            'fechaRetiro' => $_POST['fechaRetiro'],
            'tipoRetiro' => $_POST['tipoRetiro'],
            'tipDoc' => $_POST['tipDoc'],
            'doc' => $_POST['doc'],
        );
        $attr -> fetchUpdateAttrition($datos);
    } else if(isset($_POST['tip'])) {
        $act = new FetchController();
        $datos = array(
            'tip' => $_POST['tip'],
            'doc' => $_POST['doc'],
        );
        $act -> fetchActivateAttrition($datos);
    } else {
        echo json_encode('Se presentaron errores con los datos del fetch!');
    }


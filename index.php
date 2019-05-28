<?php
//Plugins
require_once 'php/plugins/vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';


// Controllers
require_once 'controllers/plantilla.controlador.php';
require_once 'controllers/usuarios.controlador.php';
require_once 'controllers/sesion.controlador.php';


// Models
require_once 'models/conexion.php';
require_once 'models/usuarios.modelo.php';
require_once 'models/datos.modelo.php';


// Content
$plantilla = new ControladorPlantilla();
$plantilla -> plantilla();
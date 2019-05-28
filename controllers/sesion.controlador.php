<?php

class ControladorVistas {

    static public function ctrVistas ($access) {

        if($access === 'error') {

            // Si el token no es valido agrega el logout
            if($_GET['ruta'] == 'logout') {
                    include 'views/modules/'.$_GET['ruta'].'.php';
                } else {
                    include 'views/modules/error404.php';
                }

        } else {
                // -- Navbar --
                include 'views/modules/navbar.php';
                include 'views/modules/menu.php';
            
                // -- Content --
                echo '
                <div class="container-fluid" id="mainContent">
                        <main role="main" class="main ml-sm-auto pt-5">';
                            $user = $_SESSION['usuario'];
                            $tipoDocumento = $_SESSION['tipoDocumento'];
                            $documento = $_SESSION['documento'];
                            $menu = ControladorUsuarios::ctrValidaMenu($user, $tipoDocumento, $documento);
                            $views = [];

                            foreach($menu as $key => $value) {
                                array_push($views, $value['href']);
                            }

                            //array_push($views, 'mailer'); add mailer if doesn't exist
                            array_push($views, 'comisiones'); //add comisiones if doesn't exist
                            if (!$_GET['ruta']){
                                include 'views/modules/error404.php';
                            } else if (in_array($_GET['ruta'], $views)) {
                                include 'views/modules/'.$_GET['ruta'].'.php';
                            } else if($_GET['ruta'] == 'logout') {
                                include 'views/modules/logout.php';
                            } else {
                                include 'views/modules/error404.php';
                            }
                    echo'
                        </main>
                        <br>
                </div>';
            }    
    }
}
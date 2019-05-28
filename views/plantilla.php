<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WFM Onelink</title>


    <!-- =========================== CSS Plugins =========================== -->
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <link href='css/plugins/bulma.min.css' rel="stylesheet">
        <link href="css/plugins/bootstrap.min.css" rel="stylesheet">
        <link href='animate.css' rel="stylesheet">
        <link href='fullcalendar.css' rel="stylesheet">
        
        
        <!-- Datatables  -->
        <link rel="stylesheet" type="text/css" href="css/plugins/datatables.min.css"/>


    <!-- =========================== Custom CSS =========================== -->
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/sidebar.css">
        <link rel="stylesheet" href="css/socialmen.css">

    
	

    <!-- =========================== JS Plugins =========================== -->
        <script src='js/plugins/moment.min.js'></script>
        <script src="js/plugins/jquery-3.3.1.slim.min.js"></script>
        <script src="js/plugins/popper.min.js"></script>
        <script src="js/plugins/bootstrap.min.js"></script>
        
        <!-- Feather Icons -->
        <script src="js/plugins/feather.min.js"></script>
        
        <!-- SweetAlert2  -->
        <script src="js/plugins/sweetalert2.all.min.js"></script>

        
        <script src='js/plugins/fullcalendar.js'></script>
        <script src='js/plugins/es.js'></script>
        <script src="js/plugins/particles.js"></script>

        <!-- Type.js -->
        <script src="js/plugins/typed.js"></script>

        <!-- Cleave JS -->
        <script src="js/plugins/cleave.min.js"></script>
        <script src="js/plugins/cleave-phone.co.js"></script>

        <!-- Datatables  -->
        <script type="text/javascript" src="js/plugins/datatables.min.js"></script>


        <!-- Anime.js -->
        <script src="js/plugins/anime.min.js"></script>

        
        <!-- Numeral.js -->

        <script src="js/plugins/numeral.min.js"></script>
        <!-- dropzone.js -->
        <script src="js/plugins/dropzone.js"></script>


</head>

<body>


<?php
    if(isset($_SESSION['validarSesion']) && $_SESSION['validarSesion'] === 'ok') {
        // $_SESSION['token'] = 'tokencillo';
        if(isset($_SESSION['usuario']) && isset($_SESSION['token'])) {
            $user = $_SESSION['usuario'];
            $token = $_SESSION['token'];
            $validarToken = ControladorUsuarios::ctrlValidateToken($user, $token);
            if($validarToken === 'ok') {
                $sesion = ControladorVistas::ctrVistas('ok');
            } else {
                $sesion = ControladorVistas::ctrVistas('error');
                echo '
                <script>
                    setTimeout(function(){
                        window.location = "logout";
                    }, 8000)
                </script>
                ';
            }
        }
    } else {
        include 'modules/login.php';		
    }
?>


    <!-- =========================== Custom JS =========================== -->
        <script src="js/app.js"></script>    
        <script src="js/nomina.js"></script> 
        <script src="js/mallaTurnos.js"></script> 
        <script src="js/escalationMatrix.js"></script> 
        <script src="js/escalationSetup.js"></script> 
        <script src="js/adminUsuarios.js"></script> 
        <script src="js/cargaRoster.js"></script> 
    
    
</body>
</html>

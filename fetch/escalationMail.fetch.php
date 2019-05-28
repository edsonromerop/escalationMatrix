<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../phpmailer_dev/vendor/autoload.php';


class FetchMatrixMail {


    static public function fetchMailer($datos) {
        
        $recipients = explode(';', $datos['destinatarios']);
        if($datos['alerta'] === 'Roja'){
            $color = '#C62828';
        } else if($datos['alerta'] === 'Naranja') {
            $color = '#FF5722';
        } else if($datos['alerta'] === 'Amarilla') {
            $color = '#FDD835';
        }
        
        

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.office365.com';//smtp2.example.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'edson.romero@onelinkbpo.com';                     // SMTP username
            $mail->Password   = 'Onelink2019';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($datos['mascara'], 'WFM Colombia');
            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            // foreach($recipients as $key => $value){
            //     $mail->addAddress($value);
            // }

            $mail->addAddress('edson.romero@onelinkbpo.com');               // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '<ALERTA ' . strtoupper($datos['alerta']) .'> ' . $datos['subunidad'] . ' / ' . $datos['kpi'] . ' / ' . $datos['ejecutado'];
            $mail->Body = '
                <html>
                    <head>
                        <title>$nbps</title>
                        <style>
                
                            body {
                                    background-color: #FDFEFE;
                                    font-family: Arial, sans-serif;
                            }
                
                            #content {
                                    width: 800px;
                                    height: 800px;
                                    border: 1px solid #E5E7E9;
                                    margin: 0 auto;
                            }
                
                            #content .alerta {
                                color: #fff;
                                background: '.$color.';
                                font-size: 3em;
                                height: 100px;
                                padding-top: 50px;
                                margin: 0;
                
                            }
                            
                            #content p {
                                color: #566573;
                                padding-left: 10px;
                            }
                
                            .subtitulo {
                                font-size: 1.5rem;
                                padding-left: 30px;
                            }
                
                
                            .titulo {
                                color: #707B7C;
                            }
                
                            .datos {
                                padding: 5px 0 0 20px;
                                margin: 0;
                            }
                
                
                            .tituloResultado {
                                margin-top: 1px;
                            }
                
                            .resultado {
                                font-size: 2.5em;
                                color: #1976D2;
                            }
                
                            .line {
                                border-bottom: 3px solid #1E88E5;
                                margin: 0 25px;
                            }
                
                
                            .table {
                                width: 100%;
                                margin-bottom: 1rem;
                                color: #212529;
                            }
                
                            .table td,
                            .table th {
                                padding: .75rem;
                                vertical-align: top;
                                text-align: center;
                                
                            }
                
                            .table thead th {
                                vertical-align: bottom;
                                color: #839192;
                            }
                
                            .table tbody+tbody {
                                
                            }

                            .kpi {
                                font-size: 4em;
                            }
                            
                            
                        </style>
                    </head>
                
                    <body>
                        <div id="content">
                            <div class="alerta">&nbsp'.$datos['kpi'].'</div>
                            <br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Subunidad</th>
                                        <th>Responsable</th>
                                        <th>Indicador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="color: #A6ACAF;">'.$datos['unidad'].'</td>
                                        <td style="color: #A6ACAF;">'.$datos['subunidad'].'</td>
                                        <td style="color: #A6ACAF;">'.$datos['responsable'].'</td>
                                        <td style="color: #A6ACAF;">'.$datos['kpi'].'</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <hr>
                            <table class="table">
                                <thead style="background: #808B96;">
                                    <tr>
                                        <th style="color: #fff;">Meta</th>
                                        <th style="color: #fff;">Ejecutado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="kpi">'.$datos['meta'].'</td>
                                        <td class="kpi">'.$datos['ejecutado'].'</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                
                            <hr>
                
                            <table class="table">
                                <thead style="background: #808B96;">
                                    <tr>
                                        <th style="color: #fff;">Afectaciones</th>
                                        <th style="color: #fff;">Causas</th>
                                        <th style="color: #fff;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="color: #A6ACAF;">'.$datos['afectaciones'].'</td>
                                        <td style="color: #A6ACAF;">'.$datos['causas'].'</td>
                                        <td style="color: #A6ACAF;">'.$datos['acciones'].'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h1>Este es un envio automatizado del equipo WFM Onelink</h1>
                    </body>
                </html>
            ';
          

            if($mail->send()){
                echo json_encode('El mensaje se ha entregado con exito');
            } else {
                echo json_encode('Se han presentado errores');
            }
            
        } catch (Exception $e) {
            echo json_encode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

} // fin de la clase


if(isset($_POST['destinatarios'])) {
    $datos = new FetchMatrixMail();
    $formData = array(
        'destinatarios' => $_POST['destinatarios'],
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
        'mascara' => $_POST['mascara'],
    );
    $datos -> fetchMailer($formData);
} else {
    echo json_encode('Se presentaron errores con el fetch.');
}


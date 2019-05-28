<div class="container-fluid">
    <div class="row">
        <div class="login__container" id="particles-js">
            <form class="form-signin" method="post">
                <img class="logo__anim mb-4" src="views/img/cloud2.svg" alt="clouldLogin">
                <h4 class="text-center wfmLogo">WFM - OneLink</h4>
                <label for="inputUsuario" class="sr-only">Email address</label>
                <input name="ingUsuario" type="text" id="inputUsuario" class="form-control" placeholder="Usuario" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="ingPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-warning btn-block" type="submit" id="btnLogin">Entrar</button>
                <!-- Button trigger modal -->
                <a data-toggle="modal" data-target="#exampleModal" href="#exampleModal" class="refresh__pass">
                ¿Olvidaste tu password?
                </a>
                <p class="mt-5 mb-3 text-muted text-center">&copy; 2019 - Version 1.0.0</p>

            
            </form> 
        </div>            
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg bg-dark text-white">
            <h5 class="modal-title" id="exampleModalLabel">Gestor de Password</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form id="rec__password">
                <h3>Validación de Datos</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Tipo</label>
                         <select class="form-control" name="tipoDocumento" id="tipoDocumento">
                           <option value="CC">Cédula Ciudadanía</option>
                           <option>Cédula Extrangería</option>
                           <option>Pasaporte</option>
                         </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Documento</label>
                       <input type="text" class="form-control text-center border-info" name="documento">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Fecha Expedicion</label>
                       <input type="date" class="form-control text-center border-info" name="fechaNac">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">VHUR</label>
                       <input type="text" class="form-control text-center border-info" id="vhur" name="vhur">
                    </div>
                </div>
                <h3>Cambiar Password</h3>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <h6 class="font-weight-bold">El password debe contener</h6>
                <p class="my-0 py-0">- Almenos 8 caracteres.</p>
                <p class="my-0 py-0">- Incluir una letra minuscula</p>
                <p class="my-0 py-0">- Incluir una letra mayúscula</p>
                <p class="my-0 py-0">- Incluir un número</p>
                <p class="my-0 py-0">- Incluir uno de estos caracteres especiales: !@#$%^&*+</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Password</label>
                       <input type="password" class="form-control text-center border-info" disabled name="rec__password" id="password">
                       <div id="pass__strong"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Confirme password</label>
                       <input type="password" class="form-control text-center border-info" disabled name="rec__confirmPassword" id="confirmPassword">
                       <div id="pass__alert"></div>
                    </div>
                    
                </div>
                <br>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info" data-dismiss="modal" id="reset__password"><i data-feather="refresh-ccw" disabled></i> Cambiar</button>
        </div>
        </div>
    </div>
</div>



<?php
    $login = new ControladorUsuarios();
    $login -> ctrIngresoUsuarios();

?>
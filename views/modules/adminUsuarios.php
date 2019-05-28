<?php
  // $userImg = 'views/img/users/'. $_SESSION['usuario'].'.jpg';
  $userImg = 'views/img/users/default.png';
  $usuario = $_SESSION['usuario'];
  $documento = $_SESSION['documento'];
  $nombre = $_SESSION['nombre'];

?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><h6 class="py-0"> Administración de usuarios </h6></li>
  </ol>
</nav>





<div class="container pl-5">
    <div class="row">
        <div class="col-md-3">
           <h3>Búsqueda de usuario</h3>
            <div class="form-group">
                <label for="">Usuario</label>
                <input type="text" class="form-control" id="usuarioBuscar" placeholder="Digitar usuario" required>
            </div>
        </div>
        <div class="col-md-12 my-3" id="usuarioTabla" hidden>
            <table class="table" style="width: 100%">
                <thead>
                    <tr>
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Vhur</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="usuarioDatos">
                <!-- JS Content -->
                </tbody>
            </table>
        </div>

        <div class="col-md-12 mt-5" id="usuarioVistas" hidden>
            <h3>Permisos</h3>
            <form id="permisosForm">
                <div class="form-row">
                    <div class="form-group card col-md-12 px-0 mx-2">
                        <div class="card-header">
                            Accesos
                        </div>
                        <div class="card-body row px-5" id="usuarioMenu">
                        <!-- JS Content -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>


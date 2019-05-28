<?php
  // $userImg = 'views/img/users/'. $_SESSION['usuario'].'.jpg';
  $userImg = 'views/img/users/default.png';
  $usuario = $_SESSION['usuario'];
  $documento = $_SESSION['documento'];
  $nombre = $_SESSION['nombre'];
  $cargo = $_SESSION['cargo'];

?>



<nav class="d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        <div class="profile__background">
            <div class="little-profile2 text-center">
                  <div class="pro-img2">
                    <?php echo '<img src="'.$userImg.'" alt="user">'; ?>
                  </div>
                  <?php
                  echo '
                    <h6 class="text-white pt-0 pb-0 mt-0 mb-0">' . $nombre . '</h6>
                    <p class="text-white pt-0 pb-0 mt-0 mb-0">' . $cargo . '</p>
                    <a class="nav-link text-white pt-0 pb-0 mt-0 mb-0" href="#" id="cerrarSesion"><i class="text-white pt-0" data-feather="power"></i></a>
                    <p class="nav-link text-white" id="SecondsUntilExpire"></p>
                  ';
                  ?>
            </div>
        </div>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Menu</span>
        <a class="d-flex align-items-center text-muted" href="#">
          <!-- <i id="collapse" data-feather="minus-circle" class="feather"></i> -->
          <svg id="collapse" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"<< stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
        </a>
      </h6>
      <ul class="nav flex-column">
      <!-- This code contains the validation of the profile menu -->
      <?php
          $user = $_SESSION['usuario'];
          $tipoDocumento = $_SESSION['tipoDocumento'];
          $documento = $_SESSION['documento'];
          $menu = ControladorUsuarios::ctrValidaMenu($user, $tipoDocumento, $documento);
          foreach($menu as $key => $value) {
            echo '
            <li class="nav-item">
              <a class="nav-link menu__link" href="'.$value['href'].'">
                <i data-feather="'.$value['data_feather'].'"></i>
                '.$value['texto'].'
              </a>
            </li>
            ';
          }

      ?>

      <!-- </ul>
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Aministrador</span>
      </h6>

      <ul class="nav flex-column">
      
        <li class="nav-item">
          <a data-toggle="collapse" href="#coso" role="button" aria-expanded="false" aria-controls="coso" class="nav-link">
            <i data-feather="user"></i>
              Escalation Matrix
              <i class="float-right" data-feather="chevron-down"></i>
          </a>
          <ul class="nav flex-column collapse ml-3" id="coso">
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <i data-feather="user-plus"></i>
                  Create User
                </a>
            </li>
          </ul>
        </li>
       
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i data-feather="settings"></i>
              Settings
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"><i data-feather="user"></i> Perfil</a>
              <a class="dropdown-item" href="#"><i data-feather="user-plus"></i> Contacto Admin</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout"><i data-feather="power"></i> Cerrar Sesion</a>
            </div>
        </li>
      </ul> -->
    </div>
</nav>

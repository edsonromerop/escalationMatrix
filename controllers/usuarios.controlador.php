<?php

class ControladorUsuarios {

	/*--=============================================
		INGRESO USUARIO AL SISTEMA
	=============================================*/
	static public function ctrIngresoUsuarios(){
		
		

		if(isset($_POST['ingUsuario'])) {
			$pass = $_POST['ingPassword'];
			$user = $_POST['ingUsuario'];
			
			
			$options = [
				'cost' => 12,
			];
			$passCrypt =  password_hash($pass, PASSWORD_BCRYPT, $options);
			if(preg_match('/^[1-9][0-9]*$/', $user)) {

				$respuesta = ModeloUsuarios::mdlIngresoUsuario($user);

				//Creación de variables de sesion
				$token = bin2hex(random_bytes(64));
				$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
				get_current_user();
				$windowsUser = get_current_user();
				$tipoDocumento = $respuesta['tipodocumento'];
				$documento = $respuesta['documento'];
				$passBd = $respuesta['contrasenia'];
				$nombre = $respuesta['nombre'];
				$cargo = $respuesta['cargo'];
		
				
        if(password_verify($pass, $passBd)) {
					

					$_SESSION['validarSesion'] = 'ok';
					$_SESSION['usuario'] = $user;
					$_SESSION['nombre'] = $nombre;
					$_SESSION['cargo'] = $cargo;
					$_SESSION['usuarioWindows'] = $windowsUser;
					$_SESSION['ip'] = $ip;
					$_SESSION['documento'] = $documento;
					$_SESSION['tipoDocumento'] = $tipoDocumento;
					$_SESSION['token'] = $token;

					$refreshToken = ModeloUsuarios::mdlRefreshToken ($user, $tipoDocumento, $documento, $token, $ip, $windowsUser);
					
					
					echo '<script>
							let timerInterval
							Swal.fire({
								title: "Bienvenido!:",
								html: "Cargando... <strong></strong>",
								type: "success",
								timer: 3000,
								toast: true,
								position: "center",
								showConfirmButton: false,
								onBeforeOpen: () => {
									Swal.showLoading()
									timerInterval = setInterval(() => {
									  Swal.getContent().querySelector("strong")
										//.textContent = Swal.getTimerLeft()
									}, 100)
								},
								onClose: () => {
									localStorage.clear();
									localStorage.setItem("validarSesion", "'.$_SESSION['validarSesion'].'")
									localStorage.setItem("usuario", "'.$_SESSION['usuario'].'")
									localStorage.setItem("d", "'.$_SESSION['documento'].'")
									localStorage.setItem("td", "'.$_SESSION['tipoDocumento'].'")
									window.location = "start";
								}

							})
								
						  </script>
					';

				} else {

					echo '
						<script>
							Swal.fire({
								title: "Error:",
								text: "Usuario o contraseña incorrectos!",
								type: "error",
								timer: 4000,
								toast: true,
								position: "center",
								showConfirmButton: false,
								customContainerClass: "alert__style"  
							})
						</script>
					';
					
				}
			}
		}
		
        
	}
	
	
	static public function ctrlValidateToken($user, $token) {
		$respuesta = ModeloUsuarios::mdlIngresoUsuario($user);
		if($respuesta['token'] != $token) {
			echo '
				<script>
				let timerInterval;
				Swal.fire({
					title: "Error!:",
					text: "Se ha utilizado tu usuario de acceso en otra terminal, por favor ingresa de nuevo, si no fuiste tú, contacta a tu área de soporte y notifica el problema.",
					type: "error",
					timer: 8000,
					position: "center",
					showConfirmButton: false
				})
			</script>
			';
			return 'error';
		} else {
			// echo '
			// 	<script>
			// 	let timerInterval;
			// 	Swal.fire({
			// 		title: "Sesión Ok!:",
			// 		text: "La sesión se ha validado sin problema.",
			// 		toast: true,
			// 		type: "success",
			// 		timer: 3000,
			// 		position: "center",
			// 		showConfirmButton: false
			// 	})
			// </script>
			// ';
			return 'ok';
		}
	}
	
	static public function ctrValidaMenu($user, $tipoDocumento, $documento) {
		$respuesta = ModeloUsuarios::mdlValidaMenu($user, $tipoDocumento, $documento);
		return $respuesta;
	}

	static public function ctrBuscarUsuario($usuario) {
		$respuesta = ModeloUsuarios::mdlBuscarUsuario();
	}


} // ===Fin de la clase====
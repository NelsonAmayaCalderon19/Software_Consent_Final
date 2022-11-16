<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gastroquirurgica</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon"  href="images/pestania.png">
<!--===============================================================================================-->	
	<!--<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/mainn.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="Controlador/Validar_Sesion.php" method="get">
				<img src="images/logo_inicio_sesion.jpg" class="img-fluid" alt="">
				<p class="descripcion"><strong>¿QUE ES EL CONSENTIMIENTO INFORMADO? </strong>
Es un procedimiento a través del cual un paciente es informado respecto a
todos los alcances de los procedimientos diagnósticos o terapéuticos que le serán practicados y que le permite decidir si acepta o rechaza
la alternativa propuesta por el profesional de salud con total conocimiento de esta decisión.</p>
				<span class="login100-form-title p-b-20">
						Iniciar Sesión
					</span>
					
					
					<div class="wrap-input100" data-validate = "Not Valid Document">
						<input class="input100" id="documento" type="text" name="documento" maxlength="12">
						<span class="focus-input100"></span>
						<span class="label-input100">Documento</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" id="password"  type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>
					<div align="mensaje">
                 <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
                    <h6>¡Credenciales Incorrectas!</h6>
                <?php endif; ?>
            </div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Iniciar Sesión
						</button>
					</div>
					<div class="flex-sb-m w-full p-t-10 p-b-5">
					<div>
							<a href="administracion/index.php" class="txt1">
								Iniciar Sesión como Administrador
							</a>
						</div>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>
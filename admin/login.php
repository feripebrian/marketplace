<?php

session_start();

if (!isset($_SESSION['login'])) {
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Admin - Kemenag Jaksel</title>

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="../assets/adminlte/plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="../assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../assets/adminlte/css/adminlte.min.css">

		<link href='images/logo-kemenag.png' rel='SHORTCUT ICON' />
	</head>

	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="../assets/adminlte/index2.html"><b>Admin</b>LTE</a>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Sign in to start your session</p>

					<form action="" method="post" id="form-login">
						<div class="input-group mb-3">
							<input type="email" class="form-control" name="username" id="username" placeholder="Masukkan Username" autocomplete="off" autofocus>
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">

							<input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" autocomplete="off">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
										Remember Me
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-block" name="btn-login" id="btn-login">Sign In</button>
							</div>
							<!-- /.col -->
						</div>
					</form>

					<div class="social-auth-links text-center mb-3">
						<p>- OR -</p>
						<a href="#" class="btn btn-block btn-primary">
							<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
						</a>
						<a href="#" class="btn btn-block btn-danger">
							<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
						</a>
					</div>
					<!-- /.social-auth-links -->

					<p class="mb-1">
						<a href="forgot-password.html">I forgot my password</a>
					</p>
					<p class="mb-0">
						<a href="register.html" class="text-center">Register a new membership</a>
					</p>
				</div>
				<!-- /.login-card-body -->
			</div>
		</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../assets/adminlte/js/adminlte.min.js"></script>
	</body>

	</html>

	=====================================================================================


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>Login Admin - Kemenag Jaksel</title>

		<link rel="stylesheet" href="../assets/bootstrap/bootstrap.css">
		<!-- custom css -->
		<link rel="stylesheet" href="../assets/css/login_admin.css">

		<!-- jquery js -->
		<script src="../assets/js/external/jquery/jquery.min.js"></script>
		<!-- bootstrap js -->
		<script src="../assets/js/bootstrap.min.js"></script>

	</head>

	<body>
		<div class="container">
			<div class="main-form">
				<div class="title-login text-center">
					<h2>Login Admin</h2>
					<h3>Kemenag Kota Jakarta Selatan</h3>
					<img src="images/logo-kemenag.png">

					<!-- alert -->
					<div class="alert alert-danger">
						<strong>Maaf!</strong> <span class="pesan-salah">Username atau password Anda salah.</span>
					</div> <!-- /.alert -->

					<p>Masukkan Username dan Password Anda</p>
				</div>

				<form action="" class="cf" id="form-login">
					<div class="form-group input-group">
						<input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" autocomplete="off" autofocus>
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					</div>

					<div class="form-group input-group">
						<input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" autocomplete="off">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					</div>

					<button type="submit" class="btn btn-primary btn-login" name="btn-login" id="btn-login">Login</button>
				</form>
			</div> <!-- /.main-form -->
		</div> <!-- /.container -->

		<script src="../assets/js/form_validation/form_validation_login.js"></script>
	</body>

	</html>

<?php
} else {
	header("location:index.php");
}
?>
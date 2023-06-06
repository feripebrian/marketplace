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
		<link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">

		<link href='images/logo-kemenag.png' rel='SHORTCUT ICON' />
	</head>

	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<h2>Login Admin</h2>
				<h3>Kemenag Kota Jakarta Selatan</h3>
				<img src="../assets/adminlte/docs/assets/img/logo-kemenag.png" alt="">

			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<!-- alert -->
					<div class="alert alert-danger">
						<strong>Maaf!</strong> <span class="pesan-salah">Username atau password Anda salah.</span>
					</div> <!-- /.alert -->
					<p class="login-box-msg">Masukkan Username dan Password Anda</p>

					<form action="" class="cf" id="form-login">
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" autocomplete="off" autofocus>
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
							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-login" name="btn-login" id="btn-login">Sign In</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
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
		<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>

		<script src="../assets/js/form_validation/form_validation_login.js"></script>
	</body>

	</html>

<?php
} else {
	header("location:index.php");
}
?>
<?php
	
	session_start();
	require 'config/koneksi.php';
	
	header('Content-Type: application/json');

	if( @$_GET['op'] == "in" ) {
		// LOGIN
		if( $_POST ) {
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$passok   = sha1($password);

			$admin      = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$username' AND password='$passok' AND status=1");
			$data_admin = mysqli_fetch_assoc($admin);

			// CEK APAKAH USERNAME DAN PASSWORD ADA
			$cek_data_admin = mysqli_num_rows($admin);
			if( $cek_data_admin === 1 ) {
				$hasil['hasil'] = "berhasil";

				// BUAT SESSION
				$_SESSION['login']      = true;
				$_SESSION['id_admin']   = $data_admin['id_admin'];
				$_SESSION['nama_admin'] = $data_admin['nama_admin'];
				$_SESSION['level']      = $data_admin['level'];
			} else {
				$hasil['hasil'] = "gagal";
			}

			echo json_encode($hasil);
		} else {
			header("location:login.php");
		}
	} else if( @$_GET['op'] == "out" ) {
		// LOG OUT
		session_unset();
		session_destroy();

		header("location:login.php");
	} else {
		header("location:login.php");
	}
<?php
	
	require '../config/koneksi.php';

	if( $_POST ) {
		$id_admin  = mysqli_real_escape_string($conn, $_POST['id_admin']);
		$pass_lama = mysqli_real_escape_string($conn, sha1($_POST['password_lama']));

		$cek_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin=$id_admin");
		$hasil_cek = mysqli_fetch_assoc($cek_admin);

		// CEK PASSWORD LAMA
		if( $pass_lama != $hasil_cek['password'] ) {
			$data['hasil'] = "invalid password";
			$data['pesan'] = "Password lama tidak sesuai";
		} else {
			$pass_baru = mysqli_real_escape_string($conn, $_POST['password_baru']);
			$pass_conf = mysqli_real_escape_string($conn, $_POST['password_confirmation']);

			// CEK KONFIRMASI PASSWORD
			if( $pass_baru != $pass_conf ) {
				$data['hasil'] = "invalid confirmation";
				$data['pesan'] = "Konfirmasi password tidak sesuai.";
			} else {
				$pass_baruok = sha1($pass_baru);

				// UPDATE DATA PASSWORD ADMIN
				$query = mysqli_query($conn, "UPDATE tb_admin SET password='$pass_baruok' WHERE id_admin=$id_admin");

				// CEK UPDATE QUERY
				if( $query ) {
					$data['hasil'] = "sukses";
					$data['pesan'] = "Password berhasil di ubah.";
				} else {
					$data['hasil'] = "gagal";
					$data['pesan'] = "Password gagal di ubah.";
				}
			}
		}

		echo json_encode($data);
	}
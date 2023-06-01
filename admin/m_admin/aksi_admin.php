<?php
	
	require '../../config/koneksi.php';
	require 'funct_admin.php';

	// CEK $_GET
	if( @$_GET['admin'] == "tambah" ) {
		if( $_POST ) {
			// CEK USERNAME ADMIN
			$username_admin = cek_username_admin($_POST['username_admin']);
			if( $username_admin == true ) {
				// CEK KOMFIRMASI PASSWORD
				$konfirmasi_password = cek_konfirmasi_password($_POST['password_admin'], $_POST['password_confirmation_admin']);
				if( $konfirmasi_password == true ) {
					// SIMPAN DATA ADMIN
					if( simpan_admin($_POST) > 0 ) {
						$data['hasil'] = "sukses";
						$data['pesan']['sukses'] = "Data admin berhasil di-Simpan.";
					} else {
						$data['hasil'] = "gagal";
						$data['pesan']['gagal'] = "Data admin gagal di-Simpan.";
					}
				} else {
					$data['hasil'] = "konfirmasi tidak sesuai";
					$data['pesan']['invalid'] = "Konfirmasi password tidak sesuai.";
				}
			} else {
				$data['hasil'] = "username ada";
				$data['pesan']['invalid'] = "Username sudah ada.";
			}

			echo json_encode($data);
		}
	} else if( @$_GET['status'] == "0" ) {
		if( $_POST ) {
			// UPDATE STATUS ADMIN MENJADI NONAKTIF
			if( update_status_admin($_POST, 0) > 0 ) {
				$data['hasil'] = "sukses";
				$data['pesan']['sukses'] = "Status admin berhasil di-Nonaktifkan.";
			} else {
				$data['hasil'] = "gagal";
				$data['pesan']['gagal'] = "Status admin gagal di-Nonaktifkan.";
			}

			echo json_encode($data);
		}
	} else if( @$_GET['status'] == "1" ) {
		if( $_POST ) {
			// UPDATE STATUS ADMIN MENJADI AKTIF
			if( update_status_admin($_POST, 1) > 0 ) {
				$data['hasil'] = "sukses";
				$data['pesan']['sukses'] = "Status admin berhasil di-Aktifkan.";
			} else {
				$data['hasil'] = "gagal";
				$data['pesan']['gagal'] = "Status admin gagal di-Aktifkan.";
			}

			echo json_encode($data);
		}
	}
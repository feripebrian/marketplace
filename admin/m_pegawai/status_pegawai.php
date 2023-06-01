<?php

	require '../../config/koneksi.php';
	require 'funct_pegawai.php';

	// CEK APAKAH $_POST['nip'] ADA
	if( !empty($_POST['nip']) ) {
		$nip = mysqli_real_escape_string($conn, $_POST['nip']);

		// CEK $_GET
		if( @$_GET['status'] == "1" ) {
			// PROSES UPDATE STATUS PEGAWAI
			if( update_status_pegawai($nip, 1) > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Status pegawai di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Status pegawai di-Update.";
			}
		} else if( @$_GET['status'] == "0" ) {
			// PROSES UPDATE STATUS PEGAWAI
			if( update_status_pegawai($nip, 0) > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Status pegawai di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Status pegawai di-Update.";
			}
		} else {
			$hasil = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Status pegawai di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
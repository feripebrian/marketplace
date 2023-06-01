<?php

	require '../../config/koneksi.php';
	require 'funct_masa_kepala_kantor.php';

	// CEK APAKAH $_POST['nip'] ADA
	if( !empty($_POST['nip']) ) {
		$nip = mysqli_real_escape_string($conn, $_POST['nip']);

		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW ITEM MASA KEPALA KANTOR
			if( update_show_masa_kpl($nip, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Show masa kepala kantor di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Show masa kepala kantor di-Update.";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW ITEM MASA KEPALA KANTOR
			if( update_show_masa_kpl($nip, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Show masa kepala kantor di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Show masa kepala kantor di-Update.";
			}
		} else {
			$hasil = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Show masa kepala kantor di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
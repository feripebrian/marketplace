<?php

	require '../../config/koneksi.php';
	require 'funct_link_direktori.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW LINK DIREKTORI
			if( update_show_link_direktori($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data link direktori di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Update.";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW LINK DIREKTORI
			if( update_show_link_direktori($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data link direktori di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Update.";
			}
		} else {
			$hasil = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
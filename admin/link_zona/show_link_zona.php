<?php

	require '../../config/koneksi.php';
	require 'funct_link_zona.php';
	
	header('Content-Type: application/json');

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW LINK ZONA
			if( update_show_link_zona($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW LINK ZONA
			if( update_show_link_zona($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
			}
		} else {
			$hasil = "gagal";
		}

		// CEK HASIL UPDATE DATA LINK ZONA
		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pesan']['sukses'] = "Berhasil! Data link zona di-Update.";
		} else {
			$hasil['pesan']['gagal']  = "Gagal! Data link zona di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
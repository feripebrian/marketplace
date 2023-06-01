<?php

	require '../../config/koneksi.php';
	require 'funct_link_pontren.php';
	
	header('Content-Type: application/json');

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW LINK pontren
			if( update_show_link_pontren($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW LINK pontren
			if( update_show_link_pontren($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
			}
		} else {
			$hasil = "gagal";
		}

		// CEK HASIL UPDATE DATA LINK pontren
		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pesan']['sukses'] = "Berhasil! Data link pontren di-Update.";
		} else {
			$hasil['pesan']['gagal']  = "Gagal! Data link pontren di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
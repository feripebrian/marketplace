<?php

	require '../../config/koneksi.php';
	require 'funct_link_survey.php';
	
	header('Content-Type: application/json');

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW LINK SURVEY
			if( update_show_link_survey($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW LINK SURVEY
			if( update_show_link_survey($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
			}
		} else {
			$hasil = "gagal";
		}

		// CEK HASIL UPDATE DATA LINK SURVEY
		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pesan']['sukses'] = "Berhasil! Data link survey di-Update.";
		} else {
			$hasil['pesan']['gagal']  = "Gagal! Data link survey di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
<?php

	require '../../config/koneksi.php';
	require 'funct_unit_kerja.php';

	// CEK APAKAH $_POST['kd'] ADA
	if( !empty($_POST['kd']) ) {
		// CEK $_GET
		if( @$_GET['show'] == "Y" ) {
			// PROSES UPDATE SHOW ITEM UNIT KERJA
			if( update_show_unit_kerja($_POST['kd'], "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data unit kerja di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal'] = "Gagal! Data unit kerja di-Update.";
			}
		} else if( @$_GET['show'] == "N" ) {
			// PROSES UPDATE SHOW ITEM UNIT KERJA
			if( update_show_unit_kerja($_POST['kd'], "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data unit kerja di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal'] = "Gagal! Data unit kerja di-Update.";
			}
		} else {
			$hasil = "gagal";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
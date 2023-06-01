<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_survey.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linksurvey'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK SURVEY
			if( simpan_link_survey($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK SURVEY
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link survey di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link survey di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linksurvey'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK SURVEY
			if( ubah_link_survey($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK SURVEY
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link survey di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link survey di-Ubah.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else {
		$hasil['hasil'] = "gagal";
		echo json_encode($hasil);
	}
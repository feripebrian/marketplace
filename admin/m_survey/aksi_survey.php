<?php
	
	require '../../config/koneksi.php';
	require 'funct_survey.php';

	// CEK $_GET
	if( @$_GET['zona'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA SURVEY
			if( simpan_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA SURVEY
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data zona di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data zona di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['zona'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA SURVEY
			if( ubah_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA SURVEY
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data survey di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data survey di-Ubah.";
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
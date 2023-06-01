<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_penmad.php';
	
	header('Content-Type: application/json');
	

	// CEK $_GET
	if( @$_GET['linkpenmad'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK penmad
			if( simpan_link_penmad($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK penmad
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link penmad di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link penmad di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkpenmad'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK penmad
			if( ubah_link_penmad($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK penmad
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link penmad di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link penmad di-Ubah.";
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
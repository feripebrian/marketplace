<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_bimas.php';

	header('Content-Type: application/json');
	
	// CEK $_GET
	if( @$_GET['linkbimas'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK bimas
			if( simpan_link_bimas($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK bimas
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link bimas di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link bimas di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkbimas'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK bimas
			if( ubah_link_bimas($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK bimas
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link bimas di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link bimas di-Ubah.";
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
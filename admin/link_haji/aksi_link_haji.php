<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_haji.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkhaji'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK haji
			if( simpan_link_haji($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK haji
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link haji di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link haji di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkhaji'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK haji
			if( ubah_link_haji($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK haji
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link haji di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link haji di-Ubah.";
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
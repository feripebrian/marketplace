<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_inovasi.php';
	
	header('Content-Type: application/json');


	// CEK $_GET
	if( @$_GET['linkinovasi'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK INOVASI
			if( simpan_link_inovasi($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK INOVASI
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link inovasi di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link inovasi di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkinovasi'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK INOVASI
			if( ubah_link_inovasi($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK INOVASI
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link inovasi di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link inovasi di-Ubah.";
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
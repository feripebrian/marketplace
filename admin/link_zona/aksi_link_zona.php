<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_zona.php';

    header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkzona'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK ZONA
			if( simpan_link_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link zona di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link zona di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkzona'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK ZONA
			if( ubah_link_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link zona di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link zona di-Ubah.";
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
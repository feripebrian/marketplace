<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_pontren.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkpontren'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK pontren
			if( simpan_link_pontren($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK pontren
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link pontren di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link pontren di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkpontren'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK pontren
			if( ubah_link_pontren($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK pontren
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link pontren di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link pontren di-Ubah.";
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
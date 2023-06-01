<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_dampak.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkdampak'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK DAMPAK
			if( simpan_link_dampak($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK DAMPAK
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link dampak di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link dampak di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkdampak'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK DAMPAK
			if( ubah_link_dampak($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK DAMPAK
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link dampak di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link dampak di-Ubah.";
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
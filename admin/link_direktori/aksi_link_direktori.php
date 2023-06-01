<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_direktori.php';

	// CEK $_GET
	if( @$_GET['linkdir'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK DIREKTORI
			if( simpan_link_direktori($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data link direktori di-Simpan.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Simpan.";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkdir'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK DIREKTORI
			if( ubah_link_direktori($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data link direktori di-Ubah.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data link direktori di-Simpan.";
			echo json_encode($hasil);
		}
	} else {
		$hasil['hasil'] = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
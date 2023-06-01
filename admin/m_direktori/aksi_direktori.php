<?php
	
	require '../../config/koneksi.php';
	require 'funct_direktori.php';

	// CEK $_GET
	if( @$_GET['direktori'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA DIREKTORI
			if( simpan_direktori($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA DIREKTORI
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data direktori di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data direktori di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['direktori'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA DIREKTORI
			if( ubah_direktori($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA DIREKTORI
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data direktori di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data direktori di-Ubah.";
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
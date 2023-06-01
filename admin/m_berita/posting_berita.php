<?php

	require '../../config/koneksi.php';
	require 'funct_berita.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		// CEK $_GET
		if( @$_GET['posting'] == "Y" ) {
			// PROSES POSTING DATA BERITA
			if( update_posting_berita($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data berita di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data berita di-Update.";
			}
		} else if( @$_GET['posting'] == "N" ) {
			// PROSES UNPOSTING DATA BERITA
			if( update_posting_berita($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data berita di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data berita di-Update.";
			}
		} else {
			$hasil = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data berita di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
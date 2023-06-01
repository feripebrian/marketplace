<?php

	require '../../config/koneksi.php';
	require 'funct_layanan_publik.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($id = $_POST['id']) ) {
		$id = mysqli_real_escape_string($conn, $_POST['id']);

		// CEK $_GET
		if( @$_GET['posting'] == "Y" ) {
			// PROSES POSTING LAYANAN PUBLIK
			if( update_posting_layanan_publik($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data layanan publik di-Update.";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data layanan publik di-Update.";
			}
		} else if( @$_GET['posting'] == "N" ) {
			// PROSES UNPOSTING LAYANAN PUBLIK
			if( update_posting_layanan_publik($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data layanan publik di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data layanan publik di-Update.";
			}
		} else {
			$hasil = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data layanan publik di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
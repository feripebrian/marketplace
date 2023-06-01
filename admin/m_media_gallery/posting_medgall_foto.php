<?php

	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_media_gallery.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// CEK $_GET
		if( @$_GET['posting'] == "Y" ) {
			// PROSES POSTING MEDIA GALLERY FOTO
			if( update_posting_media_foto($id, "Y") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil']  = "gagal";
			}
		} else if( @$_GET['posting'] == "N" ) {
			// PROSES UNPOSTING MEDIA GALLERY FOTO
			if( update_posting_media_foto($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
			}
		} else {
			$hasil = "gagal";
		}

		// CEK HASIL UPDATE DATA MEDIA GALLERY FOTO
		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pesan']['sukses'] = "Berhasil! Data media foto di-Update.";
		} else {
			$hasil['pesan']['gagal']  = "Gagal! Data media foto di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
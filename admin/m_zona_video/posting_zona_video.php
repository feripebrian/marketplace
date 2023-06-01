<?php

	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_media_gallery.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// CEK $_GET
		if( @$_GET['posting'] == "Y" ) {
			// CEK POSTING DATA MEDIA GALLERY VIDEO
			if( cek_posting_media_video() >= 0 && cek_posting_media_video() < 1 ) {
				// PROSES POSTING MEDIA GALLERY VIDEO
				if( update_posting_media_video($id, "Y") > 0 ) {
					// BERHASIL
					$hasil['hasil'] = "sukses";
				} else {
					// GAGAL
					$hasil['hasil']  = "gagal";
				}
			} else {
				// POSTING DATA MEDIA GALLERY VIDEO SUDAH > 1
				$hasil['hasil'] = "penuh";
			}
		} else if( @$_GET['posting'] == "N" ) {
			// PROSES UNPOSTING MEDIA GALLERY VIDEO
			if( update_posting_media_video($id, "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
			}
		} else {
			$hasil = "gagal";
		}

		// CEK HASIL UPDATE DATA MEDIA GALLERY VIDEO
		if( $hasil['hasil'] == "sukses" ) {
			$hasil['pesan']['sukses'] = "Berhasil! Data media video di-Update.";
		} else {
			$hasil['pesan']['gagal']  = "Gagal! Data media video di-Update.";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
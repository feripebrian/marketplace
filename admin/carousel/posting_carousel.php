<?php

	require '../../config/koneksi.php';
	require 'funct_carousel.php';

	// CEK APAKAH $_POST['id'] ADA
	if( !empty($_POST['id']) ) {
		// CEK $_GET
		if( @$_GET['posting'] == "Y" ) {
			// CEK POSTING DATA CAROUSEL
			if( cek_posting_carousel() >= 0 && cek_posting_carousel() < 4 ) {
				// PROSES POSTING CAROUSEL
				if( update_posting_carousel($_POST['id'], "Y") > 0 ) {
					// BERHASIL
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data carousel di-Update.";
				} else {
					// GAGAL
					$hasil['hasil']  = "gagal";
					$hasil['pesan']['gagal'] = "Gagal! Data carousel di-Update.";
				}
			} else {
				// PROSES POSTING CAROUSEL SUDAH > dari 4
				$hasil['hasil'] = "not posting";
				$hasil['pesan']['notposting'] = "Carousel maksimal 4 posting.";
			}
		} else if( @$_GET['posting'] == "N" ) {
			// PROSES UNPOSTING CAROUSEL
			if( update_posting_carousel($_POST['id'], "N") > 0 ) {
				// BERHASIL
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data carousel di-Update.";
			} else {
				// GAGAL
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal'] = "Gagal! Data carousel di-Update.";
			}
		} else {
			$hasil = "gagal";
		}

		echo json_encode($hasil);
	} else {
		$hasil = "gagal";
		echo json_encode($hasil);
	}
<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_surat.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linksurat'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK surat
			if( simpan_link_surat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK surat
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link peraturan & informasi di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link peraturan & informasi di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linksurat'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK surat
			if( ubah_link_surat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK surat
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link peraturan & informasi di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link peraturan & informasi di-Ubah.";
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
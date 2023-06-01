<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_maklumat.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkmaklumat'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK MAKLUMAT
			if( simpan_link_maklumat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK MAKLUMAT
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link maklumat di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link maklumat di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkmaklumat'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK MAKLUMAT
			if( ubah_link_maklumat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK MAKLUMAT
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link maklumat di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link maklumat di-Ubah.";
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
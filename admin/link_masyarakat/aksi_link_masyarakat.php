<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_masyarakat.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkmasyarakat'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK MASYARAKAT
			if( simpan_link_masyarakat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK MASYARAKAT
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link masyarakat di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link masyarakat di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkmasyarakat'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK MASYARAKAT
			if( ubah_link_masyarakat($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK MASYARAKAT
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link masyarakat di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link masyarakat di-Ubah.";
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
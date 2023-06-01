<?php
	
	require '../../config/koneksi.php';
	require 'funct_link_pengaduan.php';
	
	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['linkpengaduan'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK PENGADUAN
			if( simpan_link_pengaduan($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK PENGADUAN
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link pengaduan di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link pengaduan di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkpengaduan'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK PENGADUAN
			if( ubah_link_pengaduan($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK PENGADUAN
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data link pengaduan di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data link pengaduan di-Ubah.";
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
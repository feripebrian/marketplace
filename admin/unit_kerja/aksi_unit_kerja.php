<?php
	
	require '../../config/koneksi.php';
	require 'funct_unit_kerja.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['unitkerja'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA UNIT KERJA
			if( simpan_unit_kerja($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data unit kerja di-Simpan.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal'] = "Gagal! Data unit kerja di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else if( @$_GET['unitkerja'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA UNIT KERJA
			if( ubah_unit_kerja($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data unit kerja di-Ubah.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal'] = "Gagal! Data unit kerja di-Ubah.";
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
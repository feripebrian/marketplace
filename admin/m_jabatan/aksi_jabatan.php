<?php
	
	require '../../config/koneksi.php';
	require 'funct_jabatan.php';

	// CEK $_GET
	if( @$_GET['jabatan'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA JABATAN
			if( simpan_jabatan($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data jabatan di-Simpan.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data jabatan di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data jabatan di-Simpan.";
			echo json_encode($hasil);
		}
	} else if( @$_GET['jabatan'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA JABATAN
			if( ubah_jabatan($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data jabatan di-Ubah.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data jabatan di-Ubah.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data jabatan di-Ubah.";
			echo json_encode($hasil);
		}
	} else {
		$hasil['hasil'] = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
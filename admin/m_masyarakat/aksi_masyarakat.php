<?php
	
	require '../../config/koneksi.php';
	require 'funct_zona.php';

	// CEK $_GET
	if( @$_GET['zona'] == "tambah" ) {
		if( $_POST ) {
			// PROSES SIMPAN DATA ZONA
			if( simpan_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data zona di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data zona di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['zona'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA ZONA
			if( ubah_zona($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data zona di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data zona di-Ubah.";
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
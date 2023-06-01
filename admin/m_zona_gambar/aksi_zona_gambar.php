<?php
	
	require '../../config/koneksi.php';
	require 'funct_zona_gambar.php';

	// CEK $_GET
	if( @$_GET['linkdata'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK ZONA
			if( simpan_link_gambar($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data integritas gambar di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Gambar integritas gambar di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkdata'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK ZONA
			if( ubah_link_gambar($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data integritas gambar di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data integritas gambar di-Ubah.";
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
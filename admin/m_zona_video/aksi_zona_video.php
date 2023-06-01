<?php
	
	require '../../config/koneksi.php';
	require 'funct_zona_video.php';

	// CEK $_GET
	if( @$_GET['linkdata'] == "tambah" ){
		if( $_POST ) {
			// PROSES SIMPAN DATA LINK ZONA
			if( simpan_link_video($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL SIMPAN DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data integritas video di-Simpan.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! video integritas video di-Simpan.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			echo json_encode($hasil);
		}
	} else if( @$_GET['linkdata'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA LINK ZONA
			if( ubah_link_video($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			// CEK HASIL UBAH DATA LINK ZONA
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data integritas video di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data integritas video di-Ubah.";
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
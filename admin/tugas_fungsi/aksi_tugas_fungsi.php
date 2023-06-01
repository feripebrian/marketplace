<?php
	
	require '../../config/koneksi.php';
	require 'funct_tugas_fungsi.php';

	// CEK $_GET
	if( @$_GET['tugasfungsi'] == "ubah" ) {
		if( $_POST ) {
			if( ubah_tugas_fungsi($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
			} else {
				$hasil['hasil'] = "gagal";
			}

			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data tugas fungsi di-Ubah.";
			} else {
				$hasil['pesan']['gagal'] = "Gagal! Data tugas fungsi di-Ubah.";
			}

			echo json_encode($hasil);
		}
	}
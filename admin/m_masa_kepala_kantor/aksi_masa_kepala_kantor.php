<?php
	
	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_masa_kepala_kantor.php';

	// CEK $_GET
	if( @$_GET['masakpl'] == "tambah" ) {
		if( $_POST ) {
			// PROSES CEK NIP KEPALA KANTOR
			if( cek_nip_kpl($_POST['kepala_kantor']) == true ) {
				// PROSES SIMPAN DATA MASA KEPALA KANTOR
				if( simpan_masa_kpl($_POST) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data kepala kantor di-Simpan.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data kepala kantor di-Simpan.";
				}
			} else {
				$hasil['hasil'] = "duplicate nip";
				$hasil['pesan']['duplicate'] = "Kepala Kantor sudah ada.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data kepala kantor di-Simpan.";
			echo json_encode($hasil);
		}
	} else if( @$_GET['masakpl'] == "ubah" ) {
		if( $_POST ) {
			// PROSES UBAH DATA MASA KEPALA KANTOR
			if( ubah_masa_kpl($_POST) > 0 ) {
				$hasil['hasil'] = "sukses";
				$hasil['pesan']['sukses'] = "Berhasil! Data kepala kantor di-Ubah.";
			} else {
				$hasil['hasil'] = "gagal";
				$hasil['pesan']['gagal']  = "Gagal! Data kepala kantor di-Ubah.";
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal']  = "Gagal! Data kepala kantor di-Ubah.";
			echo json_encode($hasil);
		}
	} else {
		$hasil['hasil'] = "gagal";
		$hasil['pesan']['gagal']  = "Gagal!";
		echo json_encode($hasil);
	}
<?php

	require '../../config/koneksi.php';
	require 'funct_struktur_organisasi.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['org'] == "ubah" ) {
		if( $_POST ) {
			$data_file  = $_FILES;
			$data_input = $_POST;

			if( count($data_input) < 3 ) {
				// PROSES UBAH DATA STRUKTUR ORGANISASI
				$hasil_update_gambar = ubah_struktur_organisasi($data_input['id_struktur_org'], $data_file);

				if( $hasil_update_gambar > 0 ) {
					$hasil['hasil'] = "sukses";
				} else {
					$hasil['hasil'] = "gagal";
				}
			} else {
				$hitung_input        = count($data_input['no_detail_org']);
				$hasil_update_gambar = ubah_struktur_organisasi($data_input['id_struktur_org'], $data_file);

				if( $hasil_update_gambar > 0 || $hasil_update_gambar === false ) {
					for( $i=0; $i<$hitung_input; $i++ ) {
						// DEKLARASI $data_input
						$id_struktur_org = $data_input['id_struktur_org'];
						$no_detail_org   = $data_input['no_detail_org'][$i];
						$nip             = $data_input['pegawai'][$i];

						// PROSES UBAH DATA DETAIL STRUKTUR ORGANISASI
						if( ubah_detail_struktur_organisasi($id_struktur_org, $no_detail_org, $nip) > 0 ) {
							$hasil['hasil'] = "sukses";
						} else {
							$hasil['hasil'] = "gagal";
						}
					}
				} else {
					$hasil['hasil'] = "gagal";
				}
			}

			// CEK HASIL UBAH DATA STRUKTUR ORGANISASI
			if( $hasil['hasil'] == "sukses" ) {
				$hasil['pesan']['sukses'] = "Berhasil! Data struktur organisasi di-Ubah.";
			} else {
				$hasil['pesan']['gagal']  = "Gagal! Data struktur organisasi di-Ubah.";
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
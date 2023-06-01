<?php
	
	require '../../config/koneksi.php';
	require 'funct_detail_unit_kerja.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['detailuk'] == "tambah" ) {
		if( $_POST ) {
			$data_form  = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid      = true;

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['file']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files($data_form['data_file']) == true ) {
					$hasil['hasil'] = "match";
					$valid = true;
				} else {
					$hasil['hasil'] = "not match";
					$hasil['pesan']['notmatch'] = "Format file harus .pdf";
					$valid = false;
				}
			}

			if( $valid === true ) {
				// PROSES SIMPAN DATA DETAIL UNIT KERJA
				if( simpan_detail_unit_kerja($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data detail unit kerja di-Simpan.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data detail unit kerja di-Simpan.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else if( @$_GET['detailuk'] == "ubah" ) {
		if( $_POST ) {
			$data_form  = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid      = true;

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['file']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files($data_form['data_file']) == true ) {
					$hasil['hasil'] = "match";
					$valid = true;
				} else {
					$hasil['hasil'] = "not match";
					$hasil['pesan']['notmatch'] = "Format file harus .pdf";
					$valid = false;
				}
			}

			if( $valid === true ) {
				// PROSES UBAH DATA DETAIL UNIT KERJA
				if( ubah_detail_unit_kerja($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data detail unit kerja di-Ubah.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data detail unit kerja di-Ubah.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
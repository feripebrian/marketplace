<?php
	
	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_berita.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['berita'] == "tambah" ) {
		if( $_POST ) {
			$data_form = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid     = true;

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['gambar']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files_type($data_form['data_file']['gambar']['name']) == true ) {
					// CEK UKURAN FILE GAMBAR
					if( cek_files_size($data_form['data_file']['gambar']['size']) != true ) {
						$hasil['hasil'] = "image size";
						$hasil['pesan']['notsize'] = "Ukuran gambar terlalu besar.";
						$valid = false;
					}
				} else {
					$hasil['hasil'] = "image not match";
					$hasil['pesan']['notmatch'] = "Format file harus .jpeg/.jpg/.png.";
					$valid = false;
				}
			} else {
				$valid = false;
				$hasil['hasil'] = "image nothing";
				$hasil['pesan']['nothing'] = "Mohon dilengkapi.";
			}

			if( $valid === true ) {
				// PROSES SIMPAN DATA BERITA
				if( simpan_berita($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data berita di-Simpan.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal'] = "Gagal! Data berita di-Simpan.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else if( @$_GET['berita'] == "ubah" ) {
		if( $_POST ) {
			$data_form = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid     = true;

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['gambar']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files_type($data_form['data_file']['gambar']['name']) == true ) {
					// CEK UKURAN FILE GAMBAR
					if( cek_files_size($data_form['data_file']['gambar']['size']) != true ) {
						$hasil['hasil'] = "image size";
						$hasil['pesan']['notsize'] = "Ukuran gambar terlalu besar.";
						$valid = false;
					}
				} else {
					$hasil['hasil'] = "image not match";
					$hasil['pesan']['notmatch'] = "Format file harus .jpeg/.jpg/.png.";
					$valid = false;
				}
			}

			if( $valid === true ) {
				// PROSES UBAH DATA BERITA
				if( ubah_berita($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data berita di-Ubah.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal'] = "Gagal! Data berita di-Ubah.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
<?php
	
	require '../../config/koneksi.php';
	require 'funct_layanan_publik.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['layananpublik'] == "tambah" ) {
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
				// PROSES SIMPAN DATA LAYANAN PUBLIK
				if( simpan_layanan_publik($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data layanan publik di-Simpan.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data layanan publik di-Simpan.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else if( @$_GET['layananpublik'] == "ubah" ) {
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
				// PROSES UBAH DATA LAYANAN PUBLIK
				if( ubah_layanan_publik($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data layanan publik di-Ubah.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data layanan publik di-Ubah.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
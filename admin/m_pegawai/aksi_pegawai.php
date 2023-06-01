<?php
	
	require '../../config/koneksi.php';
	require 'funct_pegawai.php';

	header('Content-Type: application/json');

	// CEK $_GET
	if( @$_GET['pegawai'] == "tambah" ) {
		if( $_POST ) {
			$data_form = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid     = true;

			if( cek_nip($data_form['data_input']['nip']) != true ) {
				$valid = false;
				$hasil['hasil'] = "duplicate nip";
				$hasil['pesan']['duplicate'] = "NIP sudah ada.";
			}

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['foto']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files_type($data_form['data_file']['foto']['name']) == true ) {
					// CEK UKURAN FILE FOTO
					if( cek_files_size($data_form['data_file']['foto']['size']) != true ) {
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
				// PROSES SIMPAN DATA PEGAWAI
				if( simpan_pegawai($data_form['data_input'], $data_form['data_file']) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Berhasil! Data pegawai di-Simpan.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal']  = "Gagal! Data pegawai di-Simpan.";
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else if( @$_GET['pegawai'] == "ubah" ) {
		if( $_POST ) {
			$data_form = ['data_input' => $_POST, 'data_file' => $_FILES];
			$valid     = true;

			$nip_lama = mysqli_real_escape_string($conn, $data_form['data_input']['nip_lama']);
			$nip_baru = mysqli_real_escape_string($conn, $data_form['data_input']['nip_baru']);

			// CEK APAKAH FILE DI UPLOAD
			if( $data_form['data_file']['foto']['error'] === UPLOAD_ERR_OK ) {
				// JIKA FILE DI UPLOAD MAKA...
				if( cek_files_type($data_form['data_file']['foto']['name']) == true ) {
					// CEK UKURAN FILE FOTO
					if( cek_files_size($data_form['data_file']['foto']['size']) != true ) {
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

			if( $nip_lama == $nip_baru ) {
				if( $valid === true ) {
					// PROSES UBAH DATA PEGAWAI
					if( ubah_pegawai($data_form['data_input'], $data_form['data_file'], 0) > 0 ) {
						$hasil['hasil'] = "sukses";
						$hasil['pesan']['sukses'] = "Berhasil! Data pegawai di-Ubah.";
					} else {
						$hasil['hasil'] = "gagal";
						$hasil['pesan']['gagal']  = "Gagal! Data pegawai di-Ubah.";
					}
				}
			} else {
				if( cek_nip($data_form['data_input']['nip_baru']) != true ) {
					$valid = false;
					$hasil['hasil'] = "duplicate nip";
					$hasil['pesan']['duplicate'] = "NIP sudah ada.";
				}

				if( $valid === true ) {
					// PROSES UBAH DATA PEGAWAI
					if( ubah_pegawai($data_form['data_input'], $data_form['data_file'], 1) > 0 ) {
						$hasil['hasil'] = "sukses";
						$hasil['pesan']['sukses'] = "Berhasil! Data pegawai di-Ubah.";
					} else {
						$hasil['hasil'] = "gagal";
						$hasil['pesan']['gagal']  = "Gagal! Data pegawai di-Ubah.";
					}
				}
			}

			echo json_encode($hasil);
		} else {
			echo 'Error Page! Halaman tidak ada.';
		}
	} else {
		echo 'Error Page! Halaman tidak ada.';
	}
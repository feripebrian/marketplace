<?php

	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_media_gallery.php';

	// CEK $_GET
	if( @$_GET['foto'] == "tambah" ) {
		if (!empty($_FILES["media"])) {
			$media	  = $_FILES["media"];
			$jml_file = count($media['name']);

			if( $jml_file>0 ) {
				$hasil = 0;
				// PROSES SIMPAN MEDIA GALLERY FOTO
				for ($i=0; $i<$jml_file; $i++) {
					$id_admin  = $_POST['id_admin'];
					// DEKLARASI ATRIBUT $media
					$file_name  = $media['name'][$i];
					$file_size  = $media['size'][$i];
					$file_error = $media['error'][$i];
					$file_tmp   = $media['tmp_name'][$i];

					// PROSES SIMPAN DATA MEDIA GALLERY FOTO
					if( simpan_media_foto($file_name, $file_size, $file_error, $file_tmp, $id_admin) > 0 ) {
						$hasil = $hasil + 1;
					} else {
						echo "gagal";
					}
				}

				echo $hasil;
			} else {
				echo "gagal";
			}
		} else {
			echo "gagal";
		}
	} else if( @$_GET['foto'] == "ubah" ) {
		if (!empty($_FILES["foto"])) {
			$file       = $_FILES["foto"];
			$id_medgall = $_POST['id_medgall'];
			$id_admin   = $_POST['id_admin'];
			$judul      = $_POST['judul'];

			// DEKLARASI ATRIBUT $file
			$file_name  = $file['name'];
			$file_size  = $file['size'];
			$file_error = $file['error'];
			$file_tmp   = $file['tmp_name'];
			
			// PROSES UBAH DATA MEDIA GALLERY FOTO
			if( ubah_media_foto($file_name, $file_size, $file_error, $file_tmp, $id_medgall, $id_admin, $judul) > 0 ) {
				echo "sukses";
			} else {
				echo "gagal";
			}
		} else {
			echo "gagal";
		}
	} else {
		echo "gagal";
	}
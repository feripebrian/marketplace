<?php

	require '../../config/koneksi.php';
	require '../helpers/funct_tanggal.php';
	require 'funct_media_gallery.php';

	// CEK $_GET
	if( @$_GET['video'] == "simpan" ) {
		if( $_POST ) {
			$valid    = true;
			$id_admin = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id_admin']));

			// CEK APAKAH VIDEO TELAH DI UPLOAD
			if( $_FILES['media']['error'] !== 4 ) {
				$judul = mysqli_real_escape_string($conn, htmlspecialchars($_POST['judul']));
				// PROSES CEK EXTENSI VIDEO
				if( cek_files_type_video($_FILES['media']['name']) == true ) {
					// PROSES CEK UKURAN FILE VIDEO
					if( cek_files_size_video($_FILES['media']['size']) != true ) {
						$valid = false;
						$hasil['hasil'] = "video size";
						$hasil['pesan']['notsize'] = "Ukuran file video terlalu besar.";
					}
				} else {
					$valid = false;
					$hasil['hasil'] = "video not match";
					$hasil['pesan']['notmatch'] = "Format video harus .mp4.";
				}
			} else {
				$valid = false;
				$hasil['hasil'] = "video nothing";
				$hasil['pesan']['nothing'] = "Video belum di upload.";
			}

			if( $valid === true ) {
				// PROSES SIMPAN DATA MEDIA GALLERY VIDEO
				if( simpan_media_video($id_admin, $judul, $_FILES) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Video berhasil di-Upload.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal'] = "Video gagal di-Upload.";
				}
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal'] = "Video gagal di-Upload.";
			echo json_encode($hasil);
		}
	} else if( @$_GET['video'] == "ubah" ) {
		if( $_POST ) {
			$valid    = true;
			$id_medgall = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id_medgall']));
			$id_admin   = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id_admin']));
			$judul = mysqli_real_escape_string($conn, htmlspecialchars($_POST['judul']));

			// CEK APAKAH VIDEO TELAH DI UPLOAD
			if( $_FILES['media']['error'] !== 4 ) {
				// PROSES CEK EXTENSI VIDEO
				if( cek_files_type_video($_FILES['media']['name']) == true ) {
					// PROSES CEK UKURAN FILE VIDEO
					if( cek_files_size_video($_FILES['media']['size']) != true ) {
						$valid = false;
						$hasil['hasil'] = "video size";
						$hasil['pesan']['notsize'] = "Ukuran file video terlalu besar.";
					}
				} else {
					$valid = false;
					$hasil['hasil'] = "video not match";
					$hasil['pesan']['notmatch'] = "Format video harus .mp4.";
				}
			}

			if( $valid === true ) {
				// PROSES UBAH DATA MEDIA GALLERY VIDEO
				if( ubah_media_video($id_medgall, $id_admin, $judul, $_FILES) > 0 ) {
					$hasil['hasil'] = "sukses";
					$hasil['pesan']['sukses'] = "Video berhasil di-Ubah.";
				} else {
					$hasil['hasil'] = "gagal";
					$hasil['pesan']['gagal'] = "Video gagal di-Ubah.";
				}
			}

			echo json_encode($hasil);
		} else {
			$hasil['hasil'] = "gagal";
			$hasil['pesan']['gagal'] = "Video gagal di-Ubah.";
			echo json_encode($hasil);
		}
	} else {
		$hasil['hasil'] = "gagal";
		$hasil['pesan']['gagal'] = "Video gagal di-Upload.";
		echo json_encode($hasil);
	}

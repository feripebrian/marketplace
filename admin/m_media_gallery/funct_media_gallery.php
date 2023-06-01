<?php
	
	define("UPLOAD_DIR_FOTO", "../../media_gallery/foto/");
	define("DELETE_DIR_FOTO", "../media_gallery/foto/");

	define("UPLOAD_DIR_VIDEO", "../../media_gallery/video/");
	define("DELETE_DIR_VIDEO", "../media_gallery/video/");

	function cek_files_type_video($file_name) {
		$extensi = pathinfo($file_name, PATHINFO_EXTENSION);
		$match   = ["mp4"];

		// CEK APAKAH FORMAT FILE TELAH MATCH
		if( !in_array($extensi, $match) ) {
			return false;
		} else {
			return true;
		}
	}

	function cek_files_size_video($file_size) {
		// CEK APAKAH FILE VIDEO MELEBIHI 200mb
		if( $file_size > 200000000 ) {
			return false;
		} else {
			return true;
		}
	}

	function cek_posting_media_video() {
		global $conn;

		$query = mysqli_query($conn, "SELECT COUNT(*) AS jml_posting FROM tb_media_gallery WHERE kategori_medgall='VIDEO' AND show_item='Y'");
		$hasil = mysqli_fetch_assoc($query);

		return $hasil['jml_posting'];
	}

	function buat_id_medgall() {
		global $conn;

		$cek_id    = mysqli_query($conn, "SELECT MAX(id_medgall) AS id FROM tb_media_gallery");
		$data      = mysqli_fetch_assoc($cek_id);
		$id_medgall = $data['id'];
		$no_urut    = (int) $id_medgall+1;

		// BUAT ID MEDIA GALLERY
		$id_medgall = $no_urut;

		return $id_medgall;
	}

	function upload_foto($name, $size, $error, $tmp) {
		$extensi = pathinfo($name, PATHINFO_EXTENSION);
		$match   = ["jpeg", "jpg", "png"];

		// CEK APAKAH GAMBAR DI UPLOAD
		if( $error !== UPLOAD_ERR_OK) { return false; }
		// CEK EXTENSI GAMBAR
		if( !in_array($extensi, $match) ) { return false; }
		// CEK SIZE GAMBAR
		if( $size > 5000000) { return false; }

		// Filename yang aman
		$file_name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
		// Mencegah overwrite filename
		$i = 0;
		$parts = pathinfo($file_name);
		while ( file_exists(UPLOAD_DIR_FOTO . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_FOTO . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_FOTO . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function upload_video($name, $error, $tmp) {
		// CEK APAKAH VIDEO DI UPLOAD
		if( $error === 4 ) { return false; }

		// Filename yang aman
		$file_name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
		// Mencegah overwrite filename
		$i = 0;
		$parts = pathinfo($file_name);
		while ( file_exists(UPLOAD_DIR_VIDEO . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_VIDEO . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_VIDEO . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}
	
	function simpan_media_foto($file_name, $file_size, $file_error, $file_tmp, $id_admin) {
		global $conn;

		$id_medgall   = buat_id_medgall();
		$id_adminok   = mysqli_real_escape_string($conn, htmlspecialchars($id_admin));
		$created_date = tanggal_sekarang();
		$created_time = waktu_sekarang();
		$show_item    = "Y";

		$media = upload_foto($file_name, $file_size, $file_error, $file_tmp);
		if( !$media ) {
			return false;
		} else {
			// SIMPAN DATA MEDIA GALLERY JIKA FOTO DI UPLOAD
			$query = mysqli_query($conn, "INSERT INTO tb_media_gallery(id_medgall, judul, nama_file_medgall, kategori_medgall, created_date, created_time, id_admin, show_item) VALUES($id_medgall, '', '$media', 'FOTO', '$created_date', '$created_time', $id_admin, '$show_item')");
		}

		return mysqli_affected_rows($conn);
	}

	function ubah_media_foto($file_name, $file_size, $file_error, $file_tmp, $id_medgall, $id_admin, $judul) {
		global $conn;

		$id_medgallok = mysqli_real_escape_string($conn, htmlspecialchars($id_medgall));
		$id_adminok   = mysqli_real_escape_string($conn, htmlspecialchars($id_admin));
		$judulok      = mysqli_real_escape_string($conn, htmlspecialchars($judul));
	 
		$media = upload_foto($file_name, $file_size, $file_error, $file_tmp);
		if( !$media ) {
			$media = "";
			// UPDATE DATA MEDIA GALLERY JIKA FOTO TIDAK DI UPLOAD
			$query = mysqli_query($conn, "UPDATE tb_media_gallery SET 
											judul='$judulok', id_admin=$id_adminok 
										WHERE id_medgall=$id_medgallok AND kategori_medgall='FOTO'
			");
		} else {
			// HAPUS FOTO LAMA
			$cek_medgall_foto   = mysqli_query($conn, "SELECT id_medgall, nama_file_medgall ,kategori_medgall FROM tb_media_gallery WHERE id_medgall=$id_medgallok AND kategori_medgall='FOTO'");
			$hasil_medgall_foto = mysqli_fetch_assoc($cek_medgall_foto);

			if( $hasil_medgall_foto['nama_file_medgall'] != "" ) {
				$delete_file = "../../media_gallery/foto/" . $hasil_medgall_foto['nama_file_medgall'];
				unlink($delete_file);
			}

			// UPDATE DATA MEDIA GALLERY JIKA FOTO TIDAK DI UPLOAD
			$query = mysqli_query($conn, "UPDATE tb_media_gallery SET 
											judul='$judulok', nama_file_medgall='$media', id_admin=$id_adminok 
										WHERE id_medgall=$id_medgallok AND kategori_medgall='FOTO'
			");
		}

		return mysqli_affected_rows($conn);
	}

	function update_posting_media_foto($id, $posting) {
		global $conn;

		$id_medgall = mysqli_real_escape_string($conn, htmlspecialchars($id));

		if( $posting == "Y" ) {
			$created_date = tanggal_sekarang();
			$created_time = waktu_sekarang();

			// UPDATE show_item FOTO
			$query = mysqli_query($conn, "UPDATE tb_media_gallery SET 
					created_date='$created_date', created_time='$created_time', show_item='$posting' 
				WHERE id_medgall=$id_medgall AND kategori_medgall='FOTO'");
		} else {
			$created_date = "0000-00-00";
			$created_time = "00:00";

			// UPDATE show_item FOTO
			$query = mysqli_query($conn, "UPDATE tb_media_gallery SET 
					created_date='$created_date', created_time='$created_time', show_item='$posting' 
				WHERE id_medgall=$id_medgall AND kategori_medgall='FOTO'");
		}

		return mysqli_affected_rows($conn);
	}

	function hapus_media_foto($id) {
		global $conn;

		$id_medgall = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS FOTO LAMA
		$cek_medgall_foto   = mysqli_query($conn, "SELECT id_medgall, nama_file_medgall ,kategori_medgall FROM tb_media_gallery WHERE id_medgall=$id_medgall AND kategori_medgall='FOTO'");
		$hasil_medgall_foto = mysqli_fetch_assoc($cek_medgall_foto);

		if( $hasil_medgall_foto['nama_file_medgall'] != "" ) {
			$delete_file = DELETE_DIR_FOTO . $hasil_medgall_foto['nama_file_medgall'];
			unlink($delete_file);
		}

		// HAPUS DATA MEDIA GALLERY FOTO
		$query = mysqli_query($conn, "DELETE FROM tb_media_gallery WHERE id_medgall=$id_medgall AND kategori_medgall='FOTO'");

		return mysqli_affected_rows($conn);
	}

	function simpan_media_video($id_admin, $judul, $files) {
		global $conn;

		$id_medgall   = buat_id_medgall();
		$id_adminok   = mysqli_real_escape_string($conn, htmlspecialchars($id_admin));
		$judulok      = mysqli_real_escape_string($conn, htmlspecialchars($judul));
		$created_date = tanggal_sekarang();
		$created_time = waktu_sekarang();
		$show_item    = "N";

		// DEKLARASI ATRIBUT $files
		$file_name  = $files['media']['name'];
		$file_error = $files['media']['error'];
		$file_tmp   = $files['media']['tmp_name'];

		$media = upload_video($file_name, $file_error, $file_tmp);
		if( !$media ) {
			$media = "";
		}

		// SIMPAN DATA MEDIA GALLERY VIDEO
		$query = "INSERT INTO tb_media_gallery VALUES($id_medgall, '$judulok', '$media', 'VIDEO', '$created_date', '$created_time', $id_adminok, '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_media_video($id_medgall, $id_admin, $judul, $files) {
		global $conn;

		$id_medgallok = mysqli_real_escape_string($conn, htmlspecialchars($id_medgall));
		$id_adminok   = mysqli_real_escape_string($conn, htmlspecialchars($id_admin));
		$judulok      = mysqli_real_escape_string($conn, htmlspecialchars($judul));

		// DEKLARASI ATRIBUT $files
		$file_name  = $files['media']['name'];
		$file_error = $files['media']['error'];
		$file_tmp   = $files['media']['tmp_name'];

		$media = upload_video($file_name, $file_error, $file_tmp);
		if( !$media ) {
			// UPDATE DATA MEDIA GALLERY JIKA VIDEO TIDAK DI UPLOAD
			$query = "UPDATE tb_media_gallery SET judul='$judulok', id_admin=$id_adminok WHERE id_medgall=$id_medgallok AND kategori_medgall='VIDEO'";
			mysqli_query($conn, $query);
		} else {
			// HAPUS VIDEO LAMA
			$cek_medgall_video   = mysqli_query($conn, "SELECT id_medgall, nama_file_medgall, kategori_medgall FROM tb_media_gallery WHERE id_medgall=$id_medgallok AND kategori_medgall='VIDEO'");
			$hasil_medgall_video = mysqli_fetch_assoc($cek_medgall_video);

			if( $hasil_medgall_video['nama_file_medgall'] != "" ) {
				$delete_file = UPLOAD_DIR_VIDEO . $hasil_medgall_video['nama_file_medgall'];
				unlink($delete_file);
			}

			// UPDATE DATA MEDIA GALLERY JIKA VIDEO DI UPLOAD
			$query = "UPDATE tb_media_gallery SET judul='$judulok', nama_file_medgall='$media', id_admin=$id_adminok WHERE id_medgall=$id_medgallok AND kategori_medgall='VIDEO'";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);
	}

	function update_posting_media_video($id, $posting) {
		global $conn;

		$id_medgall = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item VIDEO
		$query = "UPDATE tb_media_gallery SET show_item='$posting' WHERE id_medgall=$id_medgall AND kategori_medgall='VIDEO'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_media_video($id) {
		global $conn;

		$id_medgall = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS VIDEO LAMA
		$cek_medgall_video   = mysqli_query($conn, "SELECT id_medgall, nama_file_medgall, kategori_medgall FROM tb_media_gallery WHERE id_medgall=$id_medgall AND kategori_medgall='VIDEO'");
		$hasil_medgall_video = mysqli_fetch_assoc($cek_medgall_video);

		if( $hasil_medgall_video['nama_file_medgall'] != "" ) {
			$delete_file = DELETE_DIR_VIDEO . $hasil_medgall_video['nama_file_medgall'];
			unlink($delete_file);
		}

		// HAPUS DATA MEDIA GALLERY VIDEO
		$query = "DELETE FROM tb_media_gallery WHERE id_medgall=$id_medgall AND kategori_medgall='VIDEO'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
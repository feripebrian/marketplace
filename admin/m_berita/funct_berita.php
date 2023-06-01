<?php
	
	define("UPLOAD_DIR_BERITA", "../../image/berita/");
	define("DELETE_DIR_BERITA", "../image/berita/");

	function cek_files_type($file_name) {
		$extensi = pathinfo($file_name, PATHINFO_EXTENSION);
		$match   = ["jpeg", "jpg", "JPG", "png"];

		// CEK APAKAH FORMAT FILE TELAH MATCH
		if( !in_array($extensi, $match) ) {
			return false;
		} else {
			return true;
		}
	}

	function cek_files_size($file_size) {
		// CEK APAKAH FILE MELEBIHI 5mb
		if( $file_size > 5000000 ) {
			return false;
		} else {
			return true;
		}
	}

	function upload($name, $error, $tmp) {
		// CEK APAKAH FILE DI UPLOAD
		if( $error !== UPLOAD_ERR_OK ) { return false; }

		// Filename yang aman
		$file_name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
		// Mencegah overwrite filename
		$i = 0;
		$parts = pathinfo($file_name);
		while ( file_exists(UPLOAD_DIR_BERITA . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_BERITA . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_BERITA . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function buat_id_berita() {
		global $conn;

		$cek_id    = mysqli_query($conn, "SELECT MAX(id_berita) AS id FROM tb_berita");
		$data      = mysqli_fetch_assoc($cek_id);
		$id_berita = $data['id'];
		$no_urut   = (int) $id_berita+1;

		// BUAT ID BERITA
		$id_berita = $no_urut;

		return $id_berita;
	}

	function simpan_berita($data_input, $data_file) {
		global $conn;

		$id_berita    = buat_id_berita();
		$judul_berita = mysqli_real_escape_string($conn, htmlspecialchars($data_input['judul_berita']));
		$isi_berita   = mysqli_real_escape_string($conn, htmlspecialchars($data_input['isi_berita']));
		$created_date = tanggal_sekarang();
		$created_time = waktu_sekarang();
		$views        = 0;
		$id_admin     = mysqli_real_escape_string($conn, htmlspecialchars($data_input['id_admin']));
		$show_item    = "Y";

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			$gambar = "";
		}

		// SIMPAN DATA BERITA
		$query = "INSERT INTO tb_berita VALUES($id_berita, '$judul_berita', '$isi_berita', '$gambar', '$created_date', '$created_time', $views, $id_admin, '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_berita($data_input, $data_file) {
		global $conn;

		$id_berita    = mysqli_real_escape_string($conn, htmlspecialchars($data_input['id_berita']));
		$judul_berita = mysqli_real_escape_string($conn, htmlspecialchars($data_input['judul_berita']));
		$isi_berita   = mysqli_real_escape_string($conn, htmlspecialchars($data_input['isi_berita']));
		$id_admin     = mysqli_real_escape_string($conn, htmlspecialchars($data_input['id_admin']));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			// UPDATE DATA BERITA JIKA GAMBAR TIDAK DI UPLOAD
			$query = "UPDATE tb_berita SET judul_berita='$judul_berita', isi_berita='$isi_berita', id_admin=$id_admin WHERE id_berita=$id_berita";
			mysqli_query($conn, $query);
		} else {
			// HAPUS GAMBAR LAMA
			$cek_berita   = mysqli_query($conn, "SELECT id_berita, gambar FROM tb_berita WHERE id_berita=$id_berita");
			$hasil_berita = mysqli_fetch_assoc($cek_berita);

			if( $hasil_berita['gambar'] != "" ) {
				$delete_file = "../../image/berita/" . $hasil_berita['gambar'];
				unlink($delete_file);
			}

			// UPDATE DATA BERITA JIKA GAMBAR DI UPLOAD
			$query = "UPDATE tb_berita SET judul_berita='$judul_berita', isi_berita='$isi_berita', gambar='$gambar', id_admin=$id_admin WHERE id_berita=$id_berita";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);
	}

	function update_posting_berita($id, $posting) {
		global $conn;

		$id_berita = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item BERITA
		$query = mysqli_query($conn, "UPDATE tb_berita SET show_item='$posting' WHERE id_berita=$id_berita");

		return mysqli_affected_rows($conn);
	}

	function hapus_berita($id) {
		global $conn;

		$id_berita = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS GAMBAR LAMA
		$cek_berita   = mysqli_query($conn, "SELECT id_berita, gambar FROM tb_berita WHERE id_berita=$id_berita");
		$hasil_berita = mysqli_fetch_assoc($cek_berita);

		if( $hasil_berita['gambar'] != "" ) {
			$delete_file = DELETE_DIR_BERITA . $hasil_berita['gambar'];
			unlink($delete_file);
		}

		// HAPUS DATA BERITA
		$query = mysqli_query($conn, "DELETE FROM tb_berita WHERE id_berita=$id_berita");

		return mysqli_affected_rows($conn);
	}
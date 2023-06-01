<?php
	
	define("UPLOAD_DIR_CAROUSEL", "../../image/carousel/");
	define("DELETE_DIR_CAROUSEL", "../image/carousel/");

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

	function cek_posting_carousel() {
		global $conn;

		$query = mysqli_query($conn, "SELECT COUNT(*) AS jml_posting FROM tb_carousel WHERE show_item='Y'");
		$hasil = mysqli_fetch_assoc($query);

		return $hasil['jml_posting'];
	}
	
	function upload($name, $error, $tmp) {
		// CEK APAKAH FILE DI UPLOAD
		if( $error !== UPLOAD_ERR_OK ) { return false; }

		// Filename yang aman
		$file_name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
		// Mencegah overwrite filename
		$i = 0;
		$parts = pathinfo($file_name);
		while ( file_exists(UPLOAD_DIR_CAROUSEL . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_CAROUSEL . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_CAROUSEL . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function buat_id_carousel() {
		global $conn;

		// MENCARI NILAI MAX PADA id_carousel
		$cek_ID      = "SELECT MAX(SUBSTRING(id_carousel, 4, 2)) AS id FROM tb_carousel";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_carousel = $data['id'];
		$no_urut     = (int) substr($id_carousel, 0, 2);

		$no_urut++;

		$char = "CRL";
		if( $no_urut > 99 ) {
			return false;
		}

		// BUAT ID CAROUSEL
		$id_carousel = $char . sprintf("%02s", $no_urut);

		return $id_carousel;
	}

	function simpan_carousel($data_input, $data_file) {
		global $conn;

		$id_carousel  = buat_id_carousel();
		$ket_carousel = mysqli_real_escape_string($conn, htmlspecialchars($data_input['ket_carousel']));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			$gambar = "";
		}

		// SIMPAN DATA CAROUSEL JIKA GAMBAR DI UPLOAD
		$query = "INSERT INTO tb_carousel VALUES('$id_carousel', '$gambar', '$ket_carousel', 'N')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_carousel($data_input, $data_file) {
		global $conn;

		$id_carousel  = mysqli_real_escape_string($conn, htmlspecialchars($data_input['id_carousel']));
		$ket_carousel = mysqli_real_escape_string($conn, htmlspecialchars($data_input['ket_carousel']));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			// UPDATE DATA CAROUSEL JIKA GAMBAR TIDAK DI PERBARUI
			$query = "UPDATE tb_carousel SET ket_carousel='$ket_carousel' WHERE id_carousel='$id_carousel'";
			mysqli_query($conn, $query);
		} else {
			// HAPUS GAMBAR LAMA
			$cek_carousel   = mysqli_query($conn, "SELECT id_carousel, gambar FROM tb_carousel WHERE id_carousel='$id_carousel'");
			$hasil_carousel = mysqli_fetch_assoc($cek_carousel);

			if( $hasil_carousel['gambar'] != "" ) {
				$delete_file = "../../image/carousel/".$hasil_carousel['gambar'];
				unlink($delete_file);
			}

			// UPDATE DATA CAROUSEL JIKA GAMBAR DI PERBARUI
			$query = "UPDATE tb_carousel SET gambar='$gambar', ket_carousel='$ket_carousel' WHERE id_carousel='$id_carousel'";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);
	}

	function update_posting_carousel($id, $posting) {
		global $conn;

		$id_carousel = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_carousel
		$query = mysqli_query($conn, "UPDATE tb_carousel SET 
				show_item='$posting' 
			WHERE id_carousel='$id_carousel'");

		return mysqli_affected_rows($conn);
	}

	function hapus_carousel($id) {
		global $conn;

		$id_carousel = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS GAMBAR LAMA
		$cek_carousel   = mysqli_query($conn, "SELECT id_carousel, gambar FROM tb_carousel WHERE id_carousel='$id_carousel'");
		$hasil_carousel = mysqli_fetch_assoc($cek_carousel);

		if( $hasil_carousel['gambar'] != "" ) {
			$delete_file = DELETE_DIR_CAROUSEL . $hasil_carousel['gambar'];
			unlink($delete_file);
		}

		// HAPUS DATA CAROUSEL
		$query = mysqli_query($conn, "DELETE FROM tb_carousel WHERE id_carousel='$id_carousel'");

		return mysqli_affected_rows($conn);
	}
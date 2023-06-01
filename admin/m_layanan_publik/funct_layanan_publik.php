<?php
	
	define("UPLOAD_DIR_LAYANAN", "../../image/layanan_publik/");
	define("DELETE_DIR_LAYANAN", "../image/layanan_publik/");

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
		while ( file_exists(UPLOAD_DIR_LAYANAN . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_LAYANAN . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_LAYANAN . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function buat_id_layanan_pblk() {
		global $conn;

		$cek_id    = mysqli_query($conn, "SELECT MAX(id_layanan_pblk) AS id FROM tb_layanan_publik");
		$data      = mysqli_fetch_assoc($cek_id);
		$id_layanan_pblk = $data['id'];
		$no_urut         = (int) $id_layanan_pblk+1;

		// BUAT ID LAYANAN PUBLIK
		$id_layanan_pblk = $no_urut;

		return $id_layanan_pblk;
	}

	function simpan_layanan_publik($data_input, $data_file) {
		global $conn;

		$id_layanan_pblk  = buat_id_layanan_pblk();
		$url_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($data_input['url_layanan_pblk']));
		$ket_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($data_input['ket_layanan_pblk']));
		$show_item        = "Y";

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			$gambar = "";
		}

		// SIMPAN DATA LAYANAN PUBLIK JIKA GAMBAR DI UPLOAD
		$query = "INSERT INTO tb_layanan_publik VALUES($id_layanan_pblk, '$url_layanan_pblk', '$ket_layanan_pblk', '$gambar', '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_layanan_publik($data_input, $data_file) {
		global $conn;

		$id_layanan_pblk  = mysqli_real_escape_string($conn, htmlspecialchars($data_input['id_layanan_pblk']));
		$url_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($data_input['url_layanan_pblk']));
		$ket_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($data_input['ket_layanan_pblk']));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_error, $file_tmp);
		if( !$gambar ) {
			// UPDATE DATA LAYANAN PUBLIK JIKA GAMBAR TIDAK DI PERBARUI
			$query = "UPDATE tb_layanan_publik SET url_layanan_pblk='$url_layanan_pblk', ket_layanan_pblk='$ket_layanan_pblk' WHERE id_layanan_pblk=$id_layanan_pblk";
			mysqli_query($conn, $query);
		} else {
			// HAPUS GAMBAR LAMA
			$cek_layanan_publik   = mysqli_query($conn, "SELECT id_layanan_pblk, gambar FROM tb_layanan_publik WHERE id_layanan_pblk=$id_layanan_pblk");
			$hasil_layanan_publik = mysqli_fetch_assoc($cek_layanan_publik);

			if( $hasil_layanan_publik['gambar'] != "" ) {
				$delete_file = "../../image/layanan_publik/" . $hasil_layanan_publik['gambar'];
				unlink($delete_file);
			}

			// UPDATE DATA LAYANAN PUBLIK JIKA GAMBAR DI PERBARUI
			$query = "UPDATE tb_layanan_publik SET url_layanan_pblk='$url_layanan_pblk', ket_layanan_pblk='$ket_layanan_pblk', gambar='$gambar' WHERE id_layanan_pblk=$id_layanan_pblk";
			 mysqli_query($conn, $query);
		}
		
		return mysqli_affected_rows($conn);
	}

	function update_posting_layanan_publik($id, $posting) {
		global $conn;

		$id_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item LAYANAN PUBLIK
		$query = "UPDATE tb_layanan_publik SET show_item='$posting' WHERE id_layanan_pblk=$id_layanan_pblk";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_layanan_publik($id) {
		global $conn;

		$id_layanan_pblk = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS GAMBAR LAMA
		$cek_layanan_publik   = mysqli_query($conn, "SELECT id_layanan_pblk, gambar FROM tb_layanan_publik WHERE id_layanan_pblk=$id_layanan_pblk");
		$hasil_layanan_publik = mysqli_fetch_assoc($cek_layanan_publik);

		if( $hasil_layanan_publik['gambar'] != "" ) {
			$delete_file = DELETE_DIR_LAYANAN . $hasil_layanan_publik['gambar'];
			unlink($delete_file);
		}

		// HAPUS DATA LAYANAN PUBLIK
		$query = mysqli_query($conn, "DELETE FROM tb_layanan_publik WHERE id_layanan_pblk=$id_layanan_pblk");

		return mysqli_affected_rows($conn);
	}
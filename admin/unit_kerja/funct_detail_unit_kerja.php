<?php
	
	define("UPLOAD_DIR_FILE", "../../files/unit_kerja/");
	define("DELETE_DIR_FILE", "../files/unit_kerja/");

	// CEK FILE APAKAH MATCH DENGAN .pdf
	function cek_files($file) {
		$extensi = pathinfo($file['file']['name'], PATHINFO_EXTENSION);
		$match   = ["pdf"];

		// CEK APAKAH FORMAT FILE TELAH SESUAI
		if( !in_array($extensi, $match) ) { return false; } else { return true; }
	}

	function upload($name, $error, $tmp) {
		// CEK APAKAH FILE DI UPLOAD
		if( $error !== UPLOAD_ERR_OK ) { return false; }

		// Filename yang aman
		$file_name = preg_replace("/[^A-Z0-9._-]/i", "_", $name);
		// Mencegah overwrite filename
		$i = 0;
		$parts = pathinfo($file_name);
		while ( file_exists(UPLOAD_DIR_FILE . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_FILE . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_FILE . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function buat_no_detail_uk() {
		global $conn;

		$cek_no = mysqli_query($conn, "SELECT MAX(no_detail_uk) AS no FROM tb_detail_unit_kerja");
		$data   = mysqli_fetch_assoc($cek_no);
		$no_detail_uk = $data['no'];
		$no_urut      = (int) $no_detail_uk;

		// BUAT NOMOR DETAIL
		$no_detail_uk = $no_urut+1;

		return $no_detail_uk;
	}

	function simpan_detail_unit_kerja($data_input, $data_file) {
		global $conn;

		$no_detail_uk   = buat_no_detail_uk();
		$kode           = mysqli_real_escape_string($conn, htmlspecialchars($data_input['kd_unit_kerja']));
		$nama_detail_uk = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data_input['nama_detail'])));
		$link_detail_uk = "detailuk&no=" . $no_detail_uk;

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['file']['name'];
		$file_error = $data_file['file']['error'];
		$file_tmp   = $data_file['file']['tmp_name'];

		$file_document = upload($file_name, $file_error, $file_tmp);
		if( !$file_document ) {
			// SIMPAN DATA DETAIL UNIT KERJA JIKA FILE TIDAK DI UPLOAD
			$file_document = "";
			$query = "INSERT INTO tb_detail_unit_kerja VALUES($no_detail_uk, '$kode', '$nama_detail_uk', '$link_detail_uk', '$file_document')";
			mysqli_query($conn, $query);
		} else {
			// SIMPAN DATA DETAIL UNIT KERJA JIKA FILE DI UPLOAD
			$query = "INSERT INTO tb_detail_unit_kerja VALUES($no_detail_uk, '$kode', '$nama_detail_uk', '$link_detail_uk', '$file_document')";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);
	}

	function ubah_detail_unit_kerja($data_input, $data_file) {
		global $conn;

		$no_detail_uk   = mysqli_real_escape_string($conn, htmlspecialchars($data_input['no_detail_uk']));
		$nama_detail_uk = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data_input['nama_detail'])));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['file']['name'];
		$file_error = $data_file['file']['error'];
		$file_tmp   = $data_file['file']['tmp_name'];

		$file_document = upload($file_name, $file_error, $file_tmp);
		if( !$file_document ) {
			// UPDATE DATA DETAIL UNIT KERJA JIKA FILE TIDAK DI PERBARUI
			$query = "UPDATE tb_detail_unit_kerja SET nama_detail_uk='$nama_detail_uk' WHERE no_detail_uk=$no_detail_uk";
			mysqli_query($conn, $query);
		} else {
			// HAPUS FILE LAMA
			$cek_detail_unit_kerja   = mysqli_query($conn, "SELECT no_detail_uk, file FROM tb_detail_unit_kerja WHERE no_detail_uk=$no_detail_uk");
			$hasil_detail_unit_kerja = mysqli_fetch_assoc($cek_detail_unit_kerja);

			if( $hasil_detail_unit_kerja['file'] != "" ) {
				$delete_file = "../../files/unit_kerja/" . $hasil_detail_unit_kerja['file'];
				unlink($delete_file);
			}

			// UPDATE DATA DETAIL UNIT KERJA JIKA GAMBAR TIDAK DI PERBARUI
			$query = "UPDATE tb_detail_unit_kerja SET nama_detail_uk='$nama_detail_uk', file='$file_document' WHERE no_detail_uk=$no_detail_uk";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);
	}

	function hapus_detail_unit_kerja($no) {
		global $conn;

		$no_detail_uk = mysqli_real_escape_string($conn, htmlspecialchars($no));

		// HAPUS FILE JIKA ADA
		$cek_detail_unit_kerja   = mysqli_query($conn, "SELECT no_detail_uk, file FROM tb_detail_unit_kerja WHERE no_detail_uk=$no_detail_uk");
		$hasil_detail_unit_kerja = mysqli_fetch_assoc($cek_detail_unit_kerja);

		if( $hasil_detail_unit_kerja['file'] != "" ) {
			$delete_file = DELETE_DIR_FILE . $hasil_detail_unit_kerja['file'];
			unlink($delete_file);
		}

		// HAPUS DATA DETAIL UNIT KERJA
		$query = "DELETE FROM tb_detail_unit_kerja WHERE no_detail_uk=$no_detail_uk";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
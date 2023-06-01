<?php

	define("DIR_STRUKTUR_ORGANISASI", "../../image/struktur_organisasi/");

	function upload($name, $size, $error, $tmp) {
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
		while ( file_exists(DIR_STRUKTUR_ORGANISASI . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, DIR_STRUKTUR_ORGANISASI . $file_name);
		if( $upload ) {
			chmod(DIR_STRUKTUR_ORGANISASI . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}
	
	function ubah_struktur_organisasi($id, $data_file) {
		global $conn;

		$idok = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['gambar']['name'];
		$file_size  = $data_file['gambar']['size'];
		$file_error = $data_file['gambar']['error'];
		$file_tmp   = $data_file['gambar']['tmp_name'];

		$gambar = upload($file_name, $file_size, $file_error, $file_tmp);
		if( !$gambar ) {
			return false;
		} else {
			// HAPUS GAMBAR LAMA
			$cek_struktur_org = mysqli_query($conn, "SELECT id_struktur_org, gambar FROM tb_struktur_organisasi WHERE id_struktur_org='$idok'");
			$hasil_struktur_org = mysqli_fetch_assoc($cek_struktur_org);

			if( $hasil_struktur_org['gambar'] != "" ) {
				$delete_file = DIR_STRUKTUR_ORGANISASI . $hasil_struktur_org['gambar'];
				unlink($delete_file);
			}

			// UPDATE DATA STRUKTUR ORGANISASI JIKA GAMBAR DI PERBARUI
			$query = mysqli_query($conn, "UPDATE tb_struktur_organisasi SET 
											gambar='$gambar' 
										WHERE id_struktur_org='$idok'
				");

			return mysqli_affected_rows($conn);
		}
	}

	function ubah_detail_struktur_organisasi($id_struktur_org, $no_detail_org, $nip) {
		global $conn;

		$nook  = mysqli_real_escape_string($conn, htmlspecialchars($no_detail_org));
		$idok  = mysqli_real_escape_string($conn, htmlspecialchars($id_struktur_org));
		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		// UPDATE DATA DETAIL STRUKTUR ORGANISASI
		$query = mysqli_query($conn, "UPDATE tb_detail_struktur_organisasi SET nip='$nipok' WHERE no_detail_org=$nook AND id_struktur_org='$idok'");

		return mysqli_affected_rows($conn);
	}
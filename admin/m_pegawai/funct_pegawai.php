<?php
	
	define("UPLOAD_DIR_PEGAWAI", "../../image/pegawai/");
	define("DELETE_DIR_PEGAWAI", "../image/pegawai/");

	function cek_nip($nip) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		$cek_nip   = mysqli_query($conn, "SELECT nip FROM tb_pegawai WHERE nip='$nipok'");
		$hasil_cek = mysqli_num_rows($cek_nip);

		if( $hasil_cek > 0 ) {
			return false;
		} else {
			return true;
		}
	}

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
		while ( file_exists(UPLOAD_DIR_PEGAWAI . $file_name) ) {
			$i++;
			$file_name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		}
		
		// COPY DAN PINDAHKAN FILE
		$upload = move_uploaded_file($tmp, UPLOAD_DIR_PEGAWAI . $file_name);
		if( $upload ) {
			chmod(UPLOAD_DIR_PEGAWAI . $file_name, 0644);

			return $file_name;
		} else {
			return false;
		}
	}

	function simpan_pegawai($data_input, $data_file) {
		global $conn;

		$nip          = mysqli_real_escape_string($conn, htmlspecialchars($data_input['nip']));
		$nama_pegawai = mysqli_real_escape_string($conn, htmlspecialchars($data_input['nama_pegawai']));
		$jk           = mysqli_real_escape_string($conn, htmlspecialchars($data_input['jk']));
		$jabatan      = mysqli_real_escape_string($conn, htmlspecialchars($data_input['jabatan']));
		$status       = 0;

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['foto']['name'];
		$file_error = $data_file['foto']['error'];
		$file_tmp   = $data_file['foto']['tmp_name'];

		$foto = upload($file_name, $file_error, $file_tmp);
		if( !$foto ) {
			$foto = "";
		}

		// SIMPAN DATA PEGAWAI
		$query = "INSERT INTO tb_pegawai VALUES('$nip', '$nama_pegawai', '$jk', '$jabatan', '$foto', $status)";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_pegawai($data_input, $data_file, $cek) {
		global $conn;

		$nip_lama     = mysqli_real_escape_string($conn, htmlspecialchars($data_input['nip_lama']));
		$nip_baru     = mysqli_real_escape_string($conn, htmlspecialchars($data_input['nip_baru']));
		$nama_pegawai = mysqli_real_escape_string($conn, htmlspecialchars($data_input['nama_pegawai']));
		$jk           = mysqli_real_escape_string($conn, htmlspecialchars($data_input['jk']));
		$jabatan      = mysqli_real_escape_string($conn, htmlspecialchars($data_input['jabatan']));

		// DEKLARASI ATRIBUT $data_file
		$file_name  = $data_file['foto']['name'];
		$file_error = $data_file['foto']['error'];
		$file_tmp   = $data_file['foto']['tmp_name'];

		$foto = upload($file_name, $file_error, $file_tmp);
		if( !$foto ) {
			if( $cek == "0" ) {
				// UPDATE DATA PEGAWAI JIKA FOTO DI PERBARUI
				$query = "UPDATE tb_pegawai SET nama_pegawai='$nama_pegawai', jk='$jk', kd_jabatan='$jabatan' WHERE nip='$nip_lama'";
				mysqli_query($conn, $query);
			} else {
				$query = "UPDATE tb_pegawai SET nip='$nip_baru', nama_pegawai='$nama_pegawai', jk='$jk', kd_jabatan='$jabatan' WHERE nip='$nip_lama'";
				mysqli_query($conn, $query);
			}
		} else {
			// HAPUS FOTO LAMA
			$cek_pegawai   = mysqli_query($conn, "SELECT nip, foto FROM tb_pegawai WHERE nip='$nip_lama'");
			$hasil_pegawai = mysqli_fetch_assoc($cek_pegawai);

			if( $hasil_pegawai['foto'] != "" ) {
				$delete_file = "../../image/pegawai/" . $hasil_pegawai['foto'];
				unlink($delete_file);
			}

			if( $cek == "0" ) {
				// UPDATE DATA PEGAWAI JIKA FOTO DI PERBARUI
				$query = "UPDATE tb_pegawai SET nama_pegawai='$nama_pegawai', jk='$jk', kd_jabatan='$jabatan', foto='$foto' WHERE nip='$nip_lama'
				";
				mysqli_query($conn, $query);
			} else {
				$query = "UPDATE tb_pegawai SET nip='$nip_baru', nama_pegawai='$nama_pegawai', jk='$jk', kd_jabatan='$jabatan', foto='$foto' WHERE nip='$nip_lama'
				";
				mysqli_query($conn, $query);
			}
		}

		return mysqli_affected_rows($conn);
	}

	function update_status_pegawai($nip, $status) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));
		
		// UPDATE STATUS PEGAWAI
		$query = "UPDATE tb_pegawai SET status=$status WHERE nip='$nipok'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_pegawai($nip) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		// HAPUS FOTO LAMA
		$cek_pegawai   = mysqli_query($conn, "SELECT nip, nama_pegawai, foto FROM tb_pegawai WHERE nip='$nipok'");
		$hasil_pegawai = mysqli_fetch_assoc($cek_pegawai);

		if( $hasil_pegawai['foto'] != "" ) {
			$delete_file = DELETE_DIR_PEGAWAI . $hasil_pegawai['foto'];
			unlink($delete_file);
		}

		// HAPUS DATA PEGAWAI
		$query = mysqli_query($conn, "DELETE FROM tb_pegawai WHERE nip='$nipok'");

		return mysqli_affected_rows($conn);
	}
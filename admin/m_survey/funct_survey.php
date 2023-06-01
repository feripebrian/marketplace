<?php

	function cek_id_zona($id) {
		global $conn;

		$id_zona = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

		$cek_id_zona = mysqli_query($conn, "SELECT id_zona FROM tb_zona WHERE id_zona='$id_zona'");
		$hasil_cek        = mysqli_num_rows($cek_id_zona);

		if( $hasil_cek > 0 ) {
			return 1;
		} else {
			return 0;
		}
	}

	function simpan_zona($data) {
		global $conn;

		$id_zona   = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_zona'])));
		$nama_zona = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_zona']));

		// SIMPAN DATA SURVEY
		$query = mysqli_query($conn, "INSERT INTO tb_zona VALUES(
											'$id_zona', '$nama_zona'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_zona($data) {
		global $conn;

		$id_zona_lama = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_zona_lama'])));
		$id_zona_baru = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_zona_baru'])));
		$nama_zona    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_zona']));

		// UPDATE DATA SURVEY
		$query = mysqli_query($conn, "UPDATE tb_zona SET 
											id_zona='$id_zona_baru', nama_zona='$nama_zona'
									WHERE id_zona='$id_zona_lama'
		");

		return mysqli_affected_rows($conn);
	}

	function hapus_zona($id) {
		global $conn;

		$id_zona = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

		// HAPUS DATA SURVEY
		$query = mysqli_query($conn, "DELETE FROM tb_zona WHERE id_zona='$id_zona'");

		return mysqli_affected_rows($conn);
	}
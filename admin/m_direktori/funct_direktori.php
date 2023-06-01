<?php

	function cek_id_direktori($id) {
		global $conn;

		$id_direktori = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

		$cek_id_direktori = mysqli_query($conn, "SELECT id_direktori FROM tb_direktori WHERE id_direktori='$id_direktori'");
		$hasil_cek        = mysqli_num_rows($cek_id_direktori);

		if( $hasil_cek > 0 ) {
			return 1;
		} else {
			return 0;
		}
	}

	function simpan_direktori($data) {
		global $conn;

		$id_direktori   = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_direktori'])));
		$nama_direktori = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_direktori']));

		// SIMPAN DATA DIREKTORI
		$query = mysqli_query($conn, "INSERT INTO tb_direktori VALUES(
											'$id_direktori', '$nama_direktori'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_direktori($data) {
		global $conn;

		$id_direktori_lama = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_direktori_lama'])));
		$id_direktori_baru = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['id_direktori_baru'])));
		$nama_direktori    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_direktori']));

		// UPDATE DATA DIREKTORI
		$query = mysqli_query($conn, "UPDATE tb_direktori SET 
											id_direktori='$id_direktori_baru', nama_direktori='$nama_direktori'
									WHERE id_direktori='$id_direktori_lama'
		");

		return mysqli_affected_rows($conn);
	}

	function hapus_direktori($id) {
		global $conn;

		$id_direktori = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($id)));

		// HAPUS DATA DIREKTORI
		$query = mysqli_query($conn, "DELETE FROM tb_direktori WHERE id_direktori='$id_direktori'");

		return mysqli_affected_rows($conn);
	}
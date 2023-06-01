<?php
	
	function ubah_tugas_fungsi($data) {
		global $conn;

		$kd_tugas_fungsi = mysqli_real_escape_string($conn, htmlspecialchars($data['kd_tugas_fungsi']));
		$nip             = mysqli_real_escape_string($conn, htmlspecialchars($data['nip']));
		$deskripsi       = mysqli_real_escape_string($conn, htmlspecialchars($data['deskripsi']));

		// UPDATE DATA TUGAS FUNGSI
		$query = mysqli_query($conn, "UPDATE tb_tugas_fungsi SET 
					nip='$nip', deskripsi='$deskripsi' 
				WHERE kd_tugas_fungsi='$kd_tugas_fungsi'
		");

		return mysqli_affected_rows($conn);
	}
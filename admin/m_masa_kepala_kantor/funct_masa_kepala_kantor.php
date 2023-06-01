<?php
	
	function cek_nip_kpl($nip) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		$cek_nip_kpl = mysqli_query($conn, "SELECT nip_kpl_kantor FROM tb_masa_kepala_kantor WHERE nip_kpl_kantor='$nipok'");
		$hasil_cek   = mysqli_num_rows($cek_nip_kpl);

		if( $hasil_cek > 0 ) {
			return false;
		} else {
			return true;
		}
	}
	
	function simpan_masa_kpl($data) {
		global $conn;

		$nip            = mysqli_real_escape_string($conn, htmlspecialchars($data['kepala_kantor']));
		$periode_dari   = mysqli_real_escape_string($conn, htmlspecialchars($data['periode_dari']));
		$tgl1           = tanggal_sql($periode_dari);
		$periode_sampai = mysqli_real_escape_string($conn, htmlspecialchars($data['periode_sampai']));
		$tgl2           = tanggal_sql($periode_sampai);
		$show_item      = "Y";

		// SIMPAN DATA MASA KEPALA KANTOR
		$query = "INSERT INTO tb_masa_kepala_kantor VALUES('$nip', '$tgl1', '$tgl2', '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_masa_kpl($data) {
		global $conn;

		$nip            = mysqli_real_escape_string($conn, htmlspecialchars($data['nip']));
		$periode_dari   = mysqli_real_escape_string($conn, htmlspecialchars($data['periode_dari']));
		$tgl1           = tanggal_sql($periode_dari);
		$periode_sampai = mysqli_real_escape_string($conn, htmlspecialchars($data['periode_sampai']));
		$tgl2           = tanggal_sql($periode_sampai);

		// UPDATE DATA MASA KEPALA KANTOR
		$query = "UPDATE tb_masa_kepala_kantor SET periode_dari='$tgl1', periode_sampai='$tgl2' WHERE nip_kpl_kantor='$nip'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function update_show_masa_kpl($nip, $show_item) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		// UPDATE DATA SHOW ITEM MASA KEPALA KANTOR
		$query = "UPDATE tb_masa_kepala_kantor SET show_item='$show_item' WHERE nip_kpl_kantor='$nipok'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_masa_kpl($nip) {
		global $conn;

		$nipok = mysqli_real_escape_string($conn, htmlspecialchars($nip));

		// HAPUS DATA MASA KEPALA KANTOR
		$query = mysqli_query($conn, "DELETE FROM tb_masa_kepala_kantor WHERE nip_kpl_kantor='$nipok'");

		return mysqli_affected_rows($conn);
	}
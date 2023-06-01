<?php

	function buat_kd_unit_kerja() {
		global $conn;

		// MENCARI NILAI MAX PADA kd_unit_kerja
		$cek_kode      = "SELECT MAX(SUBSTRING(kd_unit_kerja, 3, 3)) AS kode FROM tb_unit_kerja";
		$hasil         = mysqli_query($conn, $cek_kode);
		$data          = mysqli_fetch_assoc($hasil);
		$kd_unit_kerja = $data['kode'];
		$no_urut       = (int) substr($kd_unit_kerja, 0, 3);

		$no_urut++;

		$char = "UK";
		if( $no_urut > 999 ) {
			return false;
		}

		// BUAT KODE UNIT KERJA
		$kd_unit_kerja = $char . sprintf("%03s", $no_urut);

		return $kd_unit_kerja;
	}

	function simpan_unit_kerja($data) {
		global $conn;

		$kd_unit_kerja = buat_kd_unit_kerja();
		$nip           = mysqli_real_escape_string($conn, htmlspecialchars($data['pegawai']));
		$deskripsi     = mysqli_real_escape_string($conn, htmlspecialchars($data['deskripsi']));
		$show_item     = "N";

		$query = "INSERT INTO tb_unit_kerja VALUES('$kd_unit_kerja', '$nip', '$deskripsi', '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_unit_kerja($data) {
		global $conn;

		$kd_unit_kerja = mysqli_real_escape_string($conn, htmlspecialchars($data['kd_unit_kerja']));
		$nip           = mysqli_real_escape_string($conn, htmlspecialchars($data['pegawai']));
		$deskripsi     = mysqli_real_escape_string($conn, htmlspecialchars($data['deskripsi']));

		$query = "UPDATE tb_unit_kerja SET 
			nip='$nip', deskripsi='$deskripsi' WHERE kd_unit_kerja='$kd_unit_kerja'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function update_show_unit_kerja($kd, $show) {
		global $conn;

		$kd_unit_kerja = mysqli_real_escape_string($conn, htmlspecialchars($kd));
		
		$query = mysqli_query($conn, "UPDATE tb_unit_kerja SET show_item='$show' WHERE kd_unit_kerja='$kd_unit_kerja'");

		return mysqli_affected_rows($conn);
	}

	function hapus_unit_kerja($kd) {
		global $conn;

		$kd_unit_kerja = mysqli_real_escape_string($conn, htmlspecialchars($kd));

		// HAPUS DATA UNIT KERJA
		$query = "DELETE FROM tb_unit_kerja WHERE kd_unit_kerja='$kd_unit_kerja'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
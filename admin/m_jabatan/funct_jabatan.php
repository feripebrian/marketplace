<?php

	function buat_kd_jabatan() {
		global $conn;

		// MENCARI NILAI MAX PADA kd_jabatan
		$cek_kode   = "SELECT MAX(SUBSTRING(kd_jabatan, 1, 5)) AS kode FROM tb_jabatan";
		$hasil      = mysqli_query($conn, $cek_kode);
		$data       = mysqli_fetch_assoc($hasil);
		$kd_jabatan = $data['kode'];
		$no_urut    = (int) substr($kd_jabatan, 0, 5);

		$no_urut++;

		if( $no_urut > 99999 ) {
			return false;
		}

		// BUAT KODE JABATAN
		$kd_jabatan = sprintf("%05s", $no_urut);

		return $kd_jabatan;
	}

	function simpan_jabatan($data) {
		global $conn;
		
		$kd_jabatan   = buat_kd_jabatan();
		$nama_jabatan = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['nama_jabatan'])));

		// SIMPAN DATA JABATAN
		$query = "INSERT INTO tb_jabatan VALUES('$kd_jabatan', '$nama_jabatan')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_jabatan($data) {
		global $conn;

		$kd_jabatan   = mysqli_real_escape_string($conn, htmlspecialchars($data['kd_jabatan']));
		$nama_jabatan = mysqli_real_escape_string($conn, htmlspecialchars(strtoupper($data['nama_jabatan'])));

		// UPDATE DATA JABATAN
		$query = "UPDATE tb_jabatan SET nama_jabatan='$nama_jabatan' WHERE kd_jabatan='$kd_jabatan'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_jabatan($kode) {
		global $conn;

		$kd_jabatan   = mysqli_real_escape_string($conn, htmlspecialchars($kode));

		// HAPUS DATA JABATAN
		$query = mysqli_query($conn, "DELETE FROM tb_jabatan WHERE kd_jabatan='$kd_jabatan'");

		return mysqli_affected_rows($conn);
	}
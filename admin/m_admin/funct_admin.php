<?php
	
	function cek_username_admin($username_admin) {
		global $conn;

		$username = mysqli_real_escape_string($conn, htmlspecialchars($username_admin));

		// CEK QUERY tb_admin BERDASARKAN $username
		$query = mysqli_query($conn, "SELECT id_admin, username FROM tb_admin WHERE username='$username'");
		$hasil = mysqli_num_rows($query);

		if( $hasil > 0 ) {
			return false;
		} else {
			return true;
		}
	}

	function cek_konfirmasi_password($password_admin, $password_confirmation_admin) {
		global $conn;

		$password              = mysqli_real_escape_string($conn, $password_admin);
		$password_confirmation = mysqli_real_escape_string($conn, $password_confirmation_admin);

		if( $password != $password_confirmation ) {
			return false;
		} else {
			return true;
		}
	}

	function simpan_admin($data) {
		global $conn;

		$nama_admin = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_admin']));
		$username   = mysqli_real_escape_string($conn, htmlspecialchars($data['username_admin']));
		$password   = mysqli_real_escape_string($conn, $data['password_admin']);
		$level      = 'Admin';
		$status     = 0;

		// ENKRIPSI PASSWORD
		$pass = sha1($password);

		// SIMPAN DATA ADMIN
		$query = "INSERT INTO tb_admin VALUES('', '$nama_admin', '$username', '$pass', '$level', $status)";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function update_status_admin($data, $status) {
		global $conn;

		$id_admin = mysqli_real_escape_string($conn, $data['id']);

		// UPDATE STATUS ADMIN
		$query = "UPDATE tb_admin SET status=$status WHERE id_admin=$id_admin";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_admin($id) {
		global $conn;

		$id_admin = mysqli_real_escape_string($conn, $id);

		// DELETE DATA ADMIN
		$query = "DELETE FROM tb_admin WHERE id_admin=$id_admin";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
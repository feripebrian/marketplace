<?php

	function cek_sess_viewers_berita($sess_id, $id_berita) {
		global $conn;

		$sess_idok   = mysqli_real_escape_string($conn, $sess_id);
		$id_beritaok = mysqli_real_escape_string($conn, $id_berita);

		$cek_sess = mysqli_query($conn, "SELECT id_session, id_berita FROM tb_sess_viewers_berita WHERE id_session='$sess_idok' AND id_berita=$id_beritaok");
		$hasil    = mysqli_num_rows($cek_sess);

		if( $hasil === 0 ) {
			$sql   = "INSERT INTO tb_sess_viewers_berita VALUES('$sess_idok', $id_beritaok)";
			$query = mysqli_query($conn, $sql);

			return mysqli_affected_rows($conn);
		}
	}

	function update_views_berita($id) {
		global $conn;

		$sql   = "UPDATE tb_berita SET views=views+1 WHERE id_berita=$id";
		$query = mysqli_query($conn, $sql);

		if( $query ) {
			return  true;
		} else {
			return false;
		}
	}
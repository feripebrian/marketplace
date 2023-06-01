<?php
	
	function buat_id_dir_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_dir_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_dir_link, 2, 4)) AS id FROM tb_direktori_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_dir_link = $data['id'];
		$no_urut     = (int) substr($id_dir_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID DIREKTORI LINK
		$id_dir_link = $char . sprintf("%04s", $no_urut);

		return $id_dir_link;
	}

	function simpan_link_direktori($data) {
		global $conn;

		$id_dir_link  = buat_id_dir_link();
		$id_direktori = mysqli_real_escape_string($conn, htmlspecialchars($data['direktori']));
		$nama_link    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link         = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item    = "Y";

		// SIMPAN DATA LINK DIREKTORI
		$query = "INSERT INTO tb_direktori_link VALUES('$id_dir_link', '$id_direktori', '$nama_link', '$link', '$show_item')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubah_link_direktori($data) {
		global $conn;

		$id_dir_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_dir_link']));
		$id_direktori = mysqli_real_escape_string($conn, htmlspecialchars($data['direktori']));
		$nama_link    = mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link         = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK DIREKTORI
		$query = "UPDATE tb_direktori_link SET id_direktori='$id_direktori', nama_dir_link='$nama_link', link_dir_link='$link' WHERE id_dir_link='$id_dir_link'
		";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function update_show_link_direktori($id, $show) {
		global $conn;

		$id_dir_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_direktori_link
		$query = "UPDATE tb_direktori_link SET show_item='$show' WHERE id_dir_link='$id_dir_link'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function hapus_link_direktori($id) {
		global $conn;

		$id_dir_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// HAPUS DATA LINK DIREKTORI
		$query = mysqli_query($conn, "DELETE FROM tb_direktori_link WHERE id_dir_link='$id_dir_link'");

		return mysqli_affected_rows($conn);
	}
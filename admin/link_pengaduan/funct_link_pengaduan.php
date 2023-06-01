<?php
	
	function buat_id_pengaduan_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_pengaduan_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_pengaduan_link, 2, 4)) AS id FROM tb_pengaduan_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_pengaduan_link = $data['id'];
		$no_urut     = (int) substr($id_pengaduan_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID PENGADUAN LINK
		$id_pengaduan_link = $char . sprintf("%04s", $no_urut);

		return $id_pengaduan_link;
	}

	function simpan_link_pengaduan($data) {
		global $conn;
		
		$id_pengaduan_link  = buat_id_pengaduan_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_pengaduan     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK PENGADUAN
		$query = mysqli_query($conn, "INSERT INTO tb_pengaduan_link VALUES(
											'$id_pengaduan_link',  '$nama_link', '$link_pengaduan', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_pengaduan($data) {
		global $conn;

		$id_pengaduan_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_pengaduan_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_pengaduan     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK PENGADUAN
		$query = mysqli_query($conn, "UPDATE tb_pengaduan_link SET  nama_pengaduan_link='$nama_link', link_pengaduan='$link_pengaduan' 
									WHERE id_pengaduan_link='$id_pengaduan_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_pengaduan($id, $show) {
		global $conn;

		$id_pengaduan_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_pengaduan_link
		$query = mysqli_query($conn, "UPDATE tb_pengaduan_link SET 
				show_item='$show' 
			WHERE id_pengaduan_link='$id_pengaduan_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_pengaduan($id) {
		global $conn;

		$id_pengaduan_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK PENGADUAN
		$query = mysqli_query($conn, "DELETE FROM tb_pengaduan_link WHERE id_pengaduan_link='$id_pengaduan_link'");

		

		return mysqli_affected_rows($conn);
	}
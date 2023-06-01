<?php
	
	function buat_id_pontren_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_pontren_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_pontren_link, 2, 4)) AS id FROM tb_pontren_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_pontren_link = $data['id'];
		$no_urut     = (int) substr($id_pontren_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID pontren LINK
		$id_pontren_link = $char . sprintf("%04s", $no_urut);

		return $id_pontren_link;
	}

	function simpan_link_pontren($data) {
		global $conn;
		
		$id_pontren_link  	= buat_id_pontren_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_pontren     	= mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK pontren
		$query = mysqli_query($conn, "INSERT INTO tb_pontren_link VALUES(
											'$id_pontren_link',  '$nama_link', '$link_pontren', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_pontren($data) {
		global $conn;

		$id_pontren_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_pontren_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_pontren     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK pontren
		$query = mysqli_query($conn, "UPDATE tb_pontren_link SET  nama_pontren_link='$nama_link', link_pontren='$link_pontren' 
									WHERE id_pontren_link='$id_pontren_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_pontren($id, $show) {
		global $conn;

		$id_pontren_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_pontren_link
		$query = mysqli_query($conn, "UPDATE tb_pontren_link SET 
				show_item='$show' 
			WHERE id_pontren_link='$id_pontren_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_pontren($id) {
		global $conn;

		$id_pontren_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK pontren
		$query = mysqli_query($conn, "DELETE FROM tb_pontren_link WHERE id_pontren_link='$id_pontren_link'");

		

		return mysqli_affected_rows($conn);
	}
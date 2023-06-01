<?php
	
	function buat_id_penmad_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_penmad_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_penmad_link, 2, 4)) AS id FROM tb_penmad_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_penmad_link = $data['id'];
		$no_urut     = (int) substr($id_penmad_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID penmad LINK
		$id_penmad_link = $char . sprintf("%04s", $no_urut);

		return $id_penmad_link;
	}

	function simpan_link_penmad($data) {
		global $conn;
		
		$id_penmad_link  	= buat_id_penmad_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_penmad     	= mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK penmad
		$query = mysqli_query($conn, "INSERT INTO tb_penmad_link VALUES(
											'$id_penmad_link',  '$nama_link', '$link_penmad', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_penmad($data) {
		global $conn;

		$id_penmad_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_penmad_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_penmad     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK penmad
		$query = mysqli_query($conn, "UPDATE tb_penmad_link SET  nama_penmad_link='$nama_link', link_penmad='$link_penmad' 
									WHERE id_penmad_link='$id_penmad_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_penmad($id, $show) {
		global $conn;

		$id_penmad_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_penmad_link
		$query = mysqli_query($conn, "UPDATE tb_penmad_link SET 
				show_item='$show' 
			WHERE id_penmad_link='$id_penmad_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_penmad($id) {
		global $conn;

		$id_penmad_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK penmad
		$query = mysqli_query($conn, "DELETE FROM tb_penmad_link WHERE id_penmad_link='$id_penmad_link'");

		

		return mysqli_affected_rows($conn);
	}
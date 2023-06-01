<?php
	
	function buat_id_haji_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_haji_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_haji_link, 2, 4)) AS id FROM tb_haji_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_haji_link = $data['id'];
		$no_urut     = (int) substr($id_haji_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID haji LINK
		$id_haji_link = $char . sprintf("%04s", $no_urut);

		return $id_haji_link;
	}

	function simpan_link_haji($data) {
		global $conn;
		
		$id_haji_link  	= buat_id_haji_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_haji     	= mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK haji
		$query = mysqli_query($conn, "INSERT INTO tb_haji_link VALUES(
											'$id_haji_link',  '$nama_link', '$link_haji', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_haji($data) {
		global $conn;

		$id_haji_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_haji_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_haji     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK haji
		$query = mysqli_query($conn, "UPDATE tb_haji_link SET  nama_haji_link='$nama_link', link_haji='$link_haji' 
									WHERE id_haji_link='$id_haji_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_haji($id, $show) {
		global $conn;

		$id_haji_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_haji_link
		$query = mysqli_query($conn, "UPDATE tb_haji_link SET 
				show_item='$show' 
			WHERE id_haji_link='$id_haji_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_haji($id) {
		global $conn;

		$id_haji_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK haji
		$query = mysqli_query($conn, "DELETE FROM tb_haji_link WHERE id_haji_link='$id_haji_link'");

		

		return mysqli_affected_rows($conn);
	}
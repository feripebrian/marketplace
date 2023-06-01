<?php
	
	function buat_id_bimas_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_bimas_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_bimas_link, 2, 4)) AS id FROM tb_bimas_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_bimas_link = $data['id'];
		$no_urut     = (int) substr($id_bimas_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID bimas LINK
		$id_bimas_link = $char . sprintf("%04s", $no_urut);

		return $id_bimas_link;
	}

	function simpan_link_bimas($data) {
		global $conn;
		
		$id_bimas_link  	= buat_id_bimas_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_bimas     	= mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK bimas
		$query = mysqli_query($conn, "INSERT INTO tb_bimas_link VALUES(
											'$id_bimas_link',  '$nama_link', '$link_bimas', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_bimas($data) {
		global $conn;

		$id_bimas_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_bimas_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_bimas     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK bimas
		$query = mysqli_query($conn, "UPDATE tb_bimas_link SET  nama_bimas_link='$nama_link', link_bimas='$link_bimas' 
									WHERE id_bimas_link='$id_bimas_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_bimas($id, $show) {
		global $conn;

		$id_bimas_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_bimas_link
		$query = mysqli_query($conn, "UPDATE tb_bimas_link SET 
				show_item='$show' 
			WHERE id_bimas_link='$id_bimas_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_bimas($id) {
		global $conn;

		$id_bimas_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK bimas
		$query = mysqli_query($conn, "DELETE FROM tb_bimas_link WHERE id_bimas_link='$id_bimas_link'");

		

		return mysqli_affected_rows($conn);
	}
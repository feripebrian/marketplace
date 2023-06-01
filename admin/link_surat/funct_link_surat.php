<?php
	
	function buat_id_surat_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_surat_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_surat_link, 2, 4)) AS id FROM tb_surat_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_surat_link = $data['id'];
		$no_urut     = (int) substr($id_surat_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID surat LINK
		$id_surat_link = $char . sprintf("%04s", $no_urut);

		return $id_surat_link;
	}

	function simpan_link_surat($data) {
		global $conn;
		
		$id_surat_link  = buat_id_surat_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_surat     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK surat
		$query = mysqli_query($conn, "INSERT INTO tb_surat_link VALUES(
											'$id_surat_link',  '$nama_link', '$link_surat', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_surat($data) {
		global $conn;

		$id_surat_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_surat_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_surat     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK surat
		$query = mysqli_query($conn, "UPDATE tb_surat_link SET  nama_surat_link='$nama_link', link_surat='$link_surat' 
									WHERE id_surat_link='$id_surat_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_surat($id, $show) {
		global $conn;

		$id_surat_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_surat_link
		$query = mysqli_query($conn, "UPDATE tb_surat_link SET 
				show_item='$show' 
			WHERE id_surat_link='$id_surat_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_surat($id) {
		global $conn;

		$id_surat_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK surat
		$query = mysqli_query($conn, "DELETE FROM tb_surat_link WHERE id_surat_link='$id_surat_link'");

		

		return mysqli_affected_rows($conn);
	}
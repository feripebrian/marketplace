<?php
	
	function buat_id_survey_link() {
		global $conn;

		// MENCARI NILAI MAX PADA id_survey_link
		$cek_ID      = "SELECT MAX(SUBSTRING(id_survey_link, 2, 4)) AS id FROM tb_survey_link";
		$hasil       = mysqli_query($conn, $cek_ID);
		$data        = mysqli_fetch_assoc($hasil);
		$id_survey_link = $data['id'];
		$no_urut     = (int) substr($id_survey_link, 0, 4);

		$no_urut++;

		$char = "L";
		if( $no_urut > 9999 ) {
			return false;
		}

		// BUAT ID SURVEY LINK
		$id_survey_link = $char . sprintf("%04s", $no_urut);

		return $id_survey_link;
	}

	function simpan_link_survey($data) {
		global $conn;
		
		$id_survey_link  	= buat_id_survey_link();
		$nama_link     		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_survey     	= mysqli_real_escape_string($conn, htmlspecialchars($data['link']));
		$show_item     		= "N";

	
		// SIMPAN DATA LINK SURVEY
		$query = mysqli_query($conn, "INSERT INTO tb_survey_link VALUES(
											'$id_survey_link',  '$nama_link', '$link_survey', '$show_item'
		)");

		return mysqli_affected_rows($conn);
	}

	function ubah_link_survey($data) {
		global $conn;

		$id_survey_link  = mysqli_real_escape_string($conn, htmlspecialchars($data['id_survey_link']));
		$nama_link    		= mysqli_real_escape_string($conn, htmlspecialchars($data['nama_link']));
		$link_survey     = mysqli_real_escape_string($conn, htmlspecialchars($data['link']));

		// UPDATE DATA LINK SURVEY
		$query = mysqli_query($conn, "UPDATE tb_survey_link SET  nama_survey_link='$nama_link', link_survey='$link_survey' 
									WHERE id_survey_link='$id_survey_link'
		");

		return mysqli_affected_rows($conn);
	}

	function update_show_link_survey($id, $show) {
		global $conn;

		$id_survey_link = mysqli_real_escape_string($conn, htmlspecialchars($id));

		// UPDATE show_item tb_survey_link
		$query = mysqli_query($conn, "UPDATE tb_survey_link SET 
				show_item='$show' 
			WHERE id_survey_link='$id_survey_link'");

		return mysqli_affected_rows($conn);
	}

	function hapus_link_survey($id) {
		global $conn;

		$id_survey_link = mysqli_real_escape_string($conn, htmlspecialchars($id));
		
		// HAPUS DATA LINK SURVEY
		$query = mysqli_query($conn, "DELETE FROM tb_survey_link WHERE id_survey_link='$id_survey_link'");

		

		return mysqli_affected_rows($conn);
	}
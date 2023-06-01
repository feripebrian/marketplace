<?php
	
	require '../../config/koneksi.php';
	require 'funct_dampak.php';

	if( !empty($_POST['id']) ) {
		$id = $_POST['id'];

		// HASIL CEK ID ZONA
		if( cek_id_zona($id) === 1 ) {
			echo "ada";
		} else {
			echo "tidak ada";
		}
	} else {
		echo "gagal";
	}
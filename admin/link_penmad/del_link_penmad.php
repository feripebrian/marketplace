<?php

	require 'funct_link_penmad.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK penmad
		if( hapus_link_penmad($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link penmad di-Hapus.');
					window.location.href='?page=link_penmad';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link penmad di-Hapus.');
					window.location.href='?page=link_penmad';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_penmad';
			</script>
		";
	}
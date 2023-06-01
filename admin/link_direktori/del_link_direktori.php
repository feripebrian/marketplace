<?php

	require 'funct_link_direktori.php';

	// CEK APAKAH $_GET['id'] ADA
	if( !empty($_GET['id']) ) {
		$id = $_GET['id'];

		// PROSES HAPUS DATA LINK DIREKTORI
		if( hapus_link_direktori($id) > 0 ) {
			echo "
				<script>
					alert('Berhasil! Data link direktori di-Hapus.');
					window.location.href='?page=link_direktori';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Gagal! Data link direktori di-Hapus.');
					window.location.href='?page=link_direktori';
				</script>
			";
		}
	} else {
		echo "
			<script>
				alert('Pilih data dulu!');
				window.location.href='?page=link_direktori';
			</script>
		";
	}